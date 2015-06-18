<?php
session_start();
if(isset($_POST['submit'])){

	if(isset($_POST['user_id'])) {
		$user_id = $_POST['user_id'];	
		try{
			$dbh = new PDO('mysql:host=localhost;dbname=perfumer', 'root', '');

			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $dbh->prepare("SELECT `users_id`, `users_pass`, `users_account_type`, `users_last`, `users_first`, `users_email`, `users_phone`, `users_address` FROM `users_tbl` WHERE users_id=:id");
			$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);

			$mycsv = fopen($user_id.'.csv', 'w');
			fputcsv($mycsv, $row);
			fclose($mycsv);

			if($row){
				$user_acc = $row['users_account_type'];
				$user_last = $row['users_last'];
				$user_first = $row['users_first'];
				$user_email = $row['users_email'];
				$user_phone = $row['users_phone'];
				$user_address =$row['users_address'];
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
							<tr> <th>User id</th> <th>User account type</th> <th>Last name</th> <th>First name</th> <th>Email</th> <th>Phone</th> <th>Address</th></tr>
								<tr>
									<td>
										".$user_id."
									</td>
									<td>
										".$user_acc."
									</td>
									<td>
										".$user_last."
									</td>
									<td>
										".$user_first."
									</td>
									<td>
										".$user_email."					
									</td>
									<td>
										".$user_phone."
									</td>
									<td>
										".$user_address."
									</td>
								</tr>
							</table>
						</body>
					</html>";
			fwrite($myhtml, $txt);
			fclose($myhtml);

			require('../../mpdf60/mpdf.php');
			$mpdf=new mPDF();
			
			$mpdf->WriteHTML($txt);

			$mpdf->Output($user_id.'.pdf');
			print 'Files have been created!';
			}
			else{
				die('No results!');
			}

		} catch (PDOException $e) {
			print $e->getMessage();
		}
	}
}
?>
<html>
	<head>
		<title>
			
		</title>
	</head>
	<body>
		<table border="1" cellpadding="10">
			<tr> <th>User id</th> <th>User account type</th> <th>Last name</th> <th>First name</th> <th>Email</th> <th>Phone</th> <th>Address</th></tr>
			<tr>
				<td>
					<?php echo $user_id;?>
				</td>
				<td>
					<?php echo $user_acc;?>
				</td>
				<td>
					<?php echo $user_last;?>
				</td>
				<td>
					<?php echo $user_first;?>
				</td>
				<td>
					<?php echo $user_email;?>
				</td>
				<td>
					<?php echo $user_phone;?>
				</td>
				<td>
					<?php echo $user_address;?>
				</td>
			</tr>
		</table>
	</body>
</html>