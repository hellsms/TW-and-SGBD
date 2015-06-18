<?php
	session_start();
	try{
		$user_id = $_SESSION['user_id'];
		$dbh = new PDO("mysql:host=localhost;dbname=perfumer", 'root', '');
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $dbh->prepare("SELECT `users_id`, `quantity_ordered`, `products_purchased`, `date_of_order`, `order_condition` FROM `orders_tbl` WHERE users_id=:id");
			$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);

			$mycsv = fopen($user_id.'.csv', 'w');
			fputcsv($mycsv, $row);
			fclose($mycsv);

			if($row){
				$quantity_ordered = $row['quantity_ordered'];
				$products_ordered = $row['products_purchased'];
				$date_of_order = $row['date_of_order'];
				$order_condition = $row['order_condition'];
				$myhtml = fopen($user_id.'.html', "w");
				$txt = "<html>
						<head>
							<title>
								User table
							</title>
						</head>
						<body>
							<h2>User ".$user_id." account profile</h2>
							<table border=1 cellpadding=10>
							<tr> <th>User id</th> <th>Quantity ordered</th> <th>Products ordered</th> <th>Date</th> <th>Order condition</th></tr>
								<tr>
									<td>
										".$user_id."
									</td>
									<td>
										".$quantity_ordered."
									</td>
									<td>
										".$products_ordered."
									</td>
									<td>
										".$date_of_order."
									</td>
									<td>
										".$order_condition."					
									</td>
									
								</tr>
							</table>
						</body>
					</html>";
			fwrite($myhtml, $txt);
			fclose($myhtml);

			//require('../../mpdf60/mpdf.php');
			//$mpdf=new mPDF();
			
			//$mpdf->WriteHTML($txt);

			//$mpdf->Output($user_id.'.pdf');
			print 'Files have been created!';
			}
			else{
				die('No results!');
			}

		} catch (PDOException $e) {
			print $e->getMessage();
		}
	
?>
<html>
	<head>
		<title>
			
		</title>
	</head>
	<body>
		<table border="1" cellpadding="10">
			<tr> <th>User id</th> <th>Quantity ordered</th> <th>Products ordered</th> <th>Date</th> <th>Order condition</th> </tr>
			<tr>
				<td>
					<?php echo $user_id;?>
				</td>
				<td>
					<?php echo $quantity_ordered;?>
				</td>
				<td>
					<?php echo $products_ordered;?>
				</td>
				<td>
					<?php echo $date_of_order;?>
				</td>
				<td>
					<?php echo $order_condition;?>
				</td>
				
			</tr>
		</table>
	</body>
</html>