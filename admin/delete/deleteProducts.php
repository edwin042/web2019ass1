<?php 
	//delete the products
	session_start();
	require '../default/database.php';
	if (isset($_GET['delete_id'])) {
		$deleteProducts =  $pdo->prepare("DELETE FROM products_db_table WHERE product_id= :delete_id");
		$deleteCriteria=['delete_id' => $_GET['delete_id']];
		if($deleteProducts->execute($deleteCriteria))
		{
			echo '<script>alert("Your Product is deleted!!");document.location="../products.php";</script>';
		}
		else
			echo '<script>alert("PRODUCT DELETE UNSUCCESSFULL 404 error!!");document.location="../products.php";</script>';
	}
 ?>