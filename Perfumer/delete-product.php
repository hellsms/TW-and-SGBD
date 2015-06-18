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

if (isset($_GET['id']) && is_numeric($_GET['id'])){
	try{
		$id = $_GET['id'];
		$dbh = new PDO("mysql:host=localhost;dbname=perfumer", 'root', '');

		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $dbh->prepare('DELETE FROM products_tbl WHERE prod_id=:id');
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		$stmt->execute();

		header("Location: modifyProducts1.php");
	}
	catch (PDOException $e) {
	print $e->getMessage();
	}
}
else{
	header("Location: modifyProducts1.php");
}

?>
</div>
		<p> &nbsp;</p>
			<p> &nbsp;</p>
			<p> &nbsp;</p>	
			<p> &nbsp;</p>	
        </div>
        <div id="footer">
            <p></p>
        </div>
    </div>
</body>
</html>