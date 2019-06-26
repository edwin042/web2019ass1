<?php 
	session_start();
	require 'admin/default/database.php';
	//getting all the products one by one
	$getProductValues = $pdo->prepare("SELECT * FROM products_db_table WHERE product_id = :cartget_id");
	//getting the id from electronics.php add to cart
	$getCartId = ['cartget_id' => $_GET['cartget_id']];
	$getProductValues->execute($getCartId);
	//assigning the fetched value to new variable
	$viewProductValues = $getProductValues->fetch();
	//Inserting the fetched values to cart_products table
	$addProductsToCart = $pdo->prepare("INSERT INTO cart_products(cart_name,cart_description,cart_price,cart_manufacturer,cart_user_id)
		 VALUES(:product_name,:product_description,:product_price,:manufacturer,:cart_user_id)");
	$cartCriteria = [
		'product_name' => $viewProductValues['product_name'],
		'product_description' => $viewProductValues['description'],
		'product_price' => $viewProductValues['product_price'],
		'manufacturer' => $viewProductValues['manufacturer'],
		'cart_user_id' => $_SESSION['user_sessId']
	];
	if($addProductsToCart->execute($cartCriteria)){
		header('Location:shoppingcart.php?cartuserid=' . $_SESSION['user_sessId']);
	}
?>