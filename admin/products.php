<?php 
	//this is the home page displaying all the products
	session_start();
	//connecting to the database 
	require 'default/database.php';
	//redirecting to the index page if not loggedin
	require 'default/redirect.php';
	if(isset($_POST['filter']))
	{
		//Filter the products according to categories
		$viewProducts = $pdo->prepare("SELECT * FROM products_db_table WHERE category_id = :field_search_category");
		$searchCriteria = [ 'field_search_category' => $_POST['field_search_category'] ];
		$viewProducts->execute($searchCriteria);
	}
	else if(isset($_POST['nofilter'])||!isset($_POST['filter']))
	{	//shows the products in the table
		$viewProducts = $pdo->prepare("SELECT * FROM products_db_table");
		$viewProducts->execute();
	}
	else
		echo "NO PRODUCTS FOUND";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Panel</title>
	<?php require 'default/header.php'; ?>
	<?php require 'default/section.php'; ?>

	<main>
		<h1>ALL PRODUCTS TABLE</h1>
		<form action="products.php" method="POST">
			<?php 
				$filterProducts = $pdo->prepare('SELECT * FROM categories_db_table');
				$filterProducts->execute(); ?>
			<h3>FILTER PRODUCTS BY CATEGORY</h3>
			<select class="field-input" name="field_search_category">
				<?php foreach ($filterProducts as $productsAsRow) { ?>
					<option value="<?php echo $productsAsRow['category_id'] ?>"><?php echo $productsAsRow['category_name']; ?></option>	
				<?php } ?>
			</select>
			<input class="add-button" type="submit" name="filter" value="Filter Search"/>
			<input class="add-button" type="submit" name="nofilter" value="Filter OFF"/>
		</form>

		<a href="add_products.php">
			<div class="menu">Add Products</div>
		</a>

		<br/>
		<div id="products">
			<table border="1px" class="table">
				<tr>
					<th>Id</th>
					<th>Product Name</th>
					<th>Manufacturer</th>
					<th>Manufacture Date</th>
					<th>Description</th>
					<th>Product Price</th>
					<th>Featured</th>
					<th>Product Quantity</th>
					<th>Product Action</th>
				</tr>
				<?php $id = 1;
					foreach ($viewProducts as $productsAsRows) {?>
				<tr>
					<td> <?php echo $id++; ?></td>
					<td> <?php echo $productsAsRows['product_name']; ?></td>
					<td> <?php echo $productsAsRows['manufacturer']; ?>  </td>
					<td> <?php echo $productsAsRows['manufacture_date']; ?>  </td>
					<td> <?php echo $productsAsRows['description']; ?>  </td>
					<td> <?php echo $productsAsRows['product_price']; ?> </td>
					<td> <?php echo $productsAsRows['featured']; ?></td>
					<td> <?php echo $productsAsRows['product_quantity']; ?></td>
					<td>
						<a href="edit_products.php?pid=<?php echo $productsAsRows['product_id']; ?>">Edit</a>/
						<a href="#" onclick="javascript:if(confirm('Are you sure?')){
						document.location='delete/deleteProducts.php?delete_id=<?php echo $productsAsRows['product_id']; ?>';}">Delete</a>
					</td>
				</tr>
				<?php } ?>
			</table>
		</div>
		<br/>
	</main>
	<?php require '../default/footer.php'; ?>
</body>
</html>