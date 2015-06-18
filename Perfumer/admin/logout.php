<?php  
	session_start();
	$_SESSION = array();
	session_unset($_SESSION);
	session_destroy();
	header('Location:../index.php');
?>
