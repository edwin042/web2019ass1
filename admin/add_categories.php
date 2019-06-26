<?php 
	session_start();
	require 'default/database.php';
	require 'default/redirect.php';
	//if add button is pressed
	if(isset($_POST['add']))
	{
		/*
			Insert the values into category table named as categories_db_table
		*/
		$category_add = $pdo->prepare("
			INSERT INTO categories_db_table(category_name, category_description) 
			VALUES(:category_name, :category_description)");
		$categoryCriteria = [
			'category_name'        => $_POST['category_name'],
			'category_description' => $_POST['category_description']
		];
		if($category_add->execute($categoryCriteria))
			header('Location:categories.php');
		else echo "ERORR 404! CATEGORY NOT ADDED";		
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add Products</title>
	<?php require 'default/header.php'; ?>
 	<?php require 'default/section.php'; ?>

 	<main>
 		<form action="add_categories.php" method="POST">
	 		<h1>Add Categories</h1>

			<label>Categories Name:</label>
				<input class="field-input" type="text" name="category_name" />
		
			<label>Categories Description: </label>
				<textarea rows="20" name="category_description"></textarea>
			
			<input class="add-button" type="submit" name="add" value="ADD" />
			<a class="add-button" href="categories.php">Cancel</a>
 		</form>
 	</main>
 	<?php require '../default/footer.php'; ?>
</body>
</html>