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
          	<div class="validation-form" id="register" method="post">
		<h4>Registration</h4>
		<h3>New to Perfumer? Register below!</h3>
		<form action="error-registration.php" method="post">
		<table>
			<tr>
				<td>First Name:</td>
				<td><input type="text" name="firstname" value=""></td>
			</tr>
			<tr>
				<td>Last Name:</td>
				<td><input type="text" name="lastname" value=""></td>
			</tr>
			<tr>
				<td>E-mail address:</td>
				<td><input type="text" name="email" value=""></td>
			</tr>
			<tr>
				<td>Phone number:</td>
				<td><input type="text" name="phone" value=""></td>
			</tr>
			<tr>
				<td>Delivery Address</td>
				<td><input text="text" name="address" value=""></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td><input type="radio" name="female" value="">Female</td>
				<td><input type="radio" name="male" value="">Male</td>
			</tr>
		</table>
		<h3>User account information</h3>
		<table>
			<tr>
				<td>Username:</td>
				<td><input type="text" name="username" value=""></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="password" value=""></td>
			</tr>
			<tr>
				<td>Confirm password:</td>
				<td><input type="password" name="confirmation" value=""></td>
			</tr>
		</table>
		<input type="hidden" name="register_token" value="<?php echo $register_token; ?>" />
		<input type="submit" value="Submit" name="submit">
		</form>
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
