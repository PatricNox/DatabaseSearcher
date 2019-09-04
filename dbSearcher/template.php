	<form action='#' method='POST' class="clearfix">
		<div>
			<input class="float-l" style="width: 50%;" type="text" placeholder="searching for.." name="dbs-search" value='<?=(!empty($_SESSION['query']))  ? $_SESSION['query'] : ''?>'>
			<input class="float-r" style="width: 50%;" type="text" placeholder="in database" name="dbs-database" value='<?=(!empty($_SESSION['database'])) ? $_SESSION['database'] : ''?>'>
		</div>
		<br />
		<br />
		<br />
		<div class="clearfix">
		<div class="strict float-r">
			<p >
				Find exact match?
			</p>
			<input type="checkbox" name="dbs-strict" value="TRUE" />	
		</div>
		<input class="float-r" type="submit" value="Search"></div>
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
			<?php $QueryId=0; foreach ($QueryFound as $result): ?>
				<tr>
					<td><?=$result['table'];?></td>
					<td><?=$result['hits'];?></td>
					<td id="query">SELECT * FROM <?=$result['table'];?> WHERE <?=$result['from'];?>;</td>
					<td><button onclick="copy(<?=$QueryId?>)">Copy</button></td>
				</tr>
			<?php $QueryId++; endforeach;?>
		</table>
	<?php endif; ?>
