<?php
	
	$file_result = false;
	
	if(isset($_POST['submit_creds'])){
		$config_code = "<?php
	
/* Database Connection Credentials */
/***********************************/

define('DB_HOST', '" . $_POST["hostname"] . "');         // The IP or DNS where the database server is located
define('DB_USER', '" . $_POST["username"] . "');         // Username for login to the database server
define('DB_PASS', '" . $_POST["password"] . "');         // Password for login to the database server

 /* Core Settings /*
 /*****************/
 
 // Execution time for queries
ini_set('max_execution_time', 300); // 5 minutes";

		$file_result = file_put_contents('dbSearcher/configs/config.php', $config_code);
		
		if($file_result !== FALSE){
// 			header("Location: /index.php");
		}
	}
?>

<html>
    <head>
        <title>Database Searcher Setup</title>
        <meta charset="UTF-8">
        <?php if($file_result !== FALSE){ ?>
		<meta http-equiv="refresh" content="0; url=/index.php">
        <?php } ?>
        <link rel="stylesheet" href="css/styles.css" />
    </head>
    <body>
        <div class="container">
	        <div class="form-container">
		        <h1>Database Searcher Setup</h1>
		        <form method="post">
			        <div class="field-group">
				        <label>Hostname:</label>
				        <input type="text" id="hostname" name="hostname" />
			        </div>
			        <div class="field-group">
				        <label>Username:</label>
				        <input type="text" id="username" name="username" />
			        </div>
			        <div class="field-group">
				        <label>Password:</label>
				        <input type="password" id="password" name="password" />
			        </div>
			        <div class="submit-group">
				        <input type="submit" name="submit_creds" />
			        </div>
		        </form>
	        </div>
        </div>
    </body>
</html>