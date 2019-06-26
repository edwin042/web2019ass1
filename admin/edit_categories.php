   <?php 
	//connect database using pdo
   	session_start();
	require 'default/database.php';
	require 'default/redirect.php';
	//get categories by id
	$getCategories = $pdo->prepare("SELECT * FROM categories_db_table WHERE category_id = :cid");
	$getCategories->execute($_GET);
	//fetching the datas
	$fetchedCategory = $getCategories->fetch();

	if(isset($_POST['update']))
	{
		/*
			Updates the values of the categories table named as categories_db_table
		*/
		$getCategories = $pdo->prepare("UPDATE categories_db_table 
			SET 
			category_name=:category_name, 
			category_description=:category_description 
			WHERE category_id = :hidden_id");
		unset($_POST['update']);
		if($getCategories->execute($_POST))
			header('Location:categories.php?msg=Category Updated');	
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit Categories</title>
	<?php require 'default/header.php' ?>
	<?php require 'default/section.php' ?>

	<main>
		<form action="" method="POST">
			<input type="hidden" name="hidden_id" value="<?php echo $_GET['cid']; ?>">
			<label>Category Name:</label>
				<input class="field-input" type="text" name="category_name" value="<?php echo $fetchedCategory['category_name']; ?>" />
			
			<label>Category Description: </label>
				<textarea rows="20" name="category_description"><?php echo $fetchedCategory['category_description']; ?></textarea>
			
			<input class="add-button" type="submit" name="update" value="UPDATE VALUES" />
			<button class="add-button"><a href="categories.php">Cancel</a></button>
		</form>
	</main>
	
	<?php require '../default/footer.php'; ?>
</body>
</html>