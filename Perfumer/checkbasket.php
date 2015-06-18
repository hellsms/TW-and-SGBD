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
			if(empty($_SESSION['user_id'])){
				echo '<p>You are not logged in!</p>';
			}else{
				$success = false;
				$per_page = 3;
				try{
					$user_id = $_SESSION['user_id'];
					$dbh = new PDO("mysql:host=localhost;dbname=perfumer", 'root', '');
					$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $dbh->prepare("SELECT `basket_id`,`prod_id`,`basket_date`,`prod_price` FROM `basket_tbl` WHERE `basket_session_id` = :id AND `basket_status` = 0 ORDER BY `basket_id`");
					$stmt->bindParam(':id', $user_id, PDO::PARAM_STR);
					$stmt->execute();
					$success = true;
					$total_results = $stmt->rowCount();
				}catch (PDOException $e) {
					print $e->getMessage();
				}
				if($total_results == 0){
					echo '<p>There are no perfumes in the cart!</p>';
				}else{
					echo '<h3>Perfumes currently in the cart</h3>';
					echo "<table border='1' cellpadding='10'>";
					echo '<tr> <th>Basket ID</th> <th>Product ID</th> <th>Quantity</th> <th>Price</th> <th>Add date</th></tr>';
					$GLOBALS['quantity'] = 0;
					$GLOBALS['price'] = 0;
					$GLOBALS['ids'] = '';
					for ($i = 0; $i < $total_results; $i++)
					{
						if ($i == $total_results) { break; }
						$result = $stmt -> fetch();
						$GLOBALS['quantity'] += 1;
						$GLOBALS['price'] += $result[3];
						$GLOBALS['ids'] .= $result[0].',';
						echo "<tr>";
						echo '<td>' . $result[0] . '</td>';
						echo '<td>' . $result[1] . '</td>';
						echo '<td>1</td>';
						echo '<td>' . $result[3]. '</td>';
						echo '<td>' . $result[2]. '</td>';
						echo "</tr>"; 
					}
					echo "</table>";
					echo "<p><a href='checkout.php'>Checkout!</a></p>";
					$GLOBALS['ids'] = rtrim($GLOBALS['ids'],','	);
				}}
				?>
			</div>
			<div id="rightcolumn">
				<?php 
				if(empty($_SESSION['user_id']))
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