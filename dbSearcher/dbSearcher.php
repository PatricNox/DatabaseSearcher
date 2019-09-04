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
			if (file_exists(__DIR__.'/configs/config.php'))
				include_once(__DIR__.'/configs/config.php');
			
			if (($_SERVER['REQUEST_URI'] != '/setup.php') && (!file_exists(__DIR__.'/configs/config.php') || (!defined('DB_HOST') || !defined('DB_USER') || !defined('DB_PASS')))){

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
		
		// Database harvest 
		function dbs_search($search, $database, $strict = FALSE)
		{
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, $database, (int)DB_PORT);
			$results = array();
			$sql = "show tables";
			$rs = $mysqli->query($sql);
			
			if ($rs->num_rows > 0){
				while ($r = $rs->fetch_array()){
					$table = $r[0];
					$columnHeaders = array(); // Storage for headers
					$columnmatches = array(); // Storage for Matches
					$sql_search = "SELECT * FROM ".$table." WHERE ";
					$sql_search_fields = array();
					$sql2 = "SHOW COLUMNS FROM ".$table;
					$rs2 = $mysqli->query($sql2);
					if ($rs2->num_rows > 0) {
						while ($r2 = $rs2->fetch_array()){
							$column = $r2[0];

							if ($strict)
								$sql_search_fields[] = $column." = ".$search;
							else 
								$sql_search_fields[] = $column." LIKE('%".$search."%')";
						}
						
						$rs2->close();
					}
					
					$sql_search .= implode(" OR ", $sql_search_fields);
					$rs3 = $mysqli->query($sql_search);
				
					if ($rs3->num_rows > 0) {
						foreach ($rs3 as $row) {
							$columnheaders = array_keys($row);
							$counter = 0; // Used to count at which field we are
		
							foreach ($row as $columnfield) {
								if (strpos(strtoupper($columnfield), strtoupper($search)) !== false) 
									$columnmatches[] = $columnheaders[$counter];
								$counter++;
							}
						}
						
						// Cleanse array from duplicates
						$columnmatches = array_unique($columnmatches);
						$columnoutput = "";
						
						// Use column for the outputting SELECT-section on page
						foreach ($columnmatches as $columnheader) {
							$columnoutput .= $columnheader . ' LIKE "%'.$search.'%" OR ';
						}
									
						$columnoutput = substr($columnoutput, 0, -3); // Remove the last trailing "OR" in the output
						$results[] = array('table' => $table, 'hits' => $rs3->num_rows, 'from' => $columnoutput);
						$rs3->close();
					}
				}
		
				$rs->close();
			}
		
			return $results;
		}
	}
