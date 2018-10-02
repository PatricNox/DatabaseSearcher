<?php

include_once(__DIR__.'/configs/config.php');

if(!file_exists(__DIR__.'/configs/config.php') || (!defined('DB_HOST') || !defined('DB_USER') || !defined('DB_PASS'))){
	
	header('Location: /setup.php');
}  

function _DBSearcher() {
	require __DIR__."/view/markup.php";
}
