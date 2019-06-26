<?php 
	session_start();
	//connecting to the database
	require 'default/database.php';
	require 'default/redirect.php';
	if(isset($_POST['filter']))
	{	
		/*
			Displays the shipping details along with the user_firstname by using join query
		*/
		$shippingData = $pdo->prepare("SELECT shipping_id, shipping_address, quantity, shipping_price, payment, user_firstname, shipping_status 
			FROM shipping 
			INNER JOIN users_db_table 
			WHERE shipping.shipping_user_id = users_db_table.user_id 
			AND shipping_status = :shipping_status");
		$searchCriteria = [ 
			'shipping_status' => $_POST['search_status'] ];
		$shippingData->execute($searchCriteria);
	}
	else if(isset($_POST['nofilter'])||!isset($_POST['filter']))
	{	
		$shippingData = $pdo->prepare("SELECT shipping_id, shipping_address, quantity, shipping_price, payment, user_firstname, shipping_status FROM shipping INNER JOIN users_db_table WHERE shipping.shipping_user_id = users_db_table.user_id");
		$shippingData->execute();
	}
	else
	{
		echo "ERROR";
	}
	

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Shipping Details</title>
	<?php require 'default/header.php'; ?>
	<?php require 'default/section.php'; ?>
	<main>
		<h1>Shipping Details</h1>

		<form action="" method="POST">
			<h3>FILTER SHIPPING DETAILS BY STATUS</h3>
			<select class="field-input" name="search_status">
				<option value="shipped">Shipped</option>
				<option value="pending">Pending</option>
			</select>
			<input class="add-button" type="submit" name="filter" value="Filter Search"/>
			<input class="add-button" type="submit" name="nofilter" value="Filter OFF"/>
		</form>

		<table border="1px" class="table">
			<tr>
				<th>Shipping Id</th>
				<th>Shipping Address</th>
				<th>Quantity</th>
				<th>Shipping Price</th>
				<th>Payment Status</th>
				<th>User Name</th>
				<th>Shipping Status</th>
				<th>Manage Status</th>
			</tr>
			<?php $sid = 1; //displays all the details of the shipping table and first name of the user table
			foreach ($shippingData as $shippingDataRow) { ?>
			<tr>
				<td><?php echo $sid++; ?></td>
				<td><?php echo $shippingDataRow['shipping_address'] ?></td>
				<td><?php echo $shippingDataRow['quantity'] ?></td>
				<td><?php echo $shippingDataRow['shipping_price'] ?></td>
				<td><?php echo $shippingDataRow['payment'] ?></td>
				<td><?php echo $shippingDataRow['user_firstname'] ?></td>
				<td><?php echo $shippingDataRow['shipping_status'] ?></td>
				<td><a href="edit_shipping.php?shipping_id=<?php echo $shippingDataRow['shipping_id'];?>">Manage</a></td>
			</tr>
			<?php } ?>
		</table>
	</main>
	<?php require '../default/footer.php'; ?>
</body>
</html>