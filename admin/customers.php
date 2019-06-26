<?php 
	//showing all the customers that signed up for the electronic shop
	session_start();
	require 'default/database.php';
	require 'default/redirect.php';

	//getting all the data from users table database
	$seeCustomers = $pdo->prepare("SELECT * FROM users_db_table WHERE user_role = :user_role");
	$seeCustomerCriteria = [
		'user_role' => "user"
	];
	$seeCustomers->execute($seeCustomerCriteria);
?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<title>CUSTOMERS</title>

 		<?php require 'default/header.php';?>
 		<?php require 'default/section.php';?>

	<main>
 		<div class="customers">
 			<h1>ALL CUSTOMERS</h1>
 			<table border="1px" class="table">
 				<tr>
 					<th>Id</th>
 					<th>First Name</th>
 					<th>Surname</th>
 					<th>User Email Identification</th>
 					<th>Phone Number</th>
 				</tr>
 				<?php 
 					$id=1;
 					foreach($seeCustomers as $dataCustomers){?>
 						<tr>
 							<td><?php echo $id++; ?></td>
 							<td><?php echo $dataCustomers['user_firstname']; ?></td>
 							<td><?php echo $dataCustomers['user_surname']; ?></td>
 							<td><?php echo $dataCustomers['user_email']; ?></td>
 							<td><?php echo $dataCustomers['user_phone']; ?></td>
 						</tr>
 				<?php } ?>
 			</table>
 		</div>

 	</main>
 	<?php require '../default/footer.php'; ?>
 </body>
 </html>