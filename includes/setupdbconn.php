<?php
	//set up db connection
	define('DB_USER', getenv('OPENSHIFT_MYSQL_DB_USERNAME')); // admin
	define('DB_PASS', getenv('OPENSHIFT_MYSQL_DB_PASSWORD')); 	
	$db = new PDO('mysql:host=mysql;dbname=idearepo;', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>