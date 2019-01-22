<?php 

	/**
	*
	* Following file is the base handler and view output.
	*
	* @author PatricNox <hello@PatricNox.info>
	*
	*/

	$QueryFound = false;
	include_once('dbsearcher/header.php');
	// Check if there are inputs
	if (isset($_POST['dbs-database'], $_POST['dbs-search']))
	{
	    $search = $_POST['dbs-search'];
		$_SESSION['query'] = $_POST['dbs-search'];
		$_SESSION['database'] = $database = $_POST['dbs-database'];
	    $QueryFound = $dbSearcher->dbs_search($search, $_POST['dbs-database']);
	}

	// Load view
	include_once('dbsearcher/template.php');
	include_once('dbsearcher/footer.php');
