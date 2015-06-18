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
		echo '<p><a href=self-checkout.php>Buy for yourself</a></p>';
		echo '<p><a href=present-checkout.php>Checkout as present</a></p>';

?>
</div>
		<div id="rightcolumn">
			<?php if(empty($_SESSION['user_id']))
			{
				echo "<p> Not registered yet?<a href=registration-page.php>Join us now</a></p><h3>Login<h3>";
			}
			?><div class="validation-form" id="login" method="post">
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