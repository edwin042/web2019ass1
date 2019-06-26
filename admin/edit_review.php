<?php 
	//Approve Reviews
	session_start();
	require 'default/database.php';
	require 'default/redirect.php';
	//getting review by id
	$getReview = $pdo->prepare("SELECT * FROM review_products WHERE review_id = :rev_id");
	$getReview->execute($_GET);
	$statusFetch =$getReview->fetch();
	
	if(isset($_POST['update']))
	{
		/*
			Updates the value of review product
		*/
		$getReview = $pdo->prepare("UPDATE review_products SET status = :status WHERE review_id=:hidden_id");
		unset($_POST['update']);
		if($getReview->execute($_POST)){
			header('Location:review.php?status= Review Updated');
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
 	<title>Manage Review</title>
 	<?php require 'default/header.php'; ?>
 	<?php require 'default/section.php'; ?>

 	<main>
 		<form action="" method="POST">
 			<input type="hidden" name="hidden_id" value="<?php echo $_GET['rev_id']; ?>"/>
 			<label>Status</label>
 				<select class="field-input" name="status">
 					<option value="yes">YES</option>
 					<option value="no">NO</option>
 				</select>
 			<input class="add-button" type="submit" name="update" value="Update" />
 			<button class="add-button"><a href="review.php">Cancel</a></button>
 		</form>
 	</main>
 	<?php require '../default/footer.php';?>
</body>
</html>