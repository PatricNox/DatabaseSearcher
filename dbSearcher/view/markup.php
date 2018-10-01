    <?php include __DIR__.'/style.php'; ?>
    <?php include __DIR__.'/../functions.php'; ?>

    <div class="row" id="db-wrapper">
        <div class="col-md-12">
            <?php if (!$QueryFound ): ?>
                <div class="alert alert-primary" role="alert">
                    <h4 class="alert-heading">A few tips...</h4>
                    <p>More accurate search words = better results!</p>
                    <hr>
                    <p class="mb-0">Be sure to have entered your database credentials in <code>dbSearcher/configs/config.php</code></p>
                </div>
            <?php endif; ?>

            <?php if ($QueryFound && $search): ?>
                <?php
                    print_r($QueryFound);
                    print_r($search);
                ?>
                <h2 class="mt-5">Results</h2>

                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Table</th>
                            <th>Results</th>
                            <th>Select Query</th>
                        </tr>
                    </thead>

                    <?php foreach ($QueryFound as $result): ?>
                        <tbody>
                            <tr>
                                <td><?= ucfirst($result['table']); ?></td>
                                <td><?= $result['hits']; ?></td>
                                <td><code>SELECT * FROM <?= $result['table']; ?> WHERE <?= $result['from'];?>;</code></td>
                            </tr>
                        </tbody>
                    <?php endforeach;?>
                </table>
            <?php endif; ?>
        </div>
    </div>
