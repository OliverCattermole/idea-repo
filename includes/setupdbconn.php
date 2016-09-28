<?php
  	//set up db connection	
$db = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fb533df36dc57ba;', 'be1e449a1084cc', '608e9dd5');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		     
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>
