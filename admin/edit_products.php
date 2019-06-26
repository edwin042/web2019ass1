<?php 
	//Edit Products
	//connecting to the database first
	session_start();
	require 'default/database.php';
	require 'default/redirect.php';
	$getProducts = $pdo->prepare("SELECT * FROM products_db_table WHERE product_id = :pid");
	$getProducts->execute($_GET);
	$fetchedProduct = $getProducts->fetch();
	
	if(isset($_POST['update']))
	{
		/*
			Updates all the details of the products table named as products_db_table
		*/
		$getProducts = $pdo->prepare("UPDATE products_db_table 
			SET product_name=:product_name,
			manufacturer=:manufacturer, 
			manufacture_date=:manufacture_date,
			description=:description,
			product_price=:price,
			category_id=:category_id,
			featured = :featured,
			product_quantity=:product_quantity
			WHERE product_id = :hidden_id");
		unset($_POST['update']);
		if($getProducts->execute($_POST)){
			header('Location:products.php?finalmsg=Products Updated');
		}else{
			echo "ERROR 404";
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit Products</title>
	<?php require 'default/header.php'; ?>
	<?php require 'default/section.php'; ?>
	<main>
		<form action="" method="POST">
			<h1>EDIT PRODUCTS</h1>
			<input type="hidden" name="hidden_id" value="<?php echo $_GET['pid']; ?>">
			<label>Product Name:</label>
				<input class="field-input" type="text" name="product_name" value="<?php echo $fetchedProduct['product_name'] ?>" />

			<label>Product Quantity:</label>
				<input class="field-input" type="number" name="product_quantity" value="<?php echo $fetchedProduct['product_quantity'] ?>" />

			<label>Manufacture:</label>
				<input class="field-input" type="text" name="manufacturer" value="<?php echo $fetchedProduct['manufacturer'] ?>" />

			<label>Manufacture Date:</label>
				<input class="field-input" type="date" name="manufacture_date" value="<?php echo $fetchedProduct['manufacture_date'] ?>" />
			
			<label>Description: </label>
				<textarea rows="25" name="description"><?php echo $fetchedProduct['description'] ?></textarea>

			<label>Price:</label>
				<input class="field-input" type="number" name="price" value="<?php echo $fetchedProduct['product_price'] ?>" />

			<label>Categories: </label>
				<?php //Displays all the product category in the drop-down option
				$viewCategories = $pdo->prepare("SELECT * FROM categories_db_table");
				$viewCategories->execute(); ?>
					<select name="category_id" class="field-input">
						<?php 
						foreach($viewCategories as $categoryAsRow){?>
							<option value="<?php echo $categoryAsRow['category_id']; ?>" <?php if($fetchedProduct['category_id']==$categoryAsRow['category_id']) echo 'selected'; ?>>
								<?php echo $categoryAsRow['category_name']; ?>
							</option>;
						<?php } ?>
					</select>

			<label>Featured</label>
				<select name="featured" class="field-input">
					<option value="yes">Yes</option>
					<option value="no">No</option>
				</select>

			<input class="add-button" type="submit" name="update" value="Update Values" />
			<button class="add-button"><a href="products.php">Cancel</a></button>
		</form>
	</main>
	<?php require '../default/footer.php'; ?>
</body>
</html>