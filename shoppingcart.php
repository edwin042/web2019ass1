<?php 
	//Shopping Cart
	session_start();
	require 'admin/default/database.php';
	require 'default/redirect.php';
	//view all the cart products 
	$showCarts = $pdo->prepare("SELECT * FROM cart_products WHERE cart_user_id = :cartuserid");
	$showCarts->execute($_GET);
	$getId = $showCarts->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Shopping Cart</title>
	<?php require 'default/header.php' ?>
	<?php require 'default/section_users.php'; ?>

	<main>
		<h1>YOUR SHOPPING CART<i class="fa fa-shopping-cart"></i></h1>
		
		<ul class="product_item">
			
			<?php foreach ($showCarts as $cartItems) { ?>
			<li>
				<h3>
					<?php echo $cartItems['cart_name'];?>
				</h3>
				<a style="color:black; float: right;" href="deleteCart.php?deleteCart_id=<?php echo $cartItems['cart_id'] ?>';}">
					<i class="fa fa-close" style="font-size: 36px;"></i>
				</a>
				<p>
					<?php echo $cartItems['cart_description']; ?>
					<br/>
					<strong>Manufacturer: </strong>
					<?php echo $cartItems['cart_manufacturer']; ?>		
				</p>
				<div class="price">
					£<?php echo $cartItems['cart_price']; ?>
				</div>
			</li>
			<?php } ?>
			<a href="checkout.php?cart_userId=<?php echo $getId['cart_user_id']; ?>&cartId=<?php echo $getId['cart_id']; ?>&productPrice=<?php echo $getId['cart_price']; ?>"><button type="submit" class="add-button">Checkout</button></a>
		</ul>
	</main>
	<?php require 'default/footer.php'; ?>
</body>
</html>