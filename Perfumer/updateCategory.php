<?php

function renderForm($id, $categ_parent_id, $categ_name, $categ_desc, $error){
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
	<h3>Edit category:</h3><br>
		<form action="" method="post">
			<input type="hidden" name="id" value="<?php echo $id; ?>"/>
			<div>
				<table>
					<tr>
						<td>Category parent id:</td>
						<td><input type="text" name="categ_parent_id" value=""></td>
					</tr>
					<tr>
						<td>Category name:</td>
						<td><input type="text" name="categ_name" value=""></td>
					</tr>
					<tr>
						<td>Category description:</td>
						<td><input type="text" name="categ_desc" value=""></td>
					</tr>
					<tr>
						<td><br><input type="submit" name="submit" value="Make changes"></td>
					</tr>
				</table>
			</div>
		</form>
		<p><a href="modifyCategories1.php"><img src="images/back.ico" alt="back" height="20" width="20"> Back to categories zone</a></p>
	</body>
	</html> 
	<?php
}
if(isset($_POST['submit'])){

	if (is_numeric($_POST['id'])) {
		$categ_id = $_POST['id'];
		$categ_parent_id = filter_var($_POST['categ_parent_id'], FILTER_SANITIZE_STRING);
		$categ_name = filter_var($_POST['categ_name'], FILTER_SANITIZE_STRING);
		$categ_desc = filter_var($_POST['categ_desc'], FILTER_SANITIZE_STRING);
		if(empty($_POST['categ_parent_id']) || empty($_POST['categ_name']) || empty($_POST['categ_desc'])){
			$error = 'ERROR: Please fill in all required fields!'; 
			renderForm($id, $categ_parent_id, $categ_name, $categ_desc, $error);
		}
		try{
			$dbh = new PDO('mysql:host=localhost;dbname=perfumer', 'root', '');

			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $dbh->prepare("UPDATE `categories_tbl` SET `categ_parent_id`=:categ_parent_id,`categ_name`=:categ_name,`categ_desc`=:categ_desc WHERE categ_id=:id");
			$stmt->bindParam(':categ_parent_id', $categ_parent_id, PDO::PARAM_INT);
			$stmt->bindParam(':categ_name', $categ_name, PDO::PARAM_STR);
			$stmt->bindParam(':categ_desc', $categ_desc, PDO::PARAM_STR);
			$stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
			$stmt->execute();
			header('Location:modifyCategories1.php');
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

			$stmt = $dbh->prepare("SELECT `categ_id`, `categ_parent_id`, `categ_name`, `categ_desc` FROM `categories_tbl` WHERE categ_id=:id");
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt -> fetch();
			if($row){
				$categ_parent_id = $row[1];
				$categ_name = $row[2];
				$categ_desc = $row[3];
				renderForm($id, $categ_parent_id, $categ_name, $categ_desc, '');
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