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
			echo '<div class="leftPanelBody">
							<div class="contentText"></div>
							<div class="mag1">&nbsp;&nbsp;&nbsp;1 EUR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.4882 RON<br>&nbsp;&nbsp;&nbsp;1 USD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.9358 RON</div><br><br>
							<img src="./Imagini/sageata2.gif" alt=""> <strong>Convertor valutar</strong>
							<form action="" method="post">
								<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Introdu suma:
								<input name="suma" id="suma" type="text" value="" class="field1" size="10"><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Din:&nbsp;&nbsp;     
								<select name="din" id="din">
									<option value="RON" selected="selected">RON</option>
									<option value="EUR">EUR</option>					  
									<option value="USD">USD</option>	
								</select><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;In:&nbsp;&nbsp;&nbsp;&nbsp;     
								<select name="in" id="in">
									<option value="RON" selected="selected">RON</option>
									<option value="EUR">EUR</option>					  
									<option value="USD">USD</option>	
								</select><br>
								<div align="left" style="margin-right:10px; margin-top:5px"><input type="submit" value="Converteste" class="button1"></div>
							</form>
							<div>Rezultat:';
			include("curs.php");
			echo '<label name="res" id="res">';
								if(empty($_POST['suma'])){
									$label = '';
								}
								if(isset($_POST["suma"]))
								{
									$suma = $_POST["suma"];
									$din = $_POST["din"];
									$in = $_POST["in"];
									if(is_numeric($suma) != true)
										$label = '';
									else
									{
									if($din == 'RON')
									{
										if($in == 'RON')
											$label = $suma;
										else 
											if($in == 'EUR')
												$label = $suma / $eur;
											else
												$label = $suma / $usd;
									}
									else
										if($din == 'EUR')
										{
											if($in == 'RON')
												$label = $suma * $eur;
											else 
												if($in == 'EUR')
													$label = $suma;
												else
													$label = $suma * $eur / $usd;
										}
										else
											if($din == 'USD')
											{
												if($in == 'RON')
													$label = $suma * $usd;
												else 
													if($in == 'EUR')
														$label = $suma * $usd / $eur;
													else
														$label = $suma;
											}
									$label = number_format($label, 3);
									}
								}
								echo $label.' '.$in; echo '</label></div>';
		?>
		</div>
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
