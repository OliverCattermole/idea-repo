<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Idea Repo</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootflat.min.css">
  <!--   <link rel="stylesheet" href="css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="css/style.css">

    <script src="js/ideas.js"></script>
</head>

<?php
	//set up db connection
	$db = new PDO('mysql:host=localhost;dbname=idearepo;', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


	//fetch ideas from the db
	//sort by most recent
	if(!count($_POST)){
		$stmt = $db->query('SELECT * FROM ideas ORDER BY pk_id DESC');
		$ideas = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}else{
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

<body>
    <div class="container-fluid">
    
    
	    <div class="row">
	    	<div class="col-lg-3 col-md-2 col-sm-1"></div>
	    	<button class="btn btn-success expandbutton" 
	    			onclick="expandcollapseall();">expand/collapse all</button>
	    </div>

		<div class="row">
			

			<div style="padding-left:5px;">
			<div class="filters col-md-2 col-lg-offset-1 hidden-sm hidden-xs">
			<form method="POST" action="admin.php">

			<?php
			include 'includes/filterbox.php';
			include 'includes/submitbuttons.php';

				//print the ideas
				foreach($ideas as $idea){
			?>
					
						<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
						   <div class="panel panel-default">
								<div class="panel-heading clearfix" onclick="expand(this)">
						            <h3 class="panel-title">
						            	<p class="idea-title">
											<i class="fa fa-font-awesome" aria-hidden="true"></i>         
							            	<strong>
							            		<?php echo $idea['title']; ?>
							            	</strong>
							            </p>
						            </h3>
						            <a type="button" 
						            	class="btn btn-primary pull-right hidden-xs"
						            	href="ideadetails.php?idea=<?php echo $idea['pk_id']; ?>&admin=true">
						            	See Details
						            </a>
						         </div>
						         <div class="panel-body">
					         		<div class="col-md-9">
					         			<p>
					         				<?php echo $idea['description']; ?>
					         			</p>
					         		</div> 
					         		<a type="button" 
					         			class="btn btn-primary visible-xs" 
					         			style="width:100%"
					         			href="ideadetails.php?idea=<?php echo $idea['pk_id']; ?>&admin=true"
					         			>See Details
					         		</a>
					         		<div class="col-sm-3 hidden-sm hidden-xs">
					         			<p>
					         				<?php
					         					//get the category name using the given id
					         					$name = $db->query("SELECT name FROM category WHERE pk_id = ".$idea['fk_category'])->fetch(PDO::FETCH_ASSOC);
					         					echo $name['name'];
					         				?>
					         			</p>
					         			<p>Owner</p>
					         			<p>
					         				
					         				<?php
					         					//get the status name using the given id
					         					$name = $db->query("SELECT name FROM status WHERE pk_id = ".$idea['fk_status'])->fetch(PDO::FETCH_ASSOC);
					         					echo $name['name'];
					         				?>
					         			</p>
					         			<p>
					         				<?php echo $idea['date_raised']; ?>
					         			</p>
					         		</div>
						         </div>
							</div>
						</div>
					
			<?php }; ?> 
		</div>
	    
	</div>

<?php include 'includes/importscripts.php'; ?>

</body>
</html>