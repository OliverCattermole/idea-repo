<?php
	//set up db connection		
	$db = new PDO('mysql:host=mysql;dbname=idearepo;', 'userILI', 'Og4qySXlYk2IICln');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>