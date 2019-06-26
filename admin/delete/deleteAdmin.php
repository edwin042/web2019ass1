<?php 
	//deleting the admin
	require '../default/database.php';
	if(isset($_GET['del_id']))
	{
		$deleteAdmin = $pdo->prepare("DELETE FROM users_db_table where user_id = :del_id");
		if($deleteAdmin->execute($_GET))
		{
			echo '<script>alert("Admin Deleted!!");document.location="../admins.php";</script>';
		}
		else
			echo '<script>alert("Admin Delete Unsuccessful 404 error!!");document.location="../admins.php";</script>';
	}
 ?>