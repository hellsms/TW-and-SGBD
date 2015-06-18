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
if(isset($_POST['submit'])){

	if(isset($_POST['user_id'])) {
		$user_id = $_POST['user_id'];	
		try{
			$dbh = new PDO('mysql:host=localhost;dbname=perfumer', 'root', '');

			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $dbh->prepare("SELECT `users_id`, `users_pass`, `users_account_type`, `users_last`, `users_first`, `users_email`, `users_phone`, `users_address` FROM `users_tbl` WHERE users_id=:id");
			$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt -> fetch();
			if($row){
				$user_acc = $row[2];
				$user_last = $row[3];
				$user_first = $row[4];
				$user_email = $row[5];
				$user_phone = $row[6];
				$user_address =$row[7];
				$myfile = fopen($user_id.'.html', "w");
				$txt = "<html>
						<head>
							<title>
								User table
							</title>
						</head>
						<body>
							<table border=1 cellpadding=10>
							<tr> <th>User id</th> <th>User account type</th> <th>Last name</th> <th>First name</th> <th>Email</th> <th>Phone</th> <th>Address</th></tr>
								<tr>
									<td>
										".$user_id."
									</td>
									<td>
										".$user_acc."
									</td>
									<td>
										".$user_last."
									</td>
									<td>
										".$user_first."
									</td>
									<td>
										".$user_email."					
									</td>
									<td>
										".$user_phone."
									</td>
									<td>
										".$user_address."
									</td>
								</tr>
							</table>
						</body>
					</html>";
				fwrite($myfile, $txt);
				fclose($myfile);
				echo '<p> &nbsp;</p>	';
				print 'File has been created!';
				echo '<p> &nbsp;</p>	';
			}
			else{
				echo '<p> &nbsp;</p>	';
				die('No results!');
			}

		} catch (PDOException $e) {
			print $e->getMessage();
		}
	}
}
?>
<table border="1" cellpadding="10">
			<tr> <th>User id</th> <th>User account type</th> <th>Last name</th> <th>First name</th> <th>Email</th> <th>Phone</th> <th>Address</th></tr>
			<tr>
				<td>
					<?php echo $user_id;?>
				</td>
				<td>
					<?php echo $user_acc;?>
				</td>
				<td>
					<?php echo $user_last;?>
				</td>
				<td>
					<?php echo $user_first;?>
				</td>
				<td>
					<?php echo $user_email;?>
				</td>
				<td>
					<?php echo $user_phone;?>
				</td>
				<td>
					<?php echo $user_address;?>
				</td>
			</tr>
		</table>
		<p><a href="adminZone.php"><img src="images/home.ico" alt="update" height="20" width="20"> Back to admin zone</a></p>
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