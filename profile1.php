<?php
require('session.php');
require('user.php');
$user = new User();
if (!$user->isLoggedIn()){
header('location: login.php');
exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="style.css" />
<title>Welcome <?php echo $user->Username; ?></title>
</head>
<body>
<div id="contentarea">
<div id="innercontentarea">
<a style="float:right;" href="logout.php">Log out</a>
<a style="float:right;" href="blogs.php">Newsfeed</a>
<a style="float:right;" href="blogpost.php">New Post</a>
<h1>Hello <?php echo $user->First_name; ?></h1>
<ul class="profile-list">
<li>

<span class="field">username:</span>
<span class="value">
<?php echo $user->username; ?>
</span>
<div class="clear"> </div>
</li>
<li>
<span class="field">Name:</span>
<span class="value">
<?php echo $user->First_name; ?>
</span>
<div class="clear"> </div>
</li>
<li>
<span class="field">Email address:</span>
<span class="value">
<?php echo $user->Email_id; ?>
</span>
<div class="clear"> </div>
</li>
<li>
<span class="field">Address:</span>
<span class="value">
<?php echo $user->Address; ?>
</span>
<div class="clear"> </div>
</li>
<li>
<span class="field">Mobile number:</span>
<span class="value">
<?php echo $user->Mobile; ?>
</span>
<div class="clear"> </div>
</li>
</ul>
</div>
</div>

<form method="POST" enctype="multipart/form-data">
    <label for="username">Username:</label>
    <?php echo $user->username; ?>

    <label for="pic">Please upload a profile picture:</label>
    <input type="file" name="pic" id="pic" />

    <input type="submit" /><br/>
    <h2>
    <a href="profile.php">Go Back To Profile</a>
    </h2>
</form>
<?php
		$m = new Mongo();
		$gridfs = $m->selectDB('myblogsite')->getGridFS();
		$gridfs->storeUpload('pic', array("_id"=>$user->_id));
		echo "Upload Successful";
	?>
</body>
</html>


