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
try{
	$dbh = new PDO("mysql:host=localhost;dbname=perfumer", 'root', '');

	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $dbh->prepare('SELECT categ_id, categ_parent_id, categ_name, categ_desc FROM categories_tbl');

	$stmt->execute();
	echo "<p><b>View All</b> | <a href='paginated-categories.php?page=1'>View Paginated</a></p>";
	
	echo '<table border=1 cellpadding=10>';
	echo '<tr> <th>ID</th> <th>Parent ID</th> <th>Name</th> <th>Description</th> <th>Update</th> <th>Delete</th></tr>';
	while($row = $stmt->fetch()){
		echo '<tr>
				<td>'.$row[0].'</td>
				<td>'.$row[1].'</td>
				<td>'.$row[2].'</td>
				<td>'.$row[3].'</td>
				<td><a href="updateCategory.php?id=' . $row[0] . '"><img src="images/update.ico" alt="update" height="20" width="20"></a></td>
				<td><a href="delete-category.php?id=' . $row[0] . '"><img src="images/remove.ico" alt="remove" height="20" width="20"></a></td>
			</tr>';
	}
	echo '</table>';
} catch (PDOException $e) {
print $e->getMessage();}
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