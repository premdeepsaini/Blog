<?php 
			require('session.php');
			require('user.php');
			$user = new User();
			if (!$user->isLoggedIn()){
			header('location: login.php');
			exit;
			}
$action = (!empty($_POST['btn_submit']) && ($_POST['btn_submit'] === 'Save')) ? 'save_article' : 'show_form';

switch ($action) {
	case 'save_article':
		try {
			
			$connection = new Mongo();
			$database 	= $connection->selectDB('myblogsite');
			$collection	= $database->selectCollection('articles');
			
			$article = array(
				
				'name' 		=> $_POST['name'],
				'title' 	=> $user->First_name,
				'content' 	=> $_POST['content'],
				'tags' 		=> $_POST['tags'],
				'saved_at' 	=> new MongoDate()
			);

			// inserting safe=true array will make php to wait for mongoDB till its finished! default safe=false
			try {
				$collection->insert($article, array('safe' => True));
				echo "insert operation complete";	
			} catch (MongoCursorException $e) {
				die("Insert failed " . $e->getMessage());
			} 
			
		} catch (MongoConnectionException $e) {
			die("Failed to connect to database " . $e->getMessage());
		} catch (MongoException $e) {
			die("Failed to insert data " . $e->getMessage());
		}
		break;
	
	case 'show_form':
	default:
		# code...
		break;
	}
?>

<html>
<head>
	<link rel="stylesheet" href="style.css">
	<title>Blog Post Creator</title>
</head>
<body>
	<div id="contentarea" class="">
		<div id="innercontentarea" class="">
			<h1>New Post </h1>
			<?php if ($action === 'show_form'): ?>
				<form method="post" action="blogpost.php">
					
					<h2><?php echo $user->First_name;?></h2>
					<?php  $titl=$user->First_name; ?>
					<h3>Content</h3>
					<textarea name="content" rows="20"></textarea>
					<h3>Tags</h3>
					<p><input type="text" name="tags" id="tags"></p>
					<p><input type="submit" name="btn_submit" value="Save"></p>
				</form>
			<?php else: ?>
				<p>
					Article saved. _id: <?php echo $article['_id']; ?>.
					<a href="blogpost.php">Wirte another one?</a>
				</p>
			<?php endif; ?>
		</div>
	</div>
</body>
</html>
