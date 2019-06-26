<?php 
	//This is review page
	session_start();
	require 'default/database.php';
	require 'default/redirect.php';

	//if user press the filter
	if(isset($_POST['filter']))
	{
		$checkReviews = $pdo->prepare("SELECT review_id, review_desc, product_name, display_name, status 
			FROM review_products 
			INNER JOIN products_db_table 
			WHERE review_products.product_id = products_db_table.product_id 
			AND status = :status");
		$reviewCriteria = [
			'status' => $_POST['search_by_status']
		];
		$checkReviews->execute($reviewCriteria);
	}
	//if user press the filter off button or if nothing is pressed
	else if(!isset($_POST['filter'])||isset($_POST['nofilter']))
	{
		$checkReviews = $pdo->prepare("SELECT review_id, review_desc, product_name, display_name, status 
			FROM review_products 
			INNER JOIN products_db_table 
			WHERE review_products.product_id = products_db_table.product_id");
		$checkReviews->execute();
	}
	else{
		echo "ERROR 404";
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>REVIEW</title>
	<?php require 'default/header.php'; ?>
	<?php require 'default/section.php'; ?>
		<main>
			<h1>Reviews By the Users</h1>

			<form action="" method="POST">
			<?php 
				$filterReviews = $pdo->prepare('SELECT * FROM review_products');
				$filterReviews->execute(); ?>
			<h3>FILTER REVIEWS BY STATUS</h3>
				<select class="field-input" name="search_by_status">
					<option value="yes">Yes</option>
					<option value="no">No</option>
				</select>
				<input class="add-button" type="submit" name="filter" value="Filter Search"/>
				<input class="add-button" type="submit" name="nofilter" value="Filter OFF"/>
			</form>
		<br/>
			<table border="1px" class="table">
				<tr>
					<th>Review id</th>
					<th>Reviews</th>
					<th>Review Product</th>
					<th>Review By</th>
					<th>Approved</th>
					<th>Approve Status</th>
				</tr>
				<?php $review_id = 1;
					foreach ($checkReviews as $showReviews) { ?>
				<tr>
					<td><?php echo $review_id++ ; ?></td>
					<td><?php echo $showReviews['review_desc'];?></td>
					<td><?php echo $showReviews['product_name'];?></td>
					<td><?php echo $showReviews['display_name'];?></td>
					<td><?php echo $showReviews['status'];?></td>
					<td><a href="edit_review.php?rev_id=<?php echo $showReviews['review_id']; ?>">Manage</a></td>
				</tr>
				<?php } ?>
			</table>
		</main>
	<?php require '../default/footer.php'; ?>
</body>
</html>