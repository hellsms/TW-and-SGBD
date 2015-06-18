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
		echo "<a href='paginated-categories.php?page=$i'>$i</a> ";
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
		echo '<td><a href="updateCategories.php?id=' . mysqli_result($result, $i, 'categ_id') . '"><img src="images/update.ico" alt="remove" height="20" width="20"></a></td>';
		echo '<td><a href="delete-category.php?id=' . mysqli_result($result, $i, 'categ_id') . '"><img src="images/remove.ico" alt="remove" height="20" width="20"></a></td>';
		echo "</tr>"; 
	}
	echo "</table>"; 
	mysqli_free_result($result);
	mysqli_close($con);
	?>
	<p><a href="new-category.php"><img src="images/add.ico" alt="update" height="20" width="20"> Add a new category</a></p>
	<p><a href="adminZone.php"><img src="images/home.ico" alt="update" height="20" width="20"> Back to admin zone</a></p>
        </div>
        <div id="footer">
            <p></p>
        </div>
    </div>
</body>
</html>
