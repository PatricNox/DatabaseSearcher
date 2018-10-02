<?php 
	include_once('header.php');
	
	$file_result = false;
	
	if(isset($_POST['submit_creds'])){
		$file_result = $dbSearcher->set_config($_POST['hostname'], $_POST['username'], $_POST['password']);
	}
?>
<?php if($file_result !== FALSE){ ?><script type="text/javascript">window.location = '/index.php';</script><?php } ?>
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
<?php include_once('footer.php'); ?>