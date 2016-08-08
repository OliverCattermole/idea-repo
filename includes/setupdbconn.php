<?php
	//set up db connection		
	$db = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_f3ca2ad785fc4af;', 'b023a08296a1c5', '3a6c2a33');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>