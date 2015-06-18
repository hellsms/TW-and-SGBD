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
			$success = false;
			if(empty($_SESSION['user_id'])){
				header('Location:log-in.php');
			}
			if(is_numeric($_REQUEST['id'])){
				try{
					$user_id = $_SESSION['user_id'];
					$dbh = new PDO("mysql:host=localhost;dbname=perfumer", 'root', '');
					$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$incos = 0;
					$stmt = $dbh->prepare("INSERT INTO `basket_tbl` (`prod_id`, `basket_session_id`, `basket_date`, `basket_status`) VALUES (:id,:sid,NOW(),:status)");
					$stmt->bindParam(':id', $_REQUEST['id'], PDO::PARAM_INT);
					$stmt->bindParam(':sid', $user_id, PDO::PARAM_STR);
					$stmt->bindParam(':status', $incos, PDO::PARAM_INT);
					$stmt->execute();
					$success = true;
				}catch (PDOException $e) {
					print $e->getMessage();
				}
				if($success){
					echo '<p>Product has been successfully added to your basket!</p>';
					echo '<p><a href='.$_SERVER['HTTP_REFERER'].'><img src=images/back.ico width=20 height=20></a></p>';
				}
			}
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