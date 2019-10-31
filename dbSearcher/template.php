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
			<label for="dbs-strict">Find exact match</label>
			<?php $checkbox_attributes = !empty($_SESSION['strict'])? 'checked': '' ?>
			<input type="checkbox" name="dbs-strict" id="dbs-strict" value="TRUE" <?php echo $checkbox_attributes; ?>/>
		</div>
		</div>
		<input class="float-r" type="submit" value="Search">
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
				<th>Matches</th>
				<th>Select Query</th>
				<th>Actions</th>
			</tr>
			<?php $idx=0; ?>
			<?php foreach ($QueryFound as $result): ?>
				<tr>
					<td class="table"><?=$result['table'];?></td>
					<td class="hits"><?=$result['hits'];?></td>
					<td class="query" data-idx="<?php echo $idx ?>" onclick="copy(<?php echo $idx ?>)">SELECT * FROM <?=$result['table'];?> WHERE <?=$result['from'];?>;</td>
					<td class="actions"><button onclick="copy(<?php echo $idx ?>)" >Copy</button></td>
				</tr>
				<?php $idx++; ?>
			<?php endforeach;?>
		</table>
	<?php endif; ?>
