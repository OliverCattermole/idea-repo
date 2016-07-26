<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="submitstyle.css">

	</head>
<body>

<!-- multistep form -->
<form id="msform" action="submit1.php" method="POST">
	<!-- progressbar -->
	<ul id="progressbar">
		<li class="active">Category</li>
		<li>Title</li>
		<li>Details/Links</li>
	</ul>
	<!-- fieldsets -->
	<fieldset>
		<h2 class="fs-title">What kind of idea do you have?</h2>
		<h3 class="fs-subtitle">Pick the category which best fits your idea</h3>
		<select class="form-control" name="category">
                          <?php
                              $db = new PDO('mysql:host=localhost;dbname=idearepo;', 'root', '');
                              $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                              $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
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
		<h2 class="fs-title">Social Profiles</h2>
		<h3 class="fs-subtitle">Your presence on the social network</h3>
		<input type="text" name="twitter" placeholder="Twitter" />
		<input type="text" name="facebook" placeholder="Facebook" />
		<input type="text" name="gplus" placeholder="Google Plus" />
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="button" name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Personal Details</h2>
		<h3 class="fs-subtitle">We will never sell it</h3>
		<input type="text" name="fname" placeholder="First Name" />
		<input type="text" name="lname" placeholder="Last Name" />
		<input type="text" name="phone" placeholder="Phone" />
		<textarea name="address" placeholder="Address"></textarea>
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="submit" name="submit" class="submit action-button" value="Submit" />
	</fieldset>
</form>


<script src="libraries/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="libraries/jquery.easing.min.js" type="text/javascript"></script> 
<script src="submit.js"></script>
</body>
</html>