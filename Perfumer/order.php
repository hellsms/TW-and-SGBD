<?php session_start();?>

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
			if(empty($_POST['email']) || empty($_POST['password'])  || empty($_POST['confirmation'])){
				$message =  "All fields are required!";
			}
			elseif (strlen($_POST['password']) > 40 || strlen($_POST['password']) < 4)
			{
				$message = 'Incorrect password length';
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
				$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
				$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
				$password = sha1($password);

				$dbh = new PDO('mysql:host=localhost;dbname=perfumer', 'root', '');
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				if(isset($_POST['address'])) {
					$condition = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
				}else{
					try{
						$stmt = $dbh->prepare("SELECT `users_address` FROM `users_tbl` WHERE users_id=:id");
						$stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_STR);
						$stmt->execute();
						$row = $stmt->fetch(); 
						$condition = $row[0];
						if($stmt->rowCount() < 1){
							$errors = $stmt->errorInfo();
							print $errors;
						}
					}
					catch(Exception $e)
					{
						$message = 'We were unable to process your request. Please try again later!'.$e;
					}
				}
				try{
					$stmt = $dbh->prepare("INSERT INTO `orders_tbl`(`users_id`, `quantity_ordered`, `products_purchased`, `date_of_order`, `order_condition`, `order_price`) VALUES (:user,:quantity,:id,NOW(),:condition,:price)");
					$stmt->bindParam(':user', $_SESSION['user_id'], PDO::PARAM_STR);
					$stmt->bindParam(':id', $GLOBALS['ids'], PDO::PARAM_STR);
					$stmt->bindParam(':quantity', $GLOBALS['quantity'], PDO::PARAM_INT);
					$stmt->bindParam(':condition', $condition, PDO::PARAM_STR);
					$stmt->bindParam(':price', $GLOBALS['price'], PDO::PARAM_INT);

					$stmt->execute();
					if($stmt->rowCount() < 1){
						$errors = $stmt->errorInfo();
						print $errors[0].$errors[1].$errors[2];
					}
					echo'<p>Order registration completed!</p>';
				}
					catch(Exception $e)
					{
						$message = 'We were unable to process your request. Please try again later!'.$e;
					}
					try{
						$stmt = $dbh->prepare("UPDATE `basket_tbl` SET `basket_status` = 1 WHERE basket_session_id=:id");
						$stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_STR);

						$stmt->execute();
						if($stmt->rowCount() < 1){
							$errors = $stmt->errorInfo();
							print $errors[0].$errors[1].$errors[2];
						}
						$message = 'Your cart has been updated!';
					}
					catch(Exception $e)
					{
						$message = 'We were unable to process your request. Please try again later!'.$e;
					}
				}
				echo $message;
					?>

				</div>
				<div id="rightcolumn">
					<?php if(empty($_SESSION['user_id']))
					{
						echo "<p> Not registered yet?<a href=registration-page.php>Join us now</a></p><h3>Login<h3>";
					}
					?>
					<div class="validation-form" id="login" method="post">
						<form action="http://localhost/Perfumer/userLogin.php" method="post">

							<table>
								<?php if(empty($_SESSION['user_id'])){
									echo "<tr>
									<td>Username:</td>
									<td><input type=text name=username value=></td>
								</tr>
								<tr>
									<td>Password:</td>
									<td><input type=password name=password value=></td>
								</tr>";
							}else{
								echo "<tr> Welcome to Perfumer,". $_SESSION['user_id']."!";
							}?>

						</table>
						<input type="hidden" name="login_token" value="<?php echo $login_token; ?>" />
						<?php if(empty($_SESSION['user_id'])){
							echo "<input type=submit name=submit value=Submit>";
						}else{
							echo "<a href=userLogin.php>Profile page</a>";
						}
						?>
					</form>
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
