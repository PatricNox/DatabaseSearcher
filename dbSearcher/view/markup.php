<?php include __DIR__.'/style.php';?>
<?php include __DIR__.'/../functions.php';?>
<div id="db-wrapper">
  <form action='#' method='POST'>
    <input type="text" placeholder="searching for.." name="dbs-search">
    <input type="text" placeholder="in database" name="dbs-database">
    <input type="submit" value="Search">
    <h3 style="float: right; color: red;"><a href="https://github.com/PatricNox">Noxies</a></h3>
  </form>
  <?php if (!$QueryFound ):?>
    <p>
        More accurate search words = better results!<br><br><br>
      Be sure to have entered your database credentials in dbSearcher/configs/config.cfg.
    </p>
  <?php endif; ?>
  <?php if ($QueryFound && $search): ?>
    <table align="center">
      <h1>Query Results:</h1>
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