<?php 

	/**
	*
	* Following file is the base handler and view output.
	*
	* @author PatricNox <hello@PatricNox.info>
	*/

	$QueryFound = false;
	include_once('dbSearcher/header.php');

	// Check if there are inputs.
	if (isset($_POST['dbs-database'], $_POST['dbs-search']))
	{
		$search = $_POST['dbs-search'];
		$_SESSION['query'] = $_POST['dbs-search'];
		$_SESSION['database'] = $database = $_POST['dbs-database'];
		$strict = !empty($_POST['dbs-strict']) ? TRUE : FALSE;
		$_SESSION['strict'] = $strict;

	    $QueryFound = $dbSearcher->dbs_search($search, $_POST['dbs-database'], $strict);
	}

	// Load view.
	include_once('dbSearcher/template.php');
	include_once('dbSearcher/footer.php');
