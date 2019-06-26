<?php 
	session_start();
	require 'default/database.php';
	require 'default/redirect.php';
	if(isset($_POST['submit']))
	{
		/*
			Update the values of the shipping after edited
		*/
		$manageShippingStatus = $pdo->prepare("UPDATE shipping SET shipping_status = :shipping_status WHERE shipping_id =:shipping_id ");
		$manageCriteria = [
			'shipping_status' => $_POST['shipping_status'],
			'shipping_id' 	  => $_GET['shipping_id']
		];
		if($manageShippingStatus->execute($manageCriteria))
			header('Location:shipping.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Manage Shipping</title>
	<?php require 'default/header.php'; ?>
	<?php require 'default/section.php'; ?>
	
	<main>
		<h1>Edit Shipping Status</h1>
		<form action="" method="POST">
			<label>Shipping Status</label>
				<select class="field-input" name="shipping_status">
					<option value="shipped">Shipped</option>
					<option value="pending">Pending</option>
				</select>
			<input class="add-button" type="submit" name="submit" value="Submit"/>
		</form>
	</main>
	
	<?php require '../default/footer.php'; ?>
</body>
</html>