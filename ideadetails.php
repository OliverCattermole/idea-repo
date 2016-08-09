
<?php
      //if post is non-empty - i.e. we came to this page via form submission
      if (count($_POST)>0 && isset($_POST['ideaid'])){ 
        //set up db connection
        include 'includes/setupdbconn.php';

        $stmt = $db->prepare("INSERT INTO comments VALUES (NULL, :id, :message)");
        $stmt->bindParam(':id', $ideaid, PDO::PARAM_INT);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);

        $ideaid = $_POST['ideaid'];
        $message = $_POST['message'];

        $stmt->execute();
        //redirect to ideas page with get param set
        header('Location: ideadetails.php?idea='.$_POST['ideaid']);
    };
?>
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
    <link rel="stylesheet" href="css/sitebuilder.css">    	
</head>

<?php
	include 'includes/setupdbconn.php';

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
		$idea= $stmt->fetch(PDO::FETCH_ASSOC);
?>
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
			   <div class="panel panel-default">
					<div class="panel-heading clearfix" onclick="expand(this)">
			            <h3 class="panel-title">
			            	<p class="idea-title">
								<?php include 'includes/icon.php'; ?> 
				            	<strong>
				            		<?php echo $idea['title']; ?>
				            	</strong>
				            </p>
			            </h3>
			         </div>
			         <div class="panel-body">
			         		<div class="col-md-9">
			         			<p>
			         				<?php echo $idea['description']; ?>
			         			</p>
			         		</div> 
			         		<div class="col-sm-3">
			         			<p>
			         				<?php
			         					//get the category name using the given id
			         					$name = $db->query("SELECT name FROM category WHERE pk_id = ".$idea['fk_category'])->fetch(PDO::FETCH_ASSOC);
			         					echo $name['name'];
			         				?>
			         			</p>
			         			<p>Owner</p>
			         			<p>
			         				<?php echo $idea['date_raised']; ?>
			         			</p>
			         			<p>
			         				<?php

			         					if(isset($_GET['admin']) && $_GET['admin']==true){
			         				?>
			         				<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
			         					<input type="hidden" name="id" value="<?php echo $idea['pk_id']; ?>">
			         					<select class="form-control" name="status">
					                          <?php
					                              $stmt = $db->query('SELECT * FROM status');
					                              $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
					                              //print the ideas
					                              foreach($results as $statuses){ 
					                              	
					                          ?>
					                            	<option value="<?php echo $statuses['pk_id']; ?>" 
					                            			<?php if($statuses['pk_id'] == $idea['fk_status']){ echo "selected"; } ?> 
					                            			> 
					                            				<?php echo $statuses['name']; ?>
					                            	</option>
					                          <?php }; ?>
								        </select>
								        <button class="btn btn-default" style="margin-top:10px;">Update</button>
								     </form>
			         				<?php	
			         					}else{
				         					$name = $db->query("SELECT name FROM status WHERE pk_id = ".$idea['fk_status'])->fetch(PDO::FETCH_ASSOC);
				         					echo $name['name'];
			         					};
			         				?>

				         				
								    
					         	</p>
			         		</div>
			         		<div class="col-xs-12">
			         			<p>
			         				<?php echo $idea['usecase']; ?>
			         			</p>
			         		</div>

			         </div>
				</div>
			</div>
		</div>

	<div  class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
		<h4>Comments</h4>	
	</div>

<?php
	$stmt = $db->query('SELECT * FROM comments WHERE fk_ideaid = '.$idea['pk_id'].' ORDER BY pk_id ASC');
	$comments= $stmt->fetchAll(PDO::FETCH_ASSOC);
	$i=1;
	foreach($comments as $comment){
?>
	<div  class="well col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">

		<?php echo $i.".";
				echo "<br>";
				echo $comment['message'];
				$i++;
		?>

	</div>

<?php }; ?>

<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
	<form action="ideadetails.php" method="post">
  <div>
  
    <div>
      <textarea name="message" spellcheck="true" rows="5" style="width:100%" required></textarea>
    </div>
  </div>
  <div>
		<div>
  		<input class="pull-right" name="saveForm" type="submit" value="Submit">
    </div>
	</div>
  <input type="hidden" name="ideaid" value="<?php echo $idea['pk_id'] ?>">
</form>
</div>

	<?php include 'includes/importscripts.php' ?>
</body>
</html>