<?php
  	//set up db connection	
$db = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_4ece6995097aa5a;', 'b9437331242a46', 'd66257b7');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		     
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>
