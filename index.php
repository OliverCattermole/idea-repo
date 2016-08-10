<?php 
	include 'includes/setupdbconn.php';
	include 'includes/getideas.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Idea Repo</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootflat.min.css">
  	<link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/sitebuilder.css">  

    <script src="js/ideas.js"></script>
</head>
<body>
    <div class="container-fluid">
    <?php include 'includes/sitebuilderheader.php'; ?>


   <div style="width:100%; height:60px"></div>
    	<div class="row visible-sm visible-xs">
	    	<div class="col-lg-3 col-md-2 col-sm-1"></div>
	    	<button class="btn btn-success expandbutton" 
	    			onclick="expandcollapseall();">expand/collapse all</button>
	    	<button class="btn btn-success expandbutton" 
	    			data-toggle="collapse" data-target="#filterscollapse"	
	    			>
	    		filters
	    	</button>
	    	<div id="filterscollapse" class="collapse">
				<div class="filters clearfix">
				<form method="POST" action="index.php">

			<?php
				include 'includes/filterbox.php';
			?>	
				</div>

			</div>
	   	</div>

		<div class="row">

			<div style="padding-left:5px;">
			<div class="sidebar col-md-2 col-lg-offset-1 hidden-sm hidden-xs">
				<div class="filters clearfix">
				<form method="POST" action="index.php">

			<?php
				include 'includes/filterbox.php';
			?>
				<button class="btn btn-success" 
	    			onclick="expandcollapseall();"
	    			style="margin:10px auto; display:block;">
	    			expand/collapse all
	    		</button>
			</div>

			<?php
			include 'includes/submitbuttons.php';

				//print the ideas
				foreach($ideas as $idea){
			?>
					
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
					         				<?php echo $idea['date_raised']; ?>
					         			</p>
					         			<p>
					         				<?php
					         					//get the status name using the given id
					         					$name = $db->query("SELECT name FROM status WHERE pk_id = ".$idea['fk_status'])->fetch(PDO::FETCH_ASSOC);
					         					echo $name['name'];
					         				?>
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