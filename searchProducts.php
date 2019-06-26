<?php 
	//Search Products
	session_start();
	require 'admin/default/database.php';

	if(isset($_GET['search'])){
		$search_item = $_GET['search_query'];
		//shows the products relavent to the search item
    	$showProducts = $pdo->query("SELECT * FROM products_db_table WHERE product_name LIKE '%$search_item%' OR description LIKE '%$search_item%'");
    	unset($_GET['search']);
	}
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<title>Search Item</title>
 	<?php require 'default/header.php'; ?>
 	<?php require 'default/section_users.php' ?>
 	<main>
 		<h1>SEARCH RESULTS</h1>
 		<?php require 'default/displayProduct.php'; ?>
 	</main>
 	<?php require 'default/footer.php'; ?>
 </body>
 </html>

