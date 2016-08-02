<?php
	//set up db connection		
	$db = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_f3ca2ad785fc4af;', 'b023a08296a1c5', '3a6c2a33');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


	//fetch ideas from the db
	//sort by most recent
	if(!count($_POST)){
		$stmt = $db->query('SELECT * FROM ideas ORDER BY pk_id DESC');
		$ideas = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}else{

		//fetch ideas from the db
		//sort by most recen

		$query = "SELECT * FROM ideas WHERE (fk_category=-1";

		$stmt = $db->query('SELECT COUNT(*) FROM category');
		$numcategories = $stmt->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];
		for($i=0; $i<$numcategories; $i++){
			if(isset($_POST['category'.$i])){
				$query .= " OR fk_category=".$_POST['category'.$i];
				//echo $_POST['category'.$i];
			}	
		}
		$query .= ") AND (fk_status=-1";
		

		$stmt = $db->query('SELECT COUNT(*) FROM status');
		$numstatuses = $stmt->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];
		for($i=0; $i<$numstatuses; $i++){
			if(isset($_POST['status'.$i])){
				$query .= " OR fk_status=".$_POST['status'.$i];
			}	
		}
		$query .= ") ORDER BY pk_id DESC";

		$stmt = $db->query($query);
		$ideas = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	}

?>