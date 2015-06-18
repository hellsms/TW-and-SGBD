<?php  
session_start();
$isLoggedIn = false;

if(empty($_POST['username']))
{
	$message = 'Please enter a valid username!';
}

elseif(empty($_POST['password']))
{
	$message = 'Please enter a valid password!';
}

elseif(empty($_POST['login_token']))
{
	$message = 'Please enter valid parameters!';
}	

elseif (strlen($_POST['username']) > 100 || strlen($_POST['username']) < 4)
{
	$message = 'Incorrect username length!';
}

elseif (strlen($_POST['password']) > 40 || strlen($_POST['password']) < 4)
{
	$message = 'Incorrect password length!';
}

elseif (ctype_alnum($_POST['username']) != true)
{
	$message = 'Username must be alphanumeric!';
}

elseif (ctype_alnum($_POST['password']) != true)
{
	$message = 'Password must be alpha numeric!';
}
else
{

	$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

	$password = sha1($password);

	try
	{
		$dbh = new PDO("mysql:host=localhost;dbname=perfumer", 'root', '');

		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		$stmt = $dbh->prepare("SELECT users_id FROM users_tbl 
			WHERE users_id = :username AND users_pass = :password");

		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);

		$stmt->execute();

		$user_id = $stmt->fetchColumn();

		if($user_id == false)
		{
			$message = 'Incorrect username or password!';
		}
		else
		{
			$_SESSION['user_id'] = $user_id;
			$isLoggedIn = true;
			$stmt = $dbh->prepare('SELECT users_account_type FROM users_tbl WHERE users_id = :username');

			$stmt->bindParam(':username', $username, PDO::PARAM_STR);

			$stmt->execute();

			$user_account_type = $stmt->fetchColumn();
			if($user_account_type == 1){
				$_SESSION['admin_id'] = $user_id;
				header('Location:../adminZone.php');
			}else{		
				$message = 'Welcome to perfumer!';
			}

		}

	}
	catch(Exception $e)
	{
		$message = 'We are unable to process your request. Please try again later!';
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		Perfumer.ro
	</title>
</head>
<body>
	<?php
		if($isLoggedIn == false){
			echo '<h3>'.$message.'</h3>';
			echo '<p>Misspelled your info? <a href=login.php>Back to login</a></p>
					<p>Don\'t have an accout? Take a moment and register <a href=register.php>Register</a></p>';
		}else{
			echo '<h4>Perfumer log in page';
			echo '<h3>'.$message.'</h3>';
			echo '<p><a href=logout.php>Logout</a></p>';
			echo '<p><a href=../products/products.php>Browse all products</a></p>';
			echo '<p><a href=../products/profile.php>Recomandations</a></p>';
			echo '<p><a href=../products/user-raport.php>User raports</a></p>';
			echo '<p><a href=../index.php>Home page</a></p>';
		}
	?>
</body>
</html>