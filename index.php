<?php
      //if post is non-empty - i.e. we came to this page via form submission
      if (count($_POST)>0){ 
        //set up db connection
        $db = new PDO('mysql:host=localhost;dbname=idearepo;', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        //insert idea into the database using a prepared statement
        $stmt = $db->prepare('INSERT INTO ideas VALUES (NULL, :title, :description, :usecase, :category, :status, NOW())'); 
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':usecase', $usecase, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);

        $title = $_POST['title'];
        $description = $_POST['description'];
        $usecase = $_POST['usecase'];
        $category = $_POST['category'];
        $status = $_POST['status'];
        $stmt->execute();

        $stmt = $db->query('SELECT pk_id FROM ideas WHERE title ="'.$title.'"');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $result['pk_id'];

        //redirect to ideas page with get param set
        header('Location: ideadetails.php?idea='.$id);
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Idea Repo</title>

    <link rel="stylesheet" href="libraries/bootstrap.min.css">
    <link rel="stylesheet" href="libraries/bootflat.min.css">
<!--     <link rel="stylesheet" href="libraries/font-awesome.min.css"> -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container-fluid">

     <div class="row">
      <div class="col-lg-3 col-md-2 col-sm-1"></div>
      <div class="col-lg-6 col-md-8 col-sm-10">
        <a  class="btn btn-success seeallbutton pull-right"
            href="ideas.php"
            >See all ideas</a>
      </div>
      <div class="col-lg-3 col-md-2 col-sm-1"></div>
    </div>

		<div class="row">
			<div class="col-lg-3 col-md-2 col-sm-1"></div>
			<div class="col-lg-6 col-md-8 col-sm-10">
			   <form action="index.php" method="POST" class="form-horizontal">
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="title">Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Title" name="title" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="5" placeholder="Description" name="description"></textarea>      
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Category</label>
                    <div class="col-sm-6">
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
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-6">
                      <select class="form-control" name="status">
                          <?php
                              $stmt = $db->query('SELECT * FROM status');
                              $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                              //print the ideas
                              foreach($results as $value){ 
                          ?>
                            <option value="<?php echo $value['pk_id']; ?>"><?php echo $value['name']; ?></option>
                          <?php }; ?>
                        </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Use Cases</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="5" name="usecase" placeholder="Add links to further reading materials here"></textarea>      
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary pull-right">Submit</button>

                </form>
			</div>
			<div class="col-lg-3 col-md-2 col-sm-1"></div>
		</div>
	

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