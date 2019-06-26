<?php 
	//User Reviews
	session_start();
	require 'admin/default/database.php';
	require 'default/redirect.php';
	
	$showUserReviews = $pdo->prepare("SELECT * FROM review_products WHERE user_id=" . $_GET['reviewer_id']  );
	$showUserReviews->execute();
 ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<title>User Reviews</title>
	<?php require 'default/header.php'; ?>
	<?php require 'default/section_users.php'; ?>
	<main>
		REVIEWS:
		<ul class="reviews">			
			<?php foreach ($showUserReviews as $viewReviews) { ?>
				<li>
					<?php echo $viewReviews['review_desc']; ?>
				</li>
			<?php } ?>
		</ul>
	</main>
	<?php require 'default/footer.php'; ?>
</body>
</html>