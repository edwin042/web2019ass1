<?php 
	session_start();
	require 'admin/default/database.php';
	/*
		shows the products only of respective categories
	*/
	$showProducts = $pdo->prepare("SELECT * FROM products_db_table WHERE category_id = :category_id");
	$clickedCriteria = ['category_id'=>$_GET['categoryId']];
	$showProducts->execute($clickedCriteria);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
 	<title>Products</title>
 	<?php require 'default/header.php'; ?>
	<?php require 'default/section_users.php'; ?>

	<main>
		<h2>Products:</h2>
		<?php require 'default/displayProduct.php'; ?>
	</main>
	
	<?php require 'default/footer.php'; ?>
</body>
</html>