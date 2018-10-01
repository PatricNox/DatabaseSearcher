<?php include __DIR__.'/style.php';?>
<?php include __DIR__.'/../functions.php';?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<div class="db-wrapper">
    <div class="head">
        <strong><span style="float: right; color: red;"><a href="https://github.com/PatricNox">PatricNox</a></span></strong>
    </div>

    <form action='#' method='POST'>
      <input class="input-fields" type="text" placeholder="searching for.." name="dbs-search">
      <input class="input-fields" type="text" placeholder="in database" name="dbs-database">
        <button class="input-button" type="submit">
            <i class="fas fa-search"></i>
        </button>
  </form>
  <?php if (!$QueryFound ):?>
    <p>
        More accurate search words = better results!<br><br><br>
      Be sure to have entered your database credentials in dbSearcher/configs/config.cfg.
    </p>
  <?php endif; ?>
  <?php if ($QueryFound && $search): ?>
    <table class="query-table" align="center">
      <h1 class="queru-head">Query Results:</h1>
      <tr class="table-header">
        <th >Table</th>
        <th>Results</th>
        <th>Select Query</th>
      </tr>
      <?php foreach ($QueryFound as $result): ?>
        <tr class="table-item">
          <td><?=$result['table'];?></td>
          <td><?=$result['hits'];?></td>
          <td>SELECT * FROM <?=$result['table'];?> WHERE <?=$result['from'];?>;</td>
        </tr>
      <?php endforeach;?>
    </table>
  <?php endif; ?>
</div>