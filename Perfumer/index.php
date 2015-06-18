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
			<table>
				<tr>
					<td><img src="images/butterfly.jpg" width="50" height="50"></td>
					<td><a href="view-details.php?id=1"> Produs 1 </a></td>
				</tr>
				<tr>
					<td><img src="images/butterfly.jpg" width="50" height="50"></td>
					<td><a href="view-details.php?id=2"> Produs 2 </a></td>
				</tr>
				<tr>
					<td><img src="images/butterfly.jpg" width="50" height="50"></td>
					<td><a href="view-details.php?id=2"> Produs 3 </a></td>
				</tr>
				</table>
			</div>
			<div id="rightcolumn">
				<p> Not registered yet?<a href="registration-page.php">Join us now</a></p>
				<h3>Login<h3>
					<?php  
					$login_token = md5( uniqid('auth', true) );

					$_SESSION['login_token'] = $login_token;
					?>
					<div class="validation-form" id="login" method="post">
						<form action="http://localhost/Perfumer/userLogin.php" method="post">

							<table>
								<tr>
									<td>Username:</td>
									<td><input type="text" name="username" value=""></td>
								</tr>
								<tr>
									<td>Password:</td>
									<td><input type="password" name="password" value=""></td>
								</tr>
							</table>
							<input type="hidden" name="login_token" value="<?php echo $login_token; ?>" />
							<input type="submit" name="submit" value="Submit">
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
