<?php
    require('dbSearcher/core.php'); // Load DBS-Core
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Database Searcher Example</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="https://github.com/PatricNox">PatricNox</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <form class="form-inline my-2 my-lg-0" action='#' method='POST'>
                        <div class='form-group mb-2'>
                            <input class="form-control" type="text" placeholder="searching for.." name="dbs-search">
                        </div>

                        <div class='form-group mx-sm-3 mb-2'>
                            <input class="form-control" type="text" placeholder="in database" name="dbs-database">
                        </div>

                        <button type="submit" class="btn btn-outline-primary mb-2">Submit</button>
                    </form>
                </div>
            </nav>
        </header>

        <main role="main" class="container-fluid">
            <!-- Generate DBS markup view -->
            <?php _DBSearcher(); ?>
        </main>
    </body>
</html>
