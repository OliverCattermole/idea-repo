<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Idea Repo</title>

    <link rel="stylesheet" href="libraries/bootstrap.min.css">
    <link rel="stylesheet" href="libraries/bootflat.min.css">
    <link rel="stylesheet" href="libraries/font-awesome-4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<?php
	//set up db connection
	$db = new PDO('mysql:host=localhost;dbname=idearepo;', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>

<body>
    <div class="container-fluid">
    	<div class="spacer"></div>

   	<?php
   		//if post is non-empty - i.e. we came to this page via form submission
   		if (count($_POST)>0){ 

   			//insert idea into the database using a prepared statement
	   		$stmt = $db->prepare('INSERT INTO ideas VALUES (NULL, :title, :descr, :category, 0, "'.date("Y-m-d H:i:s").'")');
			$stmt->bindParam(':title', $title, PDO::PARAM_STR);
			$stmt->bindParam(':descr', $desc, PDO::PARAM_STR);
			$stmt->bindParam(':category', $category, PDO::PARAM_INT);

			$title = $_POST['title'];
			$desc = $_POST['description'];
			$category = $_POST['category'];
			$stmt->execute();
   	?>
   			<div class="spacer"></div>
			<div class="alert alert-success alert-dismissable">
			        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			        <strong>Form submitted.</strong>
			</div>
	<?php
		}; 
	?>

<?php
	//fetch ideas from the db
	//sort by most recent
	$stmt = $db->query('SELECT * FROM ideas ORDER BY pk_id DESC');
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
	//print the ideas
	foreach($results as $value){ 
?>
		<div class="row">
			<div class="col-lg-3 col-md-2 col-sm-1"></div>
			<div class="col-lg-6 col-md-8 col-sm-10">
			   <div class="panel panel-default">
					<div class="panel-heading clearfix">
			            <h3 class="panel-title">
			            	<p class="idea-title">
								<i class="fa fa-font-awesome" aria-hidden="true"></i>         
				            	<strong>
				            		<?php echo $value['title']; ?>
				            	</strong>
				            </p>
			            </h3>
			            <button type="button" class="btn btn-primary pull-right hidden-xs">See Details</button>
			         </div>
			         <div class="panel-body">
			         		<div class="col-md-9">
			         			<p>
			         				<?php echo $value['desc']; ?>
			         			</p>
			         		</div> 
			         		<div class="col-sm-3 hidden-sm hidden-xs">
			         			<p>
			         				<?php
			         					//get the category name using the given id
			         					$name = $db->query('SELECT name FROM category WHERE pk_id = '.$value['fk_category'])->fetch(PDO::FETCH_ASSOC);
			         					echo $name['name'];
			         				?>
			         			</p>
			         			<p>Owner</p>
			         			<p>Department</p>
			         			<p>
			         				<?php echo $value['date_raised']; ?>
			         			</p>
			         		</div>
			         </div>
				</div>
			</div>
			<div class="col-lg-3 col-md-2 col-sm-1"></div>
		</div>
<?php }; ?> 
	 


    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <!-- Bootflat's JS files.-->
    <script src="https://bootflat.github.io/bootflat/js/icheck.min.js"></script>
    <script src="https://bootflat.github.io/bootflat/js/jquery.fs.selecter.min.js"></script>
    <script src="https://bootflat.github.io/bootflat/js/jquery.fs.stepper.min.js"></script>

</body>
</html>