<?php 
    // Reset session.
	session_start();
	session_destroy(); 

	include_once('dbSearcher/header.php');
	
	$file_result = false;

	if (isset($_POST['submit_creds'])) {
		// 3306 default port.
		if (empty($_POST['port']))
			$_POST['port'] = 3306;

		$file_result = $dbSearcher->set_config($_POST['hostname'], $_POST['username'], $_POST['password'], (int)$_POST['port']);
	}
?>
<?php if ($file_result !== FALSE){ ?><script type="text/javascript">window.location = '/index.php';</script><?php } ?>

<div class="container">
    <div class="form-container">
        <h1>Database Searcher Setup</h1>
        <form method="post" action="./setup.php">
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
	        <div class="field-group">
		        <label>Port:</label>
		        <input type="text" id="port" name="port" />
	        </div>
	        <div class="submit-group">
		        <input type="submit" name="submit_creds" />
	        </div>
        </form>
    </div>
</div>

<?php include_once('dbSearcher/footer.php'); ?>
