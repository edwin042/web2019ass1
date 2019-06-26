<?php
	session_start();
	//connecting to the database
	require 'admin/default/database.php';
	if(isset($_GET['deleteCart_id'])){
		/*
			Deleting the products from the cart_products table
		*/
		$deleteCartProducts = $pdo->prepare("DELETE FROM cart_products WHERE cart_id = :deleteCart_id");
		$deleteCriteria = ['deleteCart_id' => $_GET['deleteCart_id']];
		if($deleteCartProducts->execute($deleteCriteria)){
			//redirects to the shoppingcart page
			header('Location:shoppingcart.php?cartuserid=' . $_SESSION['user_sessId']);
		}
	}
?>