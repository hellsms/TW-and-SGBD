<!DOCTYPE html>
<html>
<head>
<title>Perfumer.ro</title>

<link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
    <div id="wrapper">
        <div id="header">
           <img src="../images/logo.png">
        </div>
        <div id="navigation">
            <ul>
				<li><a href="../index.php" title="css menus" class="current"><span>Home</span></a></li>
				<li><a href="../aboutUs.php" title="css menus"><span>About Us</span></a></li>
				<li><a href="../checkbasket.php" title="css menus"><span>Cart</span></a></li>
				<li><a href="products-paginated.php" title="css menus"><span>Add products</span></a></li>
				<li><a href="../contactUs.php" title="css menus"><span>Contact Us</span></a></li>	
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
	function mysqli_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
	    if ($numrows && $row <= ($numrows-1) && $row >=0){
	        mysqli_data_seek($res,$row);
	        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
	        if (isset($resrow[$col])){
	            return $resrow[$col];
	        }
	    }
	}
	session_start();
	$per_page = 3;
	$con = mysqli_connect("localhost","root","","perfumer");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$sql = "SELECT * FROM products_tbl";
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
	
	echo "<p><b>View Page:</b> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
		echo "<a href='products-paginated.php?page=$i'>$i</a> ";
	}
	echo "</p>";
		
	echo "<table border='1' cellpadding='5'>";
	echo '<tr> <th>ID</th><th>Name</th> <th>Category</th> <th>Description</th> <th>Characteristics</th> <th>Stock</th> <th>Warranty</th> <th>Starting price</th> <th>Tax</th> <th>Full price</th> <th>Date</th> <th>Image</th> <th>Add to cart</th></tr>';

	for ($i = $start; $i < $end; $i++)
	{
		if ($i == $total_results) { break; }
	
		echo "<tr>";
		echo '<td>' . mysqli_result($result, $i, 'prod_id') . '</td>';
		echo '<td>' . mysqli_result($result, $i, 'prod_name') . '</td>';
		echo '<td>' . mysqli_result($result, $i, 'prod_categ_id') . '</td>';
		echo '<td>' . mysqli_result($result, $i, 'prod_desc') . '</td>';
		echo '<td>' . mysqli_result($result, $i, 'prod_caracteristics') . '</td>';
		echo '<td>' . mysqli_result($result, $i, 'prod_stock') . '</td>';
		echo '<td>' . mysqli_result($result, $i, 'prod_warr') . '</td>';
		echo '<td>' . mysqli_result($result, $i, 'prod_basis_price') . '</td>';
		echo '<td>' . mysqli_result($result, $i, 'prod_green_tax') . '</td>';
		echo '<td>' . mysqli_result($result, $i, 'prod_price') . '</td>';
		echo '<td>' . mysqli_result($result, $i, 'prod_date') . '</td>';
		echo '<td><img src=../images/' . mysqli_result($result, $i, 'prod_image') . ' width=50 height=50></td>';
		echo "<td><a href=../add_perfume.php?id=".mysqli_result($result, $i, 'prod_id')."><img src='../images/add.ico' width=20 height=20></a></td>";
		echo "</tr>"; 
	}
	echo "</table>"; 
	echo "<p><a href=../client/logout.php><img src='../images/remove.ico' width=20 height=20>Logout</a></p>";
	echo "<p><a href=../userLogin.php><img src='../images/back.ico' width=20 height=20>Profile page</a></p>";
	echo "<p><a href=../index.php><img src='../images/home.ico' width=20 height=20>Home</a></p>";
	
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