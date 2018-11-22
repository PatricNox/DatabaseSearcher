<html>
    <head>
        <title>Database Searcher</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/styles.css" />
    </head>
    <body>
    <div id="db-wrapper">
	<h3 class="float-r" style="color: red;"><a href="https://github.com/PatricNox">PatricNox</a></h3>
	<h1>Database Searcher</h1>
	<form action='#' method='POST' class="clearfix">
		<div>
			<input class="float-l" style="width: 50%;" type="text" placeholder="searching for.." name="dbs-search">
			<input class="float-r" style="width: 50%;" type="text" placeholder="in database" name="dbs-database">
		</div>
		<br />
		<br />
		<br />
		<div class="clearfix"><input class="float-r" type="submit" value="Search"></div>
	</form>
	<?php if (!$QueryFound ):?>
		<p>More accurate search words = better results!<br><br><br>
		<a href="setup.php">
			<div class="clearfix"><input class="float-l" type="submit" value="Setup Database"></div>
		</a>
	<?php endif; ?>
	<?php if(isset($search)): ?>
		<h2>Searched for: "<?=(isset($search)) ?$search:'';?>" in (<?=(isset($database)) ?$database:'';?>)</h2>
	<?php endif; ?>
