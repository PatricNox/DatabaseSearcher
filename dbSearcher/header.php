<?php session_start(); ?>
<html>
    <head>
        <title>Database Searcher</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/styles.css" />
        <script>
            function copy(element){
                let query = document.querySelectorAll("#query");
                let temp = query[element].innerHTML;
                let copyQuery = document.createElement("textarea");
                copyQuery.value = temp;
                document.body.appendChild(copyQuery);
                copyQuery.select();
                document.execCommand("copy");
                document.body.removeChild(copyQuery);
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
