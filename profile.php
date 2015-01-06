<?php
require('session.php');
require('user.php');
$user = new User();
if (!$user->isLoggedIn()){
header('location: login.php');
exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Oki-Doki -  <?php echo $user->First_name; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="profile/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="profile/css/full-width-pics.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                <a class="navbar-brand" href="#">Oki-Doki</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="blogs.php">Newsfeed</a>
                    </li>
                    <li>
                        <a href="blogpost.php">New Post</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Full Width Image Header with Logo -->
    <!-- Image backgrounds are set within the full-width-pics.css file. -->
    <!--******************************************RETRIEVE AND DISPLAY PROFILE PIC*********************************************-->
    <?php $img="uploads/profile_".$user->_id.".jpg"; ?>
    <header class="image-bg-fluid-height">
        <img class="img-responsive img-center" src="<?php echo $img; ?>" alt="">
		
		<a href="profile1.php">Upload Profile Picture</a>
		<?php
		$m=new Mongo();
		$db=$m->selectDB('myblogsite');
		$gridFS = $db->getGridFS();
		//echo $user->_id;
		$test=$gridFS->findOne(array("_id" =>$user->_id));
		$filedata=$gridFS->findOne(array("_id" => $user->_id))->getBytes();
		header("Content-Length: ".strlen($filedata));
		header("Content-Type: ".$test->file["contentType"]);
		//ob_clean();
		$img="uploads/profile_".$user->_id.".jpg";
		$fp=fopen($img,"w");
		fwrite($fp,$filedata);
		fclose($fp);
		?>	
    </header>
	<!--**************************PROFILE PIC DISPLAY COMPLETE**************************************-->
    <!-- Content Section -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="section-heading">Hello! <?php echo $user->First_name." ";echo $user->Last_name;?></h1>
                    <p class="lead section-lead">Username: <?php echo $user->username?></p>
                    <p class="lead section-lead">Email: <?php echo $user->Email_id?></p>
                    <p class="lead section-lead">Mobile Number: <?php echo $user->Mobile?></p>
                    <p class="lead section-lead">Address: <?php echo $user->Address?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Fixed Height Image Aside -->
    <!-- Image backgrounds are set within the full-width-pics.css file. -->
    <aside class="image-bg-fixed-height"></aside>
    
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Oki-Doki.com 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </footer>

    <!-- jQuery Version 1.11.0 -->
    <script src="profile/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="profile/js/bootstrap.min.js"></script>

</body>

</html>


