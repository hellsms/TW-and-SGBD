<?php

if (isset($_GET['id']) && is_numeric($_GET['id'])){
	try{
		$id = $_GET['id'];
		$dbh = new PDO("mysql:host=localhost;dbname=perfumer", 'root', '');

		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $dbh->prepare('DELETE FROM categories_tbl WHERE categ_id=:id');
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		$stmt->execute();

		header("Location: categories.php");
	}
	catch (PDOException $e) {
	print $e->getMessage();
	}
}
else{
	header("Location: categories.php");
}

?>