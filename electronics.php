<?php 
	//This is the home page for logged in users
	session_start();
	require 'default/redirect.php';
	//connecting to the database
	require 'admin/default/database.php';
	//limiting the latest showing products to 5
	$showProducts = $pdo->prepare("SELECT * FROM products_db_table ORDER BY product_id DESC LIMIT 5");
	$showProducts->execute();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ed's Electronics</title>
	<?php require 'default/header.php' ?>
	<?php require 'default/section_users.php'; ?>

	<main>
		<h1>Welcome to Ed's Electronics</h1>
		<p>
			<i>We stock a large variety of electrical goods including phones, tvs, computers and games. Everything comes with at least a one year guarantee and free next day delivery.</i>
		</p>
		<hr/>
		
		<?php require 'default/displayProduct.php'; ?>
	</main>
	<?php require 'default/footer.php'; ?>
</body>
</html>