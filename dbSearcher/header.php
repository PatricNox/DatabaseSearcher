<?php session_start(); ?>
<html>
    <head>
        <title>Database Searcher</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/styles.css" />
        <script>
            function copy(QueryId){
                // Get text of clicked element.
                var td = document.querySelectorAll('[data-idx="' + QueryId+ '"]')[0];
                var query = td.innerText;

                // Create new element, temporarily, for being abled to select it.
                let copyQuery = document.createElement("textarea");
                copyQuery.value = query;
                document.body.appendChild(copyQuery).select();

                // Copy content to clipboard and then delete the new field.
                document.execCommand("copy");
                document.body.removeChild(copyQuery);

                td.classList.add('selected');
                setTimeout(function(){
                    td.classList.remove('selected');
                }, 700);
            }
	</script>
    </head>
    <body>
    <div id="db-wrapper">
	<h3 class="float-r" style="color: red;"><a href="https://github.com/PatricNox">PatricNox</a></h3>
	<h1>Database Searcher</h1>
    <?php 
        require('dbSearcher/dbSearcher.php'); 
        $dbSearcher = new dbSearcher();

        // instantiate DB session, later usage.
        if (!isset($_SESSION['database'], $_SESSION['query'])) {
            $_SESSION['database'] = array();
            $_SESSION['query']    = array();
        }

    ?>
