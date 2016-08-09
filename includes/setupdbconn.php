<?php
	//set up db connection		
	$db = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_6563eadbc9d3d21;', 'bce3bc60ab26b1', 'df942bc2');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>
