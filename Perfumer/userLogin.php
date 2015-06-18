<!DOCTYPE html>
<html>
<head>
<title>Perfumer.ro</title>

<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
    <div id="wrapper">
        <div id="header">
           <img src="images/logo.png">
        </div>
        <div id="navigation">
  			<ul>
				<li><a href="index.php" title="css menus" class="current"><span>Home</span></a></li>
				<li><a href="aboutUs.php" title="css menus"><span>About Us</span></a></li>
				<li><a href="checkbasket.php" title="css menus"><span>Cart</span></a></li>
				<li><a href="products/products-paginated.php" title="css menus"><span>Add products</span></a></li>
				<li><a href="contactUs.php" title="css menus"><span>Contact Us</span></a></li>
				<li><a href="FAQ.php" title="css menus"><span>Currency convertor</span></a></li>
			</ul>
        </div>
        <div id="leftcolumn">
            <p> CATEGORIES</p>
			<p> &nbsp;</p>
			<p> &nbsp;</p>
			<p> &nbsp;</p>
			<p>NEWS</p>
			<p> &nbsp;</p>
			<p> &nbsp;</p>
			<p> &nbsp;</p>
        </div>
        <div id="content">
		<?php  
$isLoggedIn = false;
session_start();
if(isset($_SESSION['user_id'])){
	$isLoggedIn = true;
	$message = "Welcome to perfumer!";
}
elseif(empty($_POST['username']))
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
			$_SESSION['cart_items'] = "";
			$isLoggedIn = true;
			$stmt = $dbh->prepare('SELECT users_account_type FROM users_tbl WHERE users_id = :username');

			$stmt->bindParam(':username', $username, PDO::PARAM_STR);

			$stmt->execute();

			$user_account_type = $stmt->fetchColumn();
			if($user_account_type == 1){
				header('Location:../Perfumer/adminZone.php');
			}else{
				$message = 'Welcome to Perfumer, '.$user_id.'!';
			}

		}

	}
	catch(Exception $e)
	{
		$message = 'We are unable to process your request. Please try again later!';
	}
}
?>
<?php
		if($isLoggedIn == false){
			echo '<h3>'.$message.'</h3>';
			echo '<p>Misspelled your info? <a href=backToLogin.php>Back to login</a></p>
					<p>Don\'t have an accout? Take a moment and register <a href=registration-page.php>Register</a></p>';
		}else{
			echo '<h4>Perfumer log in page</h4>';
			echo '<h3>'.$message.'</h3>';
			echo '<p><a href=orders-user-raports.php>Raport</a></p>';
			echo '<p><a href=products/profile.php>Reccomended products</a></p>';
			echo '<p><a href=products/products-paginated.php>All products</a></p>';
			echo '<p><a href=checkbasket.php>Check basket</a></p>';
			echo '<p><a href=logout1.php>Logout</a></p>';
			echo '<p><a href=index.php>Home page</a></p>';
		}
	?>
       </div>
        <div id="rightcolumn">
           
	</div>
		<p> &nbsp;</p>
			<p> &nbsp;</p>
			<p> &nbsp;</p>	
			<p> &nbsp;</p>	
        </div>
        <div id="footer">
            <p></p>
        </div>
    </div>
</body>
</html>
