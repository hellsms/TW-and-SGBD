<?php
session_start();
require('../../mpdf60/mpdf.php');
if(isset($_POST['submit'])){

	if(isset($_POST['categ_id'])) {
		$categ_id = $_POST['categ_id'];	
		try{
			$dbh = new PDO('mysql:host=localhost;dbname=perfumer', 'root', '');

			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $dbh->prepare("SELECT `prod_name`,`prod_stock` FROM `products_tbl` WHERE prod_categ_id=:id");
			$stmt->bindParam(':id', $categ_id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);

			$mycsv = fopen($categ_id.'.csv', 'w');
			$myhtml = fopen($categ_id.'.html', "w");
			$mpdf=new mPDF();
			$txt = "<html>
						<head>
							<title>
								User table
							</title>
						</head>
						<body>
							<h2>User ".$categ_id." account profile</h2>
							<table border=1 cellpadding=10>
							<tr><th>Product name</th><th>Number available</th></tr>";
			fwrite($myhtml, $txt);

			$mpdf->WriteHTML($txt);
			while($row){
				$prod_name = $row['prod_name'];
				$prod_stocks = $row['prod_stock'];
				$txt = "<tr>
							<td>".$prod_name."</td>
							<td>".$prod_stocks."</td>
						</tr>";

			fputcsv($mycsv, $row);

			fwrite($myhtml, $txt);

			$mpdf->WriteHTML($txt);
			
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
			}
			$txt = "</table>
						</body>
					</html>";

			fwrite($myhtml, $txt);
			$mpdf->WriteHTML($txt);

			fclose($mycsv);
			fclose($myhtml);

			$mpdf->Output($categ_id.'.pdf');
			header('Location:'.$categ_id.'.html');
		} catch (PDOException $e) {
			print $e->getMessage();
		}
	}
}
?>
