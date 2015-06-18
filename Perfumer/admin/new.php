<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Perfumer.ro</title>
</head>
<body>
	<h3>Add a new category:</h3><br>
	<div class="verification-form" id="addcategory" method="post">
		<form name="addform" action="" method="post">
			<table>
				<tr>
					<td>Category id:</td>
					<td><input type="text" name="categ_id" value=""></td>
				</tr>
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
					<td><br><input type="submit" name="submit" value="Add category"></td>
				</tr>
			</table>
		</form>
	</div>
	
	<?php  
	if(empty($_POST['submit'])){
		echo'<p><a href="categories.php"><img src="../images/back.ico" alt="back" height="20" width="20"> Back to categories zone</a></p>
			</body>
		</html>';
		die();
	}
	if(empty($_POST['categ_id']) || empty($_POST['categ_parent_id']) || empty($_POST['categ_name']) || empty($_POST['categ_desc'])){
		print 'All fields are required!';
	}elseif($_POST['categ_id'] < 0 || $_POST['categ_id'] > 9999999999 || $_POST['categ_parent_id'] < 0 || $_POST['categ_parent_id'] > 9999999999){
		print 'Invalid id format!';
	}elseif(strlen($_POST['categ_name']) > 50 || strlen($_POST['categ_name']) < 4){
		print 'Invalid category name!';
	}elseif(strlen($_POST['categ_desc']) > 200 || strlen($_POST['categ_desc']) < 4){
		print 'Invalid category description!';
	}
try{
	$dbh = new PDO('mysql:host=localhost;dbname=perfumer', 'root', '');

	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $dbh->prepare("INSERT INTO `categories_tbl`(`categ_id`, `categ_parent_id`, `categ_name`, `categ_desc`) VALUES (:categ_id,:categ_parent_id,:categ_name,:categ_desc)");
		$stmt->bindParam(':categ_id', $_POST['categ_id'], PDO::PARAM_INT);
		$stmt->bindParam(':categ_parent_id', $_POST['categ_parent_id'], PDO::PARAM_INT);
		$stmt->bindParam(':categ_name', $_POST['categ_name'], PDO::PARAM_STR);
		$stmt->bindParam(':categ_desc', $_POST['categ_desc'], PDO::PARAM_STR);
		$stmt->execute();

	} catch (PDOException $e) {
		print $e->getMessage();
	}
	?> 
	<p><a href="categories.php"><img src="../images/back.ico" alt="back" height="20" width="20"> Back to categories zone</a></p>

</body>
</html>