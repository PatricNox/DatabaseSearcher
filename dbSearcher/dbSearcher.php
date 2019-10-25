<?php

	/**
	*
	* This is the DBSearcher core file,
	* where the magic happends!
	*
	* @author PatricNox <hello@PatricNox.info>
	*
	*/

	class dbSearcher
	{
		public function __construct()
		{
			if (file_exists(__DIR__.'/configs/config.php')) {
				include_once(__DIR__.'/configs/config.php');
			}

			if (($_SERVER['REQUEST_URI'] != '/setup.php') 
				&& (!file_exists(__DIR__.'/configs/config.php') 
				|| (!defined('DB_HOST') || !defined('DB_USER') || !defined('DB_PASS')))) {
				header('Location: /setup.php');
			}
		}

		function set_config($hostname, $username, $password, $port)
		{
			$config_code = "
			<?php
				/* Database Connection Credentials */
				/***********************************/

				define('DB_HOST', '" . $hostname . "');         // The IP or DNS where the database server is located
				define('DB_USER', '" . $username . "');         // Username for login to the database server
				define('DB_PASS', '" . $password . "');         // Password for login to the database server
				define('DB_PORT', '" . $port     . "');         // Database Port

				/* Core Settings /*
				/*****************/

				// Execution time for queries
				ini_set('max_execution_time', 300); // 5 minutes";

			return file_put_contents('dbSearcher/configs/config.php', $config_code);
		}

		// Database harvest.
		function dbs_search($search, $database, $strict = FALSE)
		{
			// Return an empty array, if $search or $database is missing.
			if (empty($search) || empty($database)) {
				return [];
			}

			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, $database, (int)DB_PORT);
			$results = array();
			$tables_rs = $mysqli->query("show tables");
			// For each table.
			while ($tables_result = $tables_rs->fetch_array(MYSQLI_NUM)){
				// Get table name.
				$table = $tables_result[0];
				// Fetch all column names.
				$columns_rs = $mysqli->query("SHOW COLUMNS FROM `$table`");
				// Initialize the final query.
				$query = "SELECT * FROM `$table` WHERE ";
				$conditions_arr = [];
				$pattern = '';
				// For each table column.
				while ($column_result = $columns_rs->fetch_assoc()) {
					$column_name = $column_result['Field'];
					// Search for pattern.
					if ($strict) {
						$pattern = "'$search'";
					}
					else {
						$pattern = "'%$search%'";
					}

					$conditions_arr[] = "$column_name LIKE $pattern";
				}
				// We don't need this connection anymore.
				$columns_rs->close();

				// Finalize the query.
				$query .= implode(" OR ", $conditions_arr);
				$query_rs = $mysqli->query($query);
				// For each matched row.
				$matched_columns = [];
				if ($query_rs && $match = $query_rs->fetch_array(MYSQLI_ASSOC)) {
					// Get the columns that have the actual match.
					foreach ($match as $column_name => $value_name) {
						// Check it '$search' exists inside '$value'.
						if (stripos($value_name, $search) !== FALSE) {
							$matched_columns[$column_name] = $column_name;
						}
					}
					// Contruct the query that fetches only the matches columns.
					// This is shown to the user.
					$q = implode(" LIKE $pattern OR ", $matched_columns) . " LIKE $pattern";
					// Contstruct the $results array.
					// We use the table name as an array key, to make the contents of the array unique.
					$results[$table] = array('table' => $table, 'hits' => $query_rs->num_rows, 'from' => $q);
				}
			}

			// We don't need this connection anymore.
			$tables_rs->close();
			return $results;
		}
	}
