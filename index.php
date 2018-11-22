<?php 

	/**
	*
	* Following file is the base handler and view output.
	*
	* @author PatricNox <hello@PatricNox.info>
	*
	*/

	// Initialise dbSearcher
	$QueryFound = false;
    require('dbSearcher/dbSearcher.php'); 
	include_once('dbsearcher/header.php');
	$dbSearcher = new dbSearcher();
	
	// Check if there are inputs
	if (isset($_POST['dbs-database'], $_POST['dbs-search']))
	{
	    $search = $_POST['dbs-search'];
	    $database = $_POST['dbs-database'];
	    $QueryFound = $dbSearcher->dbs_search($search, $_POST['dbs-database']);
	}

	// Load view
	include_once('dbsearcher/template.php');
	include_once('dbsearcher/footer.php');
