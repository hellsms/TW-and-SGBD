<?php  
	session_start();

	$register_token = md5( uniqid('auth', true) );

	$_SESSION['register_token'] = $register_token;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Perfumer.ro</title>
</head>
<body>
	<div class="validation-form" id="register" method="post">
		<h4>Registration</h4>
		<h3>New to Perfumer? Register below!</h3>
		<form action="registering.php" method="post">
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
</body>
</html>

