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
		<div id="tcenter">
		   <h2>Perfumer team</h2></div>
           <p>Perfumer is an online encyclopedia of perfumes, perfume magazine and a community of perfume lovers. Perfumer informs their readers about new perfume launches, about famous fragrances and less-known but wonderful scents. Together we travel in time and space, where perfumes are the shining stars we use to navigate. We learn about their history, we discover far-away places and respectfully explore the life we see around us, always taking time to be amazed by Nature. Perfumer is a place to learn from each other and relax in the company of your soul mates. </p>
		   <div id="tcenter"><img src="images/about.jpg" ></div>
       </div>
        <div id="rightcolumn">
            <p> Not registered yet?<a href="registration-page.php">Join us now</a></p>
			<h3>Login<h3>
			<?php  
	session_start();

	$login_token = md5( uniqid('auth', true) );

	$_SESSION['login_token'] = $login_token;
?>
<form action="client/logging.php" method="post">
		
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
		<input type="submit" name="submit" value="Login">
		</form>
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
