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
	session_start();
	$per_page = 3;
	try{
		$user_id = $_SESSION['user_id'];
		$dbh = new PDO("mysql:host=localhost;dbname=perfumer", 'root', '');
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$gender_sql = "SELECT `users_gender` FROM `users_tbl` WHERE users_id=:user_id";
		$stmt = $dbh->prepare($gender_sql);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch();
		$gender = $result[0];
		$stmt = null;
		$result = null;
		$prod_sql = "SELECT * FROM `products_tbl` WHERE prod_desc=:gender";
		$stmt = $dbh->prepare($prod_sql);
		$stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
		$stmt->execute();
		$total_results = $stmt->rowCount();
	}
	catch (PDOException $e) {
	print $e->getMessage();
}

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
	
	echo "<p><b>View Page:</b> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
		echo "<a href='profile.php?page=$i'>$i</a> ";
	}
	echo "</p>";
		
	echo "<table border='1' cellpadding='5'>";
	echo '<tr> <th>ID</th><th>Name</th> <th>Category</th> <th>Description</th> <th>Characteristics</th> <th>Stock</th> <th>Warranty</th> <th>Starting price</th> <th>Tax</th> <th>Full price</th> <th>Date</th> <th>Image</th> </tr>';

	for ($i = $start; $i < $end; $i++)
	{
		if ($i == $total_results) { break; }
		$result = $stmt -> fetch();
		echo "<tr>";
		echo '<td>' . $result[0] . '</td>';
		echo '<td>' . $result[1] . '</td>';
		echo '<td>' . $result[2] . '</td>';
		echo '<td>' . $result[3]. '</td>';
		echo '<td>' . $result[4] . '</td>';
		echo '<td>' .  $result[5] . '</td>';
		echo '<td>' .  $result[6] . '</td>';
		echo '<td>' .  $result[7] . '</td>';
		echo '<td>' .  $result[8] . '</td>';
		echo '<td>' . $result[9] . '</td>';
		echo '<td>' .$result[10]. '</td>';
		echo '<td><img src=../images/' . $result[11] . ' width=50 height=50></td>';
		echo "</tr>"; 
	}
	echo "</table>"; 
	echo '<p><a href=../Perfumer/logout1.php>Logout</a></p>';
	echo '<p><a href=../Perfumer/index.php>Home</a></p>';
	?>
       </div>
        <div id="rightcolumn">
        </div>
        <div id="footer">
            <p></p>
        </div>
    </div>
</body>
</html>

