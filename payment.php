<?php 
	session_start();
	require 'admin/default/database.php';
	require 'default/redirect.php';
	if(isset($_POST['pay'])){
		/*
			Updating the values of the shipping table
		*/
		$updatePayment = $pdo->prepare("UPDATE shipping
			SET payment = :payment WHERE shipping_user_id = :uid");
		$updatePaymentCriteria = [
			'payment' => $_POST['payment'],
			'uid' => $_GET['uid']
		];
		if($updatePayment->execute($updatePaymentCriteria)){
			echo '<script>alert("Thank you for your payment! We will contact you as soon as possible!");document.location="electronics.php"</script>';
		}else{
			echo "Transaction Unsuccessful";
		}
	}
	//delete all the shipping if canceled
	if(isset($_POST['cancel'])){
		$dropShipping = $pdo->prepare("DELETE FROM shipping WHERE shipping_user_id = :uid");
		$deleteCriteria = ['uid' => $_GET['uid']];
		if($dropShipping->execute($deleteCriteria)){
			header('Location:electronics.php');
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Payment</title>
	<?php require 'default/header.php'; ?>
	<?php require 'default/section_users.php'; ?>
	<main>
		<h1>Payment</h1>
		<div>Your Total Amount is: <?php echo $_GET['p']; ?></div>
		<br/><br/>
		<form action="" method="POST">

			<input type="hidden" name="payment" value="yes"/>
			<input class="add-button" type="submit" name="pay" value="Pay" />
			<input class="add-button" type="submit" name="cancel" value="Cancel Payment"/>
		</form>
	</main>
	<?php require 'default/footer.php'; ?>
</body>
</html>