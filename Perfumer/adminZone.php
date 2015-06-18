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
	session_start();
	if(isset($_SESSION['user_id'])){
	echo 'You are now in admin zone.<br>Welcome,'.$_SESSION['user_id'].'!<br>';
	echo '<div id=admincontent>
			<h3>Perfumer administrative desk</h3>
			<a href=../Perfumer/modifyCategories1.php>Modify categories</a><br>
			<a href=../Perfumer/modifyProducts1.php>Modify products</a><br>
			<a href=generateLogsPage.php>Generate logs</a><br>
			<a href=../Perfumer/logout1.php>Logout</a><br>
		</div>';
	}
	else{
		echo 'Please login to continue to administrative zone.';
		echo '<p><a href=../client/login.php>Login</a></p>';
	}
?>

       </div>
        <div id="rightcolumn">
        </div>
        <div id="footer">
            <p></p>
        </div>
    </div>
</body>
</html>

