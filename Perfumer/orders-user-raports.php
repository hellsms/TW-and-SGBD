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
	session_start();
	try{
		$user_id = $_SESSION['user_id'];
		$dbh = new PDO("mysql:host=localhost;dbname=perfumer", 'root', '');
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $dbh->prepare("SELECT `users_id`, `quantity_ordered`, `products_purchased`, `date_of_order`, `order_condition` FROM `orders_tbl` WHERE users_id=:id");
			$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);

			$mycsv = fopen($user_id.'orders.csv', 'w');
			fputcsv($mycsv, $row);
			fclose($mycsv);
			$myhtml = fopen($user_id.'orders.html', "w");

			if($row){
				$quantity_ordered = $row['quantity_ordered'];
				$products_ordered = $row['products_purchased'];
				$date_of_order = $row['date_of_order'];
				$order_condition = $row['order_condition'];


				$myhtml = fopen($user_id.'orders.html', "w");						

				$txt ="		<head>
							<title>
								User table
							</title>
						</head>
						<body>
							<h2>User ".$user_id." orders</h2>
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

			require('../mpdf60/mpdf.php');
			$mpdf=new mPDF();
			
			$mpdf->WriteHTML($txt);

			$mpdf->Output($user_id.'orders.pdf');
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
       </div>
        <div id="rightcolumn">
            
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
