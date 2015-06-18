<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Perfumer.ro</title>
</head>
<body>


<?php  
echo '<h3>You are now administrating products.</h3><br>';
try{
	$dbh = new PDO("mysql:host=localhost;dbname=perfumer", 'root', '');

	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $dbh->prepare('SELECT `prod_id`, `prod_name`, `prod_categ_id`, `prod_caracteristics`, `prod_desc`, `prod_stock`, `prod_warr`, `prod_basis_price`, `prod_green_tax`, `prod_price`, `prod_date`, `prod_image` FROM products_tbl');

	$stmt->execute();
	echo "<p><b>View All</b> | <a href='products-paginated.php?page=1'>View Paginated</a></p>";
	
	echo '<table border=1 cellpadding=5>';
	echo '<tr> <th>ID</th> <th>Name</th> <th>Category</th> <th>Description</th> <th>Price</th> <th>Stock</th> <th>Warranty</th> <th>Starting price</th> <th>Tax</th> <th>Full price</th> <th>Date</th> <th>Image</th> <th>Update</th> <th>Delete</th></tr>';
	while($row = $stmt->fetch()){
		echo '<tr>
				<td>'.$row[0].'</td>
				<td>'.$row[1].'</td>
				<td>'.$row[2].'</td>
				<td>'.$row[3].'</td>
				<td>'.$row[4].'</td>
				<td>'.$row[5].'</td>
				<td>'.$row[6].'</td>
				<td>'.$row[7].'</td>
				<td>'.$row[8].'</td>
				<td>'.$row[9].'</td>
				<td>'.$row[10].'</td>
				<td>'.$row[11].'</td>
				<td><a href="edit-products.php?id=' . $row[0] . '"><img src="../images/update.ico" alt="update" height="20" width="20"></a></td>
				<td><a href="delete-products.php?id=' . $row[0] . '"><img src="../images/remove.ico" alt="remove" height="20" width="20"></a></td>
			</tr>';
	}
	echo '</table>';
} catch (PDOException $e) {
	print $e->getMessage();
}
?> 
<p><a href="new-product.php"><img src="../images/add.ico" alt="update" height="20" width="20"> Add a new product</a></p>
<p><a href="index.php"><img src="../images/home.ico" alt="update" height="20" width="20"> Back to admin zone</a></p>
</body>
</html>