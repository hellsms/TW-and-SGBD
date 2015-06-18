<?php  
	session_start();

	$login_token = md5( uniqid('auth', true) );

	$_SESSION['login_token'] = $login_token;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Perfumer.ro</title>
</head>
<body>
	<div class="validation-form" id="login" method="post">
		<h4>Access your account</h4>
		<h3>Already registered?</h3>
		<form action="logging.php" method="post">
		<h3>Fill in your account information</h3>
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
</body>
</html>