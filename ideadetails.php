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
</head>

<?php
	//set up db connection
	$db = new PDO('mysql:host=localhost;dbname=idearepo;', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    //update status if post is set
    if (isset($_POST['status'])){
    	$stmt = $db->query('UPDATE ideas SET fk_status="'.$_POST['status'].'" WHERE pk_id ="'.$_GET['idea'].'"');
    	$stmt->execute();
    }
?>

<body>
    <div class="container-fluid">
    
    <div class="row">
    	<div class="col-lg-3 col-md-2 col-sm-1"></div>
    	<a class="btn btn-success expandbutton"
    		href="
    			<?php if(isset($_GET['admin']) && $_GET['admin']==true){ echo "admin.php"; }else{ echo "index.php"; }; ?>
    		"
    		>See all ideas</a>
    </div>

    <?php include 'includes/submitbuttons.php'; ?>

<?php 
		$idea = $_GET['idea'];

		$stmt = $db->query('SELECT * FROM ideas WHERE pk_id = '.$idea);
		$value= $stmt->fetch(PDO::FETCH_ASSOC);
?>
		<div class="row">
			<div class="col-lg-3 col-md-2 col-sm-1"></div>
			<div class="col-lg-6 col-md-8 col-sm-10">
			   <div class="panel panel-default">
					<div class="panel-heading clearfix" onclick="expand(this)">
			            <h3 class="panel-title">
			            	<p class="idea-title">
								<i class="fa fa-font-awesome" aria-hidden="true"></i>         
				            	<strong>
				            		<?php echo $value['title']; ?>
				            	</strong>
				            </p>
			            </h3>
			         </div>
			         <div class="panel-body">
			         		<div class="col-md-9">
			         			<p>
			         				<?php echo $value['description']; ?>
			         			</p>
			         		</div> 
			         		<div class="col-sm-3">
			         			<p>
			         				<?php
			         					//get the category name using the given id
			         					$name = $db->query("SELECT name FROM category WHERE pk_id = ".$value['fk_category'])->fetch(PDO::FETCH_ASSOC);
			         					echo $name['name'];
			         				?>
			         			</p>
			         			<p>Owner</p>
			         			<p>
			         				<?php echo $value['date_raised']; ?>
			         			</p>
			         			<p>
			         				<?php

			         					if(isset($_GET['admin']) && $_GET['admin']==true){
			         				?>
			         				<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
			         					<input type="hidden" name="id" value="<?php echo $value['pk_id']; ?>">
			         					<select class="form-control" name="status">
					                          <?php
					                              $stmt = $db->query('SELECT * FROM status');
					                              $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
					                              //print the ideas
					                              foreach($results as $statuses){ 
					                              	
					                          ?>
					                            	<option value="<?php echo $statuses['pk_id']; ?>" 
					                            			<?php if($statuses['pk_id'] == $value['fk_status']){ echo "selected"; } ?> 
					                            			> 
					                            				<?php echo $statuses['name']; ?>
					                            	</option>
					                          <?php }; ?>
								        </select>
								        <button class="btn btn-default" style="margin-top:10px;">Update</button>
								     </form>
			         				<?php	
			         					}else{
				         					$name = $db->query("SELECT name FROM status WHERE pk_id = ".$value['fk_status'])->fetch(PDO::FETCH_ASSOC);
				         					echo $name['name'];
			         					};
			         				?>

				         				
								    
					         	</p>
			         		</div>
			         		<div class="col-xs-12">
			         			<p>
			         				<?php echo $value['usecase']; ?>
			         			</p>
			         		</div>

			         </div>
				</div>
			</div>
			<div class="col-lg-3 col-md-2 col-sm-1"></div>
		</div>

	<?php include 'includes/importscripts.php' ?>


</body>
</html>