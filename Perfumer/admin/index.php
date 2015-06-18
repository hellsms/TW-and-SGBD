<?php  
	session_start();
	if(isset($_SESSION['user_id'])){
	echo 'You are now in admin zone.<br>Welcome, '.$_SESSION['user_id'].'!<br>';
	echo '<div id=admincontent>
			<h3>Perfumer administrative desk</h3>
			<a href=categories.php>Modify categories</a><br>
			<a href=products.php>Modify products</a><br>
			<a href=generatelogs.php>Generate logs</a><br>
			<a href=../client/logout.php>Logout</a><br>
		</div>';
	}
	else{
		echo 'Please login to continue to administrative zone.';
		echo '<p><a href=../client/login.php>Login</a></p>';
	}
?>
