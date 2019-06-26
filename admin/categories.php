<?php 
	//displaying all the categories
	session_start();
	require 'default/database.php';
	require 'default/redirect.php';

	//shows all the categories from the database
	$categories = $pdo->prepare("SELECT * FROM categories_db_table");
	$categories->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
 	<title>CATEGORIES</title>
 	
 	<?php require 'default/header.php' ?>
 	<?php require 'default/section.php' ?>

	<main>
		<h1>CATEGORIES TABLE</h1>
 		
 		<a href="add_categories.php">
 			<div class="menu">Add Categories</div>
	 	</a><br/>
	 	
	 	<div id="categories">
			<table border="1px" class="table">
				<tr>
					<th>Id</th>
					<th>Categories Name</th>
					<th>Description</th>
					<th>Categories Action</th>
				</tr>
				
		  <?php $category_id = 1;
				foreach ($categories as $categoriesAsRow){ ?>
				<tr>
					<td><?php echo $category_id++; ?> </td>
					<td><?php echo $categoriesAsRow['category_name']; ?> </td>
					<td><?php echo $categoriesAsRow['category_description']; ?></td>
					<td>
						<a href="edit_categories.php?cid=<?php echo $categoriesAsRow['category_id']; ?>">
							Edit
						</a>/
						<a href="#" onclick="javascript:if(confirm('Are you sure?')){document.location='delete/deleteCategories.php?del_id=<?php echo $categoriesAsRow['category_id']?>';}">
							Delete
						</a>
					</td>
				</tr>
			<?php } ?>
			</table>
 		</div>
	</main>
	<?php require '../default/footer.php' ?>
</body>
</html>