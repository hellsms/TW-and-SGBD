<?php

function renderForm($id, $prod_name, $prod_categ_id, $prod_chars, $prod_desc, $prod_stock, $prod_warr, $prod_start, $prod_green, $prod_price, $prod_date, $prod_image, $error){
	?>
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
<h3>Edit product:</h3><br>
		<form action="" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>"/>
			<table>
				<tr>
					<td>Product id:</td>
					<td><input type="text" name="prod_id" value=""></td>
				</tr>
				<tr>
					<td>Product name:</td>
					<td><input type="text" name="prod_name" value=""></td>
				</tr>
				<tr>
					<td>Product category id:</td>
					<td><input type="text" name="prod_categ_id" value=""></td>
				</tr>
				<tr>
					<td>Product characteristics:</td>
					<td><input type="text" name="prod_chars" value=""></td>
				</tr>
				<tr>
					<td>Product description:</td>
					<td><input type="text" name="prod_desc" value=""></td>
				</tr>
				<tr>
					<td>Product stock:</td>
					<td><input type="text" name="prod_stock" value=""></td>
				</tr>
				<tr>
					<td>Product warranty:</td>
					<td><input type="text" name="prod_warr" value=""></td>
				</tr>
				<tr>
					<td>Product starting price:</td>
					<td><input type="text" name="prod_start" value=""></td>
				</tr>
				<tr>
					<td>Product tax price:</td>
					<td><input type="text" name="prod_green" value=""></td>
				</tr>
				<tr>
					<td>Product final price:</td>
					<td><input type="text" name="prod_price" value=""></td>
				</tr>
				<tr>
					<td>Product adding date:</td>
					<td><input type="text" name="prod_date" value=""></td>
				</tr>
				<tr>
					<td>Product image path:</td>
					<td><input type="text" name="prod_image" value=""></td>
				</tr>
				<tr>
					<td><br><input type="submit" name="submit" value="Make changes"></td>
				</tr>
			</table>
		</form>
		<p><a href="modifyProducts1.php"><img src="images/back.ico" alt="back" height="20" width="20"> Back to products zone</a></p>
	</body>
	</html> 
	<?php
}
if(isset($_POST['submit'])){

	if (is_numeric($_POST['id'])) {
		$prod_name = filter_var($_POST['prod_name'], FILTER_SANITIZE_STRING);
		$prod_categ_id = filter_var($_POST['prod_categ_id'], FILTER_SANITIZE_STRING);
		$prod_chars = filter_var($_POST['prod_chars'], FILTER_SANITIZE_STRING);
		$prod_desc = filter_var($_POST['prod_desc'], FILTER_SANITIZE_STRING);
		$prod_stock = filter_var($_POST['prod_stock'], FILTER_SANITIZE_STRING);
		$prod_warr = filter_var($_POST['prod_warr'], FILTER_SANITIZE_STRING);
		$prod_start = filter_var($_POST['prod_start'], FILTER_SANITIZE_STRING);
		$prod_green = filter_var($_POST['prod_green'], FILTER_SANITIZE_STRING);
		$prod_price = filter_var($_POST['prod_price'], FILTER_SANITIZE_STRING);
		$prod_date = filter_var($_POST['prod_date'], FILTER_SANITIZE_STRING);
		$prod_image = filter_var($_POST['prod_image'], FILTER_SANITIZE_STRING);
		if(empty($_POST['prod_categ_id']) || empty($_POST['prod_name']) || empty($_POST['prod_desc']) || empty($_POST['prod_stock']) || empty($_POST['prod_warr']) || empty($_POST['prod_start'])|| empty($_POST['prod_green'])|| empty($_POST['prod_price'])|| empty($_POST['prod_date']) || empty($_POST['prod_image'])){
			$error = 'ERROR: Please fill in all required fields!'; 
			renderForm($id, $prod_name, $prod_categ_id, $prod_chars, $prod_desc, $prod_stock, $prod_warr, $prod_start, $prod_green, $prod_price, $prod_date, $prod_image, $error);
		}
		try{
			$dbh = new PDO('mysql:host=localhost;dbname=perfumer', 'root', '');

			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $dbh->prepare("UPDATE `products_tbl` SET `prod_id`=:id,`prod_name`=:prod_name,`prod_categ_id`=:prod_categ_id,`prod_caracteristics`=:prod_caracteristics,`prod_desc`=:prod_desc,`prod_stock`=:prod_stock,`prod_warr`=:prod_warr,`prod_basis_price`=:prod_start,`prod_green_tax`=:prod_green,`prod_price`=:prod_price,`prod_date`=:prod_date,`prod_image`=:prod_image WHERE prod_id=:id");
			$stmt->bindParam(':prod_categ_id', $prod_categ_id, PDO::PARAM_INT);
			$stmt->bindParam(':prod_name', $prod_name, PDO::PARAM_STR);
			$stmt->bindParam(':prod_desc', $prod_desc, PDO::PARAM_STR);
			$stmt->bindParam(':prod_caracteristics', $prod_chars, PDO::PARAM_STR);
			$stmt->bindParam(':prod_stock', $prod_stock, PDO::PARAM_INT);
			$stmt->bindParam(':prod_warr', $prod_warr, PDO::PARAM_STR);
			$stmt->bindParam(':prod_start', $prod_start, PDO::PARAM_STR);
			$stmt->bindParam(':prod_green', $prod_green, PDO::PARAM_STR);
			$stmt->bindParam(':prod_price', $prod_price, PDO::PARAM_STR);
			$stmt->bindParam(':prod_date', $prod_date, PDO::PARAM_STR);
			$stmt->bindParam(':prod_image', $prod_image, PDO::PARAM_STR);
			$stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
			$stmt->execute();
			header('Location:modifyProducts1.php');
		} catch (PDOException $e) {
			print $e->getMessage();
		}
	}
}else{
	if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
	{
		$id = $_GET['id'];
		try{
			$dbh = new PDO('mysql:host=localhost;dbname=perfumer', 'root', '');

			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $dbh->prepare("SELECT `prod_id`, `prod_name`, `prod_categ_id`, `prod_caracteristics`, `prod_desc`, `prod_stock`, `prod_warr`, `prod_basis_price`, `prod_green_tax`, `prod_price`, `prod_date`, `prod_image` FROM `products_tbl` WHERE prod_id=:id");
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt -> fetch();
			if($row){
				$prod_name = $row[1];
				$prod_categ_id = $row[2];
				$prod_chars = $row[3];
				$prod_desc = $row[4];
				$prod_stock = $row[5];
				$prod_warr = $row[6];
				$prod_start = $row[7];
				$prod_green = $row[8];
				$prod_price = $row[9];
				$prod_date = $row[10];
				$prod_image = $row[11];
				renderForm($id, $prod_name, $prod_categ_id, $prod_chars, $prod_desc, $prod_stock, $prod_warr, $prod_start, $prod_green, $prod_price, $prod_date, $prod_image, '');
			}
			else{
				echo "No results!";
			}

		} catch (PDOException $e) {
			print $e->getMessage();
		}
	}
	else
	{
		echo 'Error!';
	}
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