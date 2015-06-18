<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Perfumer.ro</title>
</head>
<body>
	<h3>You are now administrating categories.</h3><br>
	<?php
	function mysqli_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
	}
	session_start();
	$per_page = 3;
	$con = mysqli_connect("localhost","root","","perfumer");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$sql = "SELECT * FROM categories_tbl";
	$result = mysqli_query($con, $sql);
	$total_results = mysqli_num_rows($result);
	$total_pages = ceil($total_results / $per_page);

	if (isset($_GET['page']) && is_numeric($_GET['page']))
	{
		$show_page = $_GET['page'];
		
		if ($show_page > 0 && $show_page <= $total_pages)
		{
			$start = ($show_page -1) * $per_page;
			$end = $start + $per_page; 
		}
		else
		{
			$start = 0;
			$end = $per_page; 
		}		
	}
	else
	{
		$start = 0;
		$end = $per_page; 
	}
	
	echo "<p><a href='categories.php'>View All</a> | <b>View Page:</b> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
		echo "<a href='categories-paginated.php?page=$i'>$i</a> ";
	}
	echo "</p>";

	echo "<table border='1' cellpadding='10'>";
	echo '<tr> <th>ID</th> <th>Parent ID</th> <th>Name</th> <th>Description</th> <th>Update</th> <th>Delete</th></tr>';

	for ($i = $start; $i < $end; $i++)
	{
		if ($i == $total_results) { break; }

		echo "<tr>";
		echo '<td>' . mysqli_result($result, $i, 'categ_id') . '</td>';
		echo '<td>' . mysqli_result($result, $i, 'categ_parent_id') . '</td>';
		echo '<td>' . mysqli_result($result, $i, 'categ_name') . '</td>';
		echo '<td>' . mysqli_result($result, $i, 'categ_desc') . '</td>';
		echo '<td><a href="edit-categories.php?id=' . mysqli_result($result, $i, 'categ_id') . '"><img src="../images/update.ico" alt="remove" height="20" width="20"></a></td>';
		echo '<td><a href="delete-categories.php?id=' . mysqli_result($result, $i, 'categ_id') . '"><img src="../images/remove.ico" alt="remove" height="20" width="20"></a></td>';
		echo "</tr>"; 
	}
	echo "</table>"; 
	mysqli_free_result($result);
	mysqli_close($con);
	?>
	<p><a href="new-category.php"><img src="../images/add.ico" alt="update" height="20" width="20"> Add a new category</a></p>
	<p><a href="index.php"><img src="../images/home.ico" alt="update" height="20" width="20"> Back to admin zone</a></p>
</body>
</html>