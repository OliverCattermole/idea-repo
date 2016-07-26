<!doctype html>
<html>
<body>
	<pre> <?php print_r($_POST); ?> </pre>

	<?php
		if(count($_POST)){

			$db = new PDO('mysql:host=localhost;dbname=idearepo;', 'root', '');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

			//fetch ideas from the db
			//sort by most recen

			$query = "SELECT * FROM ideas WHERE (fk_category=-1";

			$stmt = $db->query('SELECT COUNT(*) FROM category');
			$numcategories = $stmt->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];
			for($i=0; $i<$numcategories; $i++){
				if(isset($_POST['category'.$i])){
					$query = $query." OR fk_category=".$_POST['category'.$i];
					//echo $_POST['category'.$i];
				}	
			}
			$query = $query.") AND (fk_status=-1";
			

			$stmt = $db->query('SELECT COUNT(*) FROM status');
			$numstatuses = $stmt->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];
			for($i=0; $i<$numstatuses; $i++){
				if(isset($_POST['status'.$i])){
					$query = $query." OR fk_status=".$_POST['status'.$i];
					//echo $_POST['category'.$i];
				}	
			}
			$query = $query.") ORDER BY pk_id DESC";
			
			echo $query;

			$stmt = $db->query($query);
			$ideas = $stmt->fetchAll(PDO::FETCH_ASSOC);
			

		 };
	?>
</body>
</html>