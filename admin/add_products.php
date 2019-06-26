<?php
	session_start();
	require 'default/database.php';
	require 'default/redirect.php';

	if(isset($_POST['add']))
	{
		/*
			Updates all the details of the products table named as products_db_table
		*/
		$stmt = $pdo->prepare("INSERT INTO products_db_table(
			product_name,
			manufacturer,
			manufacture_date,
			description,
			product_price,
			category_id,
			featured,
			product_quantity) 
			VALUES (:product_name,:manufacturer,:manufacture_date,:description,:product_price,:category_id,:featured,:product_quantity)");
		$criteria = [
			'product_name'     => $_POST['product_name'],
			'manufacturer'     => $_POST['manufacturer'],
			'manufacture_date' => $_POST['manufacture_date'],
			'description'      => $_POST['description'],
			'product_price'    => $_POST['price'],
			'category_id'      => $_POST['category_id'],
			'featured'         => $_POST['featured'],
			'product_quantity' => $_POST['product_quantity']
		];
		if($stmt->execute($criteria))
			header('Location:products.php');
		else 
			echo "Please Check The Values";
	}
 ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add Products</title>
	<?php require 'default/header.php'; ?>
 	<?php require 'default/section.php'; ?>
	<main>
 		<form action="add_products.php" method="POST">
 			<h1>Add Products</h1>
 			
			<label>Product Name:</label>
				<input class="field-input" type="text" name="product_name" />

			<label>Product Quantity:</label>
				<input class="field-input" type="number" name="product_quantity" />

			<label>Manufacture:</label>
				<input class="field-input" type="text" name="manufacturer" />

			<label>Manufacture Date:</label>
				<input class="field-input" type="date" name="manufacture_date" />

			<label>Description: </label>
				<textarea rows="25" name="description"></textarea>

			<label>Price:</label>
				<input class="field-input" type="number" name="price" />

			<label>Categories: </label>
			<?php 
				$viewCategories = $pdo->prepare("SELECT * FROM categories_db_table");
				$viewCategories->execute();?>
				<select name="category_id" class="field-input">
					<?php 
						foreach($viewCategories as $dropDown){?>
							<option value="<?php echo $dropDown['category_id']; ?>">
								<?php echo $dropDown['category_name']; ?>
							</option>;
					<?php } ?>
				</select>

			<label>Featured</label>
				<select name="featured" class="field-input">
					<option value="yes">Yes</option>
					<option value="no">No</option>
				</select>

			<input class="add-button" type="submit" name="add" value="ADD" />
			<a class="add-button" href="products.php">Cancel</a>
 		</form>

 	</main>
 	<?php require '../default/footer.php'; ?>
 </body>
 </html>