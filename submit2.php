<?php
      //if post is non-empty - i.e. we came to this page via form submission
      if (count($_POST)>0){
        //set up db connection
        include 'includes/setupdbconn.php';

        //insert idea into the database using a prepared statement
        $stmt = $db->prepare('INSERT INTO ideas VALUES (NULL, :title, :description, :usecase, :category, 1, NOW())');
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':usecase', $usecase, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_INT);

        $title = $_POST['title'];
        $description = $_POST['description'];
        $usecase = $_POST['usecase'];
        $category = $_POST['category'];
        $stmt->execute();

        $stmt = $db->query('SELECT pk_id FROM ideas WHERE title ="'.$title.'"');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $result['pk_id'];

        //send email notification
        //include 'sendmail.php';


        //redirect to ideas page with get param set
        header('Location: ideadetails.php?idea='.$id);
    };
?>

<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootflat.min.css">
<!--     <link rel="stylesheet" href="libraries/font-awesome.min.css"> -->
    	<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/submitstyle.css">
        <link rel="stylesheet" href="css/sitebuilder.css">


	</head>
<body>

<!-- multistep form -->
<form id="msform" action="submit2.php" method="POST">
<a class="btn btn-success"
        href="index.php"
        style="margin-top:-50px;"
        >See all ideas</a>
	<!-- progressbar -->
	<ul id="progressbar">
		<li class="active">Category</li>
		<li>Title</li>
		<li>Details</li>
	</ul>
	<!-- fieldsets -->
	<fieldset>
		<h2 class="fs-title">What kind of idea do you have?</h2>
		<h3 class="fs-subtitle">Pick the category which best fits your idea</h3>
		<select class="form-control" name="category">
              <?php
                  include 'includes/setupdbconn.php';
                  $stmt = $db->query('SELECT * FROM category');
                  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  //print the ideas
                  foreach($results as $value){
              ?>
                <option value="<?php echo $value['pk_id']; ?>"><?php echo $value['name']; ?></option>
              <?php }; ?>
         </select>
		<input type="button" name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">What's the idea?</h2>
		<h3 class="fs-subtitle">Give your idea a title</h3>
		<input type="text" class="form-control" id="title" placeholder="Title" name="title" required>
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="button" id="titlenext" name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Describe your idea</h2>
		<h3 class="fs-subtitle">Add some detail here</h3>
		<textarea class="form-control" rows="5" placeholder="Description" name="description"></textarea>
		<textarea style="display:none;" class="form-control" rows="5" name="usecase" placeholder="Optionally give a sample use case for your app"></textarea>
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="submit" name="submit" class="submit action-button" value="Submit" />
	</fieldset>

	<!-- <div style="position:; margin-top:50px;"><a class="btn btn-success seeallbutton pull-right" href="index.php">See all ideas</a></div> -->
</form>

<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="js/jquery.easing.min.js" type="text/javascript"></script>
<script src="js/submit.js"></script>
</body>
</html>
