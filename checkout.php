<?php 
	session_start();
	//connecting to the database
	require 'admin/default/database.php';
	require 'default/redirect.php';

	//showing the products of table cart_products
	$cart_shipping = $pdo->prepare("SELECT * FROM cart_products WHERE cart_user_id = " . $_GET['cart_userId']);
	$cart_shipping->execute();

	if(isset($_POST['checkout_now'])){
		/*
			Inserting the values in the shipping table
		*/
		$insertShipping = $pdo->prepare("INSERT INTO shipping(shipping_address, quantity, cart_id, shipping_price, shipping_user_id,payment, shipping_status)
		VALUES(:shipping_address, :quantity, :cart_id, :shipping_price, :shipping_user_id, :payment, :shipping_status)");
		$shipCriteria = [
			'shipping_address' => $_POST['shipping_address'],
			'quantity'         => $_POST['quantity'],
			'cart_id'          => $_GET['cartId'],
			'shipping_price'   => $_POST['total_price'],
			'shipping_user_id' => $_GET['cart_userId'],
			'payment'		   => $_POST['payment'],
			'shipping_status'  => $_POST['shipping_status']
		];
		if($insertShipping->execute($shipCriteria)){
			header('Location:payment.php?p='.$_POST['total_price']. '&uid=' . $_GET['cart_userId']);
		}
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Shipping Address</title>
		<?php require 'default/header.php'; ?>
		<?php require 'default/section_users.php'; ?>
		<main>
			<form action="" method="POST">
				<label>Full Shipping Address: </label>
					<input class="field-input" type="text" name="shipping_address"/>

				<label>Products</label>
					<ol>
						<?php foreach ($cart_shipping as $cartRows) { ?>
							<li class="field-input"><?php echo $cartRows['cart_name']; ?></li>
						<?php } ?>
					</ol>

				<label>Quantity</label>
					<input class="field-input" type="number" name="quantity" value="1"/>		

				<label>Unit Price</label>
				<?php $unit_price = $_GET['productPrice']; ?>
					<input class="field-input" type="number" name="unit_price" value="<?php echo $unit_price; ?>" readonly/>

				<label>Total Price</label>
					<input class="field-input" type="number" name="total_price" value="<?php echo $unit_price*1.1 ?>" readonly/>
				<input type="hidden" name="payment" value="no"/>
				<input type="hidden" name="shipping_status" value="pending"/>
				<input class="add-button" type="submit" name="checkout_now" value="CheckOut">
			</form>	
		</main>
	<?php require 'default/footer.php'; ?>
</body>
</html>