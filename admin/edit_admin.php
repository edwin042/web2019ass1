<?php 
	//editing the admin 
	//connect to the database 
	session_start();
	require 'default/database.php';
	require 'default/redirect.php';
	//get admin_table by id
	$getAdmin = $pdo->prepare("SELECT * FROM users_db_table WHERE user_id = :edid");
	$getAdmin->execute($_GET);
	$fetchedAdmin =$getAdmin->fetch();

	if(isset($_POST['update']))
	{
		//updating the values of the admins
		$getAdmin = $pdo->prepare("UPDATE users_db_table SET username = :username, user_password =:password WHERE user_id=:hidden_id");
		unset($_POST['update']);
		if($getAdmin->execute($_POST))
			header('Location:admins.php?finalmsg=Admin Table Updated');
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
 	<title>Edit Admin Panel</title>
 	<?php require 'default/header.php'; ?>
 	<?php require 'default/section.php'; ?>
 	<main>
 		<form action="" method="POST">
			<h2>CREATE NEW ADMIN</h2>
			<input type="hidden" name="hidden_id" value="<?php echo $_GET['edid']; ?>">
			<label>UserName: </label>
				<input class="field-input" type="text" name="username" value="<?php echo $fetchedAdmin['username']; ?>" />
			<label>New Password: </label>
				<input class="field-input" type="password" name="password" />
			<br/>
			<br/>
			<input class="add-button" type="submit" name="update" value="Update" />
			<a class="add-button" href="admins.php">Cancel</a>
		</form>
 	</main>
 	<?php require '../default/footer.php'; ?>
</body>
</html>