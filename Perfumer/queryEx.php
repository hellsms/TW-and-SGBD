<?php
	require_once("connection.php");
	$sql = "SELECT * FROM users_tbl";
	$query=mysql_query($sql); 
    echo '<table>';
    while ($row=mysql_fetch_array($query)) { 
        echo '<tr>';
            echo '<td>'.$row['users_id'].'</td>';
            echo '<td>'.$row['users_pass'].'</td>';
        echo '</tr>';
    }
    echo '</table>';
?>