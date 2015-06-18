<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Perfumer.ro</title>
</head>
<body>
	<h3>Add a new product:</h3><br>
	<div class="verification-form" id="addproduct" method="post">
		<form name="addform" action="" method="post">
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
					<td>Product image:</td>
					<td><input type="text" name="prod_image" value=""></td>
				</tr>
				<tr>
					<td><br><input type="submit" name="submit" value="Add product"></td>
				</tr>
			</table>
		</form>
	</div>
	
	<?php  
	if(empty($_POST['submit'])){
		echo'<p><a href="products.php"><img src="images/back.ico" alt="back" height="20" width="20"> Back to products zone</a></p>
			</body>
		</html>';
		die();
	}
	if(empty($_POST['prod_id']) || empty($_POST['prod_categ_id']) || empty($_POST['prod_name']) || empty($_POST['prod_desc']) || empty($_POST['prod_warr']) || empty($_POST['prod_date']) || empty($_POST['prod_image']) || empty($_POST['prod_price']) || empty($_POST['prod_start']) || empty($_POST['prod_stock']) || empty($_POST['prod_green']) || empty($_POST['prod_chars'])){
		print 'All fields are required!';
	}elseif($_POST['prod_id'] < 0 || $_POST['prod_id'] > 9999999999 || $_POST['prod_categ_id'] < 0 || $_POST['prod_categ_id'] > 9999999999){
		print 'Invalid id format!';
	}elseif(strlen($_POST['prod_name']) > 50 || strlen($_POST['prod_name']) < 4){
		print 'Invalid product name!';
	}elseif(strlen($_POST['prod_desc']) > 200 || strlen($_POST['prod_desc']) < 4){
		print 'Invalid product description!';
	}
try{
	$dbh = new PDO('mysql:host=localhost;dbname=perfumer', 'root', '');

	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $dbh->prepare("INSERT INTO `products_tbl`(`prod_id`,`prod_name`, `prod_categ_id`, `prod_caracteristics`, `prod_desc`, `prod_stock`, `prod_warr`, `prod_basis_price`, `prod_green_tax`, `prod_price`, `prod_date`, `prod_image`) VALUES (:prod_id,:prod_name,:prod_categ_id,:prod_chars,:prod_desc,:prod_stock,:prod_warr,:prod_start,:prod_green,:prod_price,:prod_date,:prod_image)");
		$stmt->bindParam(':prod_id', $_POST['prod_id'], PDO::PARAM_INT);
		$stmt->bindParam(':prod_name', $_POST['prod_name'], PDO::PARAM_STR);
		$stmt->bindParam(':prod_categ_id', $_POST['prod_categ_id'], PDO::PARAM_INT);
		$stmt->bindParam(':prod_desc', $_POST['prod_desc'], PDO::PARAM_STR);
		$stmt->bindParam(':prod_chars', $_POST['prod_chars'], PDO::PARAM_STR);
		$stmt->bindParam(':prod_stock', $_POST['prod_stock'], PDO::PARAM_INT);
		$stmt->bindParam(':prod_warr', $_POST['prod_warr'], PDO::PARAM_STR);
		$stmt->bindParam(':prod_start', $_POST['prod_start'], PDO::PARAM_STR);
		$stmt->bindParam(':prod_green', $_POST['prod_green'], PDO::PARAM_STR);
		$stmt->bindParam(':prod_price', $_POST['prod_price'], PDO::PARAM_STR);
		$stmt->bindParam(':prod_date', $_POST['prod_date'], PDO::PARAM_STR);
		$stmt->bindParam(':prod_image', $_POST['prod_image'], PDO::PARAM_STR);
		$stmt->execute();
	} catch (PDOException $e) {
		print $e->getMessage();
	}
	?> 
	<p><a href="http://localhost//Perfumer/modifyProducts1.php"><img src="images/back.ico" alt="back" height="20" width="20"> Back to products zone</a></p>

</body>
</html>