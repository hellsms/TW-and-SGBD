<html>
<head>
<title>Perfumer.ro</title>
</head>
<body>
<?php
	session_start();
	if(isset($_SESSION['user_id'])){
		echo '<p>You have been logged out successfully!</p>';
		session_unset($_SESSION);
		session_destroy($_SESSION);
	}else{
		//header('Location:../index.php');
		echo '<p>You are not logged in!</p>';
	}

?>
	<div>
		<a href="index.php">Home</a>
		<a href="login.php">Log in again</a>
	</div>
</body>
</html>