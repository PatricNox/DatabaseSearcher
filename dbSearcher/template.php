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
