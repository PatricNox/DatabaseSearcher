<?php 
	include_once('header.php');
    
    $QueryFound = false;
    
	if (isset($_POST['dbs-database'], $_POST['dbs-search']))
	{
	    $search = $_POST['dbs-search'];
	    $database = $_POST['dbs-database'];
	    $QueryFound = $dbSearcher->dbs_search($search, $_POST['dbs-database']);
	}
?>
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
	<?php if ($QueryFound && $search): ?>
		<table align="center">
			<h2>Query Results:</h2>
			<tr>
				<th>Table</th>
				<th>Results</th>
				<th>Select Query</th>
			</tr>
			<?php foreach ($QueryFound as $result): ?>
				<tr>
					<td><?=$result['table'];?></td>
					<td><?=$result['hits'];?></td>
					<td>SELECT * FROM <?=$result['table'];?> WHERE <?=$result['from'];?>;</td>
				</tr>
			<?php endforeach;?>
		</table>
	<?php endif; ?>
</div>
<?php include_once('footer.php');?>