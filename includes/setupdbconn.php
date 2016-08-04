<?php
	//set up db connection		
	$db = new PDO('mysql:host=172.30.70.84;dbname=idearepo;', 'userILI', 'Og4qySXlYk2IICln');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>