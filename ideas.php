<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Idea Repo</title>

    <link rel="stylesheet" href="libraries/bootstrap.min.css">
    <link rel="stylesheet" href="libraries/bootflat.min.css">
  <!--   <link rel="stylesheet" href="libraries/font-awesome.min.css"> -->
    <link rel="stylesheet" href="style.css">
    <script src="ideas.js">
    	
    	
    </script>
</head>

<?php
	//set up db connection
	$db = new PDO('mysql:host=localhost;dbname=idearepo;', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>

<body>
    <div class="container-fluid">
    
    
    <div class="row">
    	<div class="col-lg-3 col-md-2 col-sm-1"></div>
    	<button class="btn btn-success expandbutton" 
    			onclick="expandcollapseall();">expand/collapse all</button>
    </div>

    <!--submit buttons -->
    <div class="submitbutton visible-lg">
	    <a href="index.php" class="btn btn-success">
	    	<p style="font-size:2em;">Submit new idea</p>
	    	<p style="font-size:3em">+</p>
	    </a>
	</div>
	<a href="index.php">
		<div class="submitbutton circle circlemedium hidden-lg hidden-xs">
		    	<p>+</p>
		</div>
	</a>
	<a href="index.php">
		<div class="submitbutton circle circlesmall visible-xs">
		    	<p>+</p>
		</div>
	</a>

    <?php 
    //if the form was submitted successfully
    if(count($_GET) && $_GET['status']=='success'){?>
		<div class="col-lg-3 col-md-2 col-sm-1"></div>
		<div class="col-lg-6 col-md-8 col-sm-10 alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <strong>Idea added successfully.</strong>
		</div>
		<div class="col-lg-3 col-md-2 col-sm-1"></div>

		<div class="spacer"></div>
		<div class="spacer"></div>
  
    <?php }; ?>
    <div class="row">

  <div style="padding-left:5px;">
    <div class="filters col-md-2 col-lg-offset-1 hidden-sm hidden-xs">
		<form method="POST" action="posttest.php">
			<div>
				<h5>Categories</h5>
				<?php 
					$statement = $db->query('SELECT * FROM category');
					$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
					foreach($categories as $category){
				?>
					<div class="checkbox">
					  <label>
					    <input type="checkbox" name="<?php echo $category['pk_id']; ?>" value="<?php echo $category['pk_id']; ?>" checked>
					    	<?php echo $category['name']; ?>
					  </label>
					</div>
				<?php }; ?>
				<p class="pull-right pointer" onclick="selectallornone(this)"><a><u>select all/none</u></a></p>
				<div class="clearfix"></div>
			</div>

			<div>
				<h5>Statuses</h5>
				<?php 
					$statement = $db->query('SELECT * FROM status');
					$statuses = $statement->fetchAll(PDO::FETCH_ASSOC);
					foreach($statuses as $status){
				?>
					<div class="checkbox">
					  <label>
					    <input type="checkbox" value="<?php echo $status['pk_id']; ?>" checked>
					    	<?php echo $status['name']; ?>
					  </label>
					</div>
				<?php }; ?>
				<p class="pull-right pointer" onclick="selectallornone(this)"><a><u>select all/none</u></a></p>
				<div class="clearfix"></div>
			</div>

		  <button type="submit" class="btn btn-default pull-right">Submit</button>
		</form>
	</div>
</div>
<?php
	//fetch ideas from the db
	//sort by most recent
	$stmt = $db->query('SELECT * FROM ideas ORDER BY pk_id DESC');
	$ideas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
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
			            	href="ideadetails.php?idea=<?php echo $idea['pk_id']; ?>">
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
		         			href="ideadetails.php?idea=<?php echo $idea['pk_id']; ?>"
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
		         					//get the category name using the given id
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

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <!-- Bootflat's JS files.-->
    <script src="https://bootflat.github.io/bootflat/js/icheck.min.js"></script>
    <script src="https://bootflat.github.io/bootflat/js/jquery.fs.selecter.min.js"></script>
    <script src="https://bootflat.github.io/bootflat/js/jquery.fs.stepper.min.js"></script>

</body>
</html>