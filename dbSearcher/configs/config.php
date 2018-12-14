
			<?php
				/* Database Connection Credentials */
				/***********************************/

				define('DB_HOST', 'localhost');         // The IP or DNS where the database server is located
				define('DB_USER', 'root');         // Username for login to the database server
				define('DB_PASS', 'root');         // Password for login to the database server
				define('DB_PORT', '3306');         // Database Port

				/* Core Settings /*
				/*****************/
				
				// Execution time for queries
				ini_set('max_execution_time', 300); // 5 minutes