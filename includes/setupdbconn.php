<?php
	//set up db connection
	define('DB_USER', getenv('MYSQL_USER')); // admin
	define('DB_PASS', getenv('MYSQL_PASSWORD')); 	
	$db = new PDO('mysql:host=mysql;dbname=idearepo;', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>