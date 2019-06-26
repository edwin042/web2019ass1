<?php 
	//This is home page of not logged in users
	//starting session
	session_start();
	//including database which is inside the admin/default folder
	require 'admin/default/database.php';
	//if there is value in the session then it redirects to the electronics.php which is home page
	if(isset($_SESSION['user_sessId'])){
		header('Location:electronics.php');
	}
	//limiting the latest showing products to 5
	$showProducts = $pdo->prepare("SELECT * FROM products_db_table ORDER BY product_id DESC LIMIT 5");
	$showProducts->execute();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ed's Electronics</title>
	<?php require 'default/header.php'; ?>
	<?php require 'default/section_users.php'; ?>
	<main>
		<h1>Welcome to Ed's Electronics</h1>
		<p><i>We stock a large variety of electrical goods including phones, tvs, computers and games. Everything comes with at least a one year guarantee and free next day delivery.</i></p>
		<hr/>

		<h2>Latest Product lists</h2>
		<?php require 'default/displayProduct.php'; ?>
	</main>
	<?php require 'default/footer.php'; ?>
</body>
</html>