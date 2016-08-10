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
    <div class="header-navbar-fixed header-navbar-dark">
    	<span id="j_id0:j_id1:j_id6">
    <header class="content-mini content-mini-full" id="header-navbar">
        <ul class="nav-header pull-right">
            <li>
                <div class="btn-group">
                    <button class="btn btn-default btn-image dropdown-toggle" data-toggle="dropdown" type="button"><img src="https://gso--c.eu2.visual.force.com/resource/1470673703000/GLBL_SBLD_Images/assets/img/avatar.jpg" alt="Avatar">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-header">Profile</li>
                        <li>
                            <a href="https://gso--c.eu2.visual.force.com/apex/GLBL_SBLD_Profile?id=a7Db0000000CahtEAC" tabindex="-1">
                                <i class="si si-user pull-right"></i>Profile
                            </a>
                        </li>
                        <li>
                            <a href="https://gso--c.eu2.visual.force.com/ui/setup/Setup?setupid=PersonalSetup" tabindex="-1">
                                <i class="si si-settings pull-right"></i>Settings
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Actions</li>
                        <li>
                            <a href="/" tabindex="-1">
                                <i class="si si-logout pull-right"></i>Exit
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="hidden-md hidden-lg">
                <button class="btn btn-link text-white pull-right" data-class="nav-main-header-o" data-target=".js-nav-main-header" data-toggle="class-toggle" type="button">
                    <i class="fa fa-navicon"></i>
                </button>
            </li>
        </ul>
        <ul class="js-nav-main-header nav-main-header pull-right">
            <li class="text-right hidden-md hidden-lg">
                <button class="btn btn-link text-white" data-class="nav-main-header-o" data-target=".js-nav-main-header" data-toggle="class-toggle" type="button">
                    <i class="fa fa-times"></i>
                </button>
            </li><li>
    <a href="https://gso--c.eu2.visual.force.com/apex/GLBL_SBLD_Home?id=a7Db0000000Caht">Home</a>
</li>

<li>
    <a class="nav-submenu" href="https://gso--c.eu2.visual.force.com/apex/GLBL_SBLD_Page_02?id=a7Db0000000Caht&content=a7Ab0000000TNHN">About Us</a>
    <ul>
        <li>
            <a href="https://gso--c.eu2.visual.force.com/apex/GLBL_SBLD_Page_02?id=a7Db0000000Caht&content=a7Ab0000000TNHN">Goals/Scope</a>
        </li>
        <li>
            <a href="https://gso--c.eu2.visual.force.com/apex/GLBL_SBLD_Team_Section?id=a7Db0000000Caht">Team Members</a>
        </li>
    </ul>
</li>

<li>
    <a href="https://lctportal-idea-repo.herokuapp.com/">Forum</a>
</li>

<li>
    <a href="https://gso--c.eu2.visual.force.com/apex/GLBL_SBLD_Blog_List?id=a7Db0000000Caht">Blog</a>
</li>

<li>
    <a class="nav-submenu" href="https://gso--c.eu2.visual.force.com/apex/GLBL_SBLD_Release_List?id=a7Db0000000Caht">Core (Private)</a>
    <ul>
        <li>
            <a href="https://gso--c.eu2.visual.force.com/apex/GLBL_SBLD_Release_List?id=a7Db0000000Caht">Updates</a>
        </li>
        <li>
            <a href="https://gso--c.eu2.visual.force.com/apex/GLBL_SBLD_Page_01?id=a7Db0000000Caht&amp;content=a7Ab0000000GmmK">Document Library</a>
        </li>
    </ul>
</li>
        </ul>
        <ul class="nav-header pull-left">
            <li class="header-content">
                <a class="h5" href="#"><img src="https://gso--c.eu2.visual.force.com/resource/1470673703000/GLBL_SBLD_Images/assets/img/lillylogo_white.png" alt="Lilly Logo" height="35">
                </a>
            </li>
        </ul>
    </header>
    </span>
   </div>


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