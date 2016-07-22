<?php
      //if post is non-empty - i.e. we came to this page via form submission
      if (count($_POST)>0){ 
        //set up db connection
        $db = new PDO('mysql:host=localhost;dbname=idearepo;', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        //insert idea into the database using a prepared statement
        $stmt = $db->prepare('INSERT INTO ideas VALUES (NULL, :title, :descr, :category, 0, "'.date("Y-m-d H:i:s").'")');
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':descr', $desc, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_INT);

        $title = $_POST['title'];
        $desc = $_POST['description'];
        $category = $_POST['category'];
        $stmt->execute();

        //redirect to ideas page with get param set
        header('Location: ideas.php?status=success');
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


      <style type="text/css">
    html{
      margin: 0;
      height: 100%;
      overflow: hidden;
    }
    iframe{
      position: absolute;
      left:0;
      right:0;
      bottom:0;
      top:0;
      border:0;
    }
  </style>
</head>

<body>
    <div class="container-fluid">

      <div class="spacer"></div>


  <iframe id="typeform-full" width="100%" height="100%" frameborder="0" src="https://matt632.typeform.com/to/NJ7wT7"></iframe>
  <script type="text/javascript" src="https://s3-eu-west-1.amazonaws.com/share.typeform.com/embed.js"></script>
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