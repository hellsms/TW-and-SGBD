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
			<p> &nbsp;</p>
			<p>NEWS</p>
			<p> &nbsp;</p>
			<p> &nbsp;</p>
        </div>
  <div id="content">
	<?php  
	session_start();
	if(empty($_POST['firstname']) || empty($_POST['lastname'])  || empty($_POST['email'])  || empty($_POST['phone'])  || empty($_POST['address'])  || empty($_POST['username'])  || empty($_POST['password'])  || empty($_POST['confirmation'])  || empty($_POST['password'])  || empty($_POST['register_token'])){
		$message =  "All fields are required!";
	}
	elseif (strlen($_POST['username']) > 100 || strlen($_POST['username']) < 4)
	{
	    $message = 'Incorrect username length';
	}
	elseif (strlen($_POST['password']) > 40 || strlen($_POST['password']) < 4)
	{
	   $message = 'Incorrect password length';
	}
	elseif (ctype_alnum($_POST['username']) != true)
	{
	    $message = 'Username must be alphanumeric';
	}
	elseif (ctype_alnum($_POST['password']) != true)
	{
		$message = 'Password must be alphanumeric';
	}
	elseif ($_POST['password'] != $_POST['confirmation']){
		$message = 'Passwords must match!';
	}
	else
	{
	$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
	$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
	$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
	$phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
	$address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    if(isset($_POST['female'])){
    	$gender = 1;
    }else{
    	$gender = 0;
    }
    $password = sha1($password);
    try{
    $dbh = new PDO('mysql:host=localhost;dbname=perfumer', 'root', '');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $dbh->prepare("INSERT INTO `users_tbl`(`users_id`, `users_pass`, `users_last`, `users_first`, `users_email`, `users_phone`, `users_address`,`users_gender`) VALUES (:username,:password,:lastname,:firstname,:email,:phone,:address,:gender)");

		$stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
		$stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
		$stmt->bindParam(':address', $address, PDO::PARAM_STR);
		$stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
        $stmt->execute();
        unset($_SESSION['register_token']);
        $message = 'Registration succesful!';
    }
    catch(Exception $e)
    {
        if( $e->getCode() == 23000)
        {
            $message = 'Username already exists, please choose another one!';
        }
        else
        {
            $message = 'We were unable to process your request. Please try again later!'.$e;
        }
    }
	}
	echo $message;
?>	

		
	</div>
</div>
        <div id="rightcolumn">
           
        </div>
        <div id="footer">
            <p></p>
        </div>
    </div>
</body>
</html>