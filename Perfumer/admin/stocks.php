<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Perfumer.ro</title>
</head>
<body>
	<h3>Generating stock reports:</h3><br>
	<form action="generate-stocks.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>"/>
		<div>
			<table>
				<tr>
					<td>Enter the category name:</td>
					<td><input type="text" name="categ_id" value=""></td>
				</tr>
				<tr>
					<td><br><input type="submit" name="submit" value="View report"></td>
				</tr>
			</table>
		</div>
	</form>
	<?php  
	session_start();
	?>
	<p><a href="index.php"><img src="../images/home.ico" alt="update" height="20" width="20"> Back to admin zone</a></p>
</body>
</html>
