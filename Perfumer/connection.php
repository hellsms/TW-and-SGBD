<?php  
    $server="localhost"; 
    $user="root"; 
    $pass=""; 
    $db="perfumer"; 
    $connection = new mysqli($server, $user, $pass, $db);
    if(!$connection){
    	die('Could not connect: ' .mysqli_connect_errno());
    }else{
    	$connection->select_db($db);
    }
?>