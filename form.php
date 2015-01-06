<?php
$action = (!empty($_POST['btn_submit']) && ($_POST['btn_submit'] === 'Save')) ? 'save_article': 'show_form';
switch($action){
	case 'save_article':
		try {
			$connection = new Mongo();
			$database = $connection->selectDB('myblogsite');
			$collection = $database->selectCollection('users');
			$article= array();
			$article['First_name']= $_POST['Fname'];
			$article['Last_name'] = $_POST['Lname'];
			$article['username']= $_POST['username'];
			$article['password']= md5($_POST['password']);
			$article['Mobile']= $_POST['Mobile'];
			$article['Email_id']= $_POST['email'];
			$article['Address']= $_POST['address'];
			} catch(MongoConnectionException $e) {
				die("Failed to connect to database ".$e->getMessage());
			}
			catch(MongoException $e) {
					die('Failed to insert data '.$e->getMessage());
					}
		break;
	case 'show_form':
	default:
	}


?>
<html> 
<head>
<link rel="stylesheet" href="style.css"/>
<title>Oki-Doki</title>
</head>
<body>
<div id="contentarea">
<div id="innercontentarea">
	
<h1>Registration Form</h1>
<?php if ($action === 'show_form'): ?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

<h3>* First Name</h3>
<p>
<input type="text" name="Fname" >
</p>

<h3>Last Name</h3>
<p>
<input type="text" name="Lname" >
</p>
	
<h3>* Username</h3>
<p>
<input type="text" name="username" >
</p>	
	
<h3>* Password</h3>
<p>
<input type="password" name="password" >
</p>	

<h3>* Confirm Password</h3>
<p>
<input type="password" name="password_again" >
</p>	

<h3>Mobile No.</h3>	
<p>
<input type="text" name="Mobile" >
</p>

<h3>* Email id</h3>	
<p>
<input type="text" name="email" >
</p>

<h3>Address</h3>	
<p>
<textarea type="text" name="address" rows="5"></textarea>
</p>


<p>
<input type="submit" name="btn_submit" value="Save"/>
</p>
</form>

<?php else: ?>
<h2>
<?php 							
	

if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password_again']) || empty($_POST['email']) )#|| empty($_POST['first_name']) )
	{
			echo "* marked fields are compulsary.";
		?>			
				<a href="form.php">Write another one?</a>
		<?php	
	}

else
	{
		
		if($_POST['password'] != $_POST['password_again'] )
				{
					echo "Passwords do not match..!!! ";
					?>			
						<a href="form.php">Write another one?</a>
					<?php	
				}	
		else
			{
				$collection->insert($article);
				echo "You are Registered Succesfully." ;
					?>			
						<a href="login.php"> Login</a>
					<?php		
			}	
	  }			
?>
	
</h2>
	
<?php endif;?>
</div>
</div>
</body>
</html>			
		
