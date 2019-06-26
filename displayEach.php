<?php 
	//Displaying each categories
	session_start();
	require 'admin/default/database.php';
	/*
		Displays only the product which has been clicked
	*/
	$showProduct = $pdo->prepare("SELECT * FROM products_db_table WHERE product_id = " . $_GET['eachProduct_id']);
	$showProduct->execute();
	$fetchedProduct = $showProduct->fetch();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
 	<title><?php echo $fetchedProduct['product_name']; ?></title>
	<?php require 'default/header.php'; ?> 
	<?php require 'default/section_users.php'; ?>

	<main>
		<ul class="product_item">
			<li>
				<h2><?php echo $fetchedProduct['product_name']; ?></h2>
				<p><?php echo $fetchedProduct['description']; ?></p>
				<div class="price">£<?php echo $fetchedProduct['product_price']; ?></div>
				
				<p class="socialmediaicons">
					Share on Social Medias: 
					<a href="https://www.facebook.com/"><i class="fa fa-facebook" style="font-size: 34px;"></i></a>
					<a href="https://www.instagram.com/"><i class="fa fa-instagram" style="font-size: 34px;"></i></a>
					<a href="https://www.twitter.com/"><i class="fa fa-twitter" style="font-size: 34px;"></i></a>
				</p>
				
				<?php 
					if(isset($_SESSION['user_sessId'])){ ?>
						<a href="insertCart.php?cartget_id=<?php echo $fetchedProduct['product_id']; ?>">
							<input class="add-button" type="button" value="Add to cart"/>
						</a><br/><br>
						<?php }
					else{?>
						<a href="#" onclick="javascipt: alert('Please sign in to add products to cart')" >
							<input class="add-button" type="button" value="Add to cart"/>
						</a><br/><br>
					<?php } ?>
				
				<h4>Product Reviews:</h4>
						<ul class="reviews">
							<?php 						
							$showReviews = $pdo->prepare("SELECT * FROM review_products WHERE product_id =" . $fetchedProduct['product_id']);
							$showReviews->execute();
							
							foreach ($showReviews as $showProductReviews) { 
									if($showProductReviews['status']==='yes'){?>
							<li>
								<p><?php echo $showProductReviews['review_desc']; ?></p>
							</li>
							<div class="details">
								<strong>By:
									<a style="color:black;" href="user_reviews.php?reviewer_id=<?php echo $showProductReviews['user_id']; ?>">
										<?php echo $showProductReviews['display_name'];?>
									</a>
								</strong>
							<em>
								<?php echo $showProductReviews['review_date']; ?>
							</em>
						</div>
						<?php } }?>
					</ul>
					<?php
					if(isset($_SESSION['user_sessId'])){ ?>
							<a href="addReview.php?product_id=<?php echo $fetchedProduct['product_id']; ?>"><button class="review-button">Add Review</button></a>
					</li>
				<?php } ?>
			</li>
		</ul>
	</main>
</body>
</html>