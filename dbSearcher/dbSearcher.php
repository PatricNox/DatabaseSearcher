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
			$tables_rs = $mysqli->query("SHOW TABLES");

			// For each table.
			while ($tables_result = $tables_rs->fetch_array(MYSQLI_NUM)) {
				// Get table name.
				$table = $tables_result[0];
				// Fetch all column names.
				$columns_rs = $mysqli->query("SHOW COLUMNS FROM `$table`");
				// Initialize the final query.
				$conditions_arr = [];
				$pattern = $strict ? "'$search'" : "'%$search%'";

				// For each table column.
				while ($column_result = $columns_rs->fetch_assoc()) {
					$column_name = $column_result['Field'];
					// Search for pattern.
					$conditions_arr[] = "`$column_name` LIKE $pattern";
				}
				// We don't need this connection anymore.
				$columns_rs->close();

				// Only proceed if we have conditions to add
				if (!empty($conditions_arr)) {
					// Finalize the query.
					$query = "SELECT * FROM `$table` WHERE " . implode(" OR ", $conditions_arr);
					$query_rs = $mysqli->query($query);

					// For each matched row.
					if ($query_rs && $query_rs->num_rows > 0) {
						$matched_columns = [];
						while ($match = $query_rs->fetch_array(MYSQLI_ASSOC)) {
							// Get the columns that have the actual match.
							foreach ($match as $column_name => $value_name) {
								// Check if '$search' exists inside '$value_name'.
								if (stripos($value_name, $search) !== FALSE) {
									$matched_columns[$column_name] = $column_name;
								}
							}
						}

						// If we have matched columns, construct the results array.
						if (!empty($matched_columns)) {
							$q = implode(" LIKE $pattern OR ", $matched_columns) . " LIKE $pattern";
							// Construct the $results array.
							$results[$table] = array('table' => $table, 'hits' => $query_rs->num_rows, 'from' => $q);
						}
					}
				}
			}

			// We don't need this connection anymore.
			$tables_rs->close();
			$mysqli->close(); // Make sure to close the MySQL connection
			return $results;
		}
	}
