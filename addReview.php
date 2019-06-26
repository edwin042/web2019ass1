<?php 
	//add reviews in user page
	session_start();
	require 'admin/default/database.php';
	require 'default/redirect.php';
	//getting product id from the href in categories
	$getProductId = $pdo->prepare("SELECT * FROM products_db_table WHERE product_id = :product_id");
	$getProductId->execute($_GET);
	//fetching the product from clicked button
	$fetchProductId = $getProductId->fetch();

	if(isset($_POST['review'])){
		//insert the values in the review_products table
		$insertReview = $pdo->prepare("INSERT INTO review_products(review_desc, product_id, user_id, display_name,status,review_date) VALUES (:review_desc,:product_id, :user_id,:display_name,:status,:review_date)");
		$insertReviewCriteria = [
			'review_desc'  => $_POST['review_desc'],
			'product_id'   => $fetchProductId['product_id'],
			'user_id'      => $_SESSION['user_sessId'],
			'display_name' => $_POST['display_name'],
			'status'       => $_POST['status'],
			'review_date'  => $_POST['review_date']
		];
		if($insertReview->execute($insertReviewCriteria)){
			//alert message is generated and redirects to the electronics.php
			echo '<script>
				alert("Your review has been sent to the administration team. Once they approve the review, it will be public");
				document.location="electronics.php";
				</script>';
		}else{
			echo "VALUE NOT INSERTED";
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
 	<title>Add Review </title>
	<?php require 'default/header.php'; ?>
	<?php require 'default/section_users.php'; ?>
	
	<main>
		<form action="" method="POST">
			<input type="hidden" name="status" value="no"/>
			
			<label>Add Review To This Product</label>
				<textarea class="field-input" name="review_desc"></textarea>
			
			<label>Display Name: </label>
				<input class="field-input" type="text" name="display_name" placeholder="Your Name" /><br/>
			
			<label>Current Date: </label>
				<input class="field-input" type="date" name="review_date"/>
			
			<input class="add-button" type="submit" name="review" value="Add Review" />
		</form>
	</main>

	<?php require 'default/footer.php'; ?>
</body>
</html>