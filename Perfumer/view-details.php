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
				<li><a href="cart.php" title="css menus"><span>Cart</span></a></li>
				<li><a href="products.php" title="css menus"><span>Add products</span></a></li>
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
			$success = false;
			$per_page = 3;
			try{
				$dbh = new PDO("mysql:host=localhost;dbname=perfumer", 'root', '');
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $dbh->prepare('SELECT `prod_id`, `prod_name`, `prod_categ_id`, `prod_caracteristics`, `prod_desc`, `prod_stock`, `prod_warr`, `prod_basis_price`, `prod_green_tax`, `prod_price`, `prod_date`, `prod_image` FROM products_tbl WHERE prod_id=:id');
				$stmt->bindParam(':id', $_REQUEST['id'], PDO::PARAM_STR);
				$stmt->execute();

			}catch (PDOException $e) {
				print $e->getMessage();
			}
			echo "<h3>Products details:</h3>";

			echo '<table cell-padding:5px>';
			while($row = $stmt->fetch()){
			echo '<tr> <th>ID : </th> <th>'.$row[0].'</th></tr> <tr> <th> Name: </th><th>'.$row[1].'</th></tr> <tr> <th> Category: </th><th>'.$row[2].'</th></tr><tr> <th> Description: </th><th>'.$row[3].'</th></tr> <tr> <th> Type: </th><th>'.$row[4].'</th></tr><tr> <th> Stock: </th><th>'.$row[5].'</th></tr> <tr> <th> Warranty: </th><th>'.$row[6].'</th></tr> <tr> <th> Starting price: </th><th>'.$row[7].'</th></tr> <tr> <th> Tax: </th><th>'.$row[8].'</th></tr> <tr> <th> Full price: </th><th>'.$row[9].'</th></tr><tr> <th> Date: </th><th>'.$row[10].'</th></tr> <tr> <th> Image : </th><th>'.$row[11].'</th></tr> ';
			}
			
		echo '</table>';
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