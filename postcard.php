<?php
require_once "php/db_connect.php";
require_once "php/functions.php";

if(isset($_POST['name']) && isset($_POST['title']) && isset($_POST['text']))
{    
    $name = sanitizeString($db, $_POST['name']);
    $title = sanitizeString($db, $_POST['title']);
    $text = sanitizeString($db, $_POST['text']);
    $filter = sanitizeString($db, $_POST['hiddenfield']);
    
    $time = $_SERVER['REQUEST_TIME'];
	$file_name = $time . '.jpg';

    if ($_FILES)
    {
        $tmp_name = $_FILES['upload']['name'];
        $dstFolder = 'users';
        move_uploaded_file($_FILES['upload']['tmp_name'], $dstFolder . DIRECTORY_SEPARATOR . $file_name);
        //echo "Uploaded image '$file_name'<br /><img src='$dstFolder/$file_name'/>";
    }

    SavePostToDB($db, $name, $title, $text, $time, $file_name, $filter);
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
	<title>Image sharing wall</title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
    
    <link rel="stylesheet" href="css/styles.css">
    
    <link rel="stylesheet" href="css/portfolio.css">
	
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://lamp.cse.fau.edu/~eknapp2015">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="http://lamp.cse.fau.edu/~eknapp2015/homework8/">Upload Images</a>
                    </li>
                    <li>
                        <a href="http://lamp.cse.fau.edu/~eknapp2015/homework8/postcard.php">View Image Gallery</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="container">
    
    	        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">~Photo Gallery~
                </h1>
            </div>
        </div>
        
        <?php echo getPostcards($db); ?>
    </div>
</body>



<?php $db->close(); ?>