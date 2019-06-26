<?php 
	//delete categories
	require '../default/database.php';
	if (isset($_GET['del_id'])) 
	{
		$deleteCategories =  $pdo->prepare("DELETE FROM categories_db_table WHERE category_id= :del_id");
		$deleteCriteria = [
			'del_id' => $_GET['del_id']
		];
		if($deleteCategories->execute($deleteCriteria))
		{
			echo '<script>alert("Your Category is deleted!!");document.location="../categories.php";</script>';
		}
		else
			echo '<script>alert("Delete Unsuccessfull 404 error!!");document.location="../categories.php";</script>';
	}
 ?>