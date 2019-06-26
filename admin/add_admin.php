<?php 
	session_start();
	require 'default/database.php';
	require 'default/redirect.php';
	if(isset($_POST['create']))
	{
		/*
			Insert the details of the admin required into the users_db_table along with the user roles
		*/
		$insertAdminUser = $pdo->prepare("INSERT INTO users_db_table(username, user_password, user_role) VALUES(:username, :user_password, :user_role)");
		$insertAdminCriteria = [
			'username' => $_POST['username'],
			'user_password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
			'user_role' => $_POST['user_role']
		];
		if($insertAdminUser->execute($insertAdminCriteria)) 
			header('Location:admins.php');
		else echo '<h1>NOT INSERTED PLEASE CHECK THE VALUES</h1>';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add Admin</title>
	<?php require 'default/header.php'; ?>
	<?php require 'default/section.php'; ?>
		<main>
			<form action="add_admin.php" method="POST">
				<h2>CREATE NEW ADMIN</h2>
				<input type="hidden" name="user_role" value='admin'/>
				<label>UserName: </label>
					<input class="field-input" type="text" name="username"/>

				<label>Password: </label>
					<input class="field-input" type="password" name="password"/>
					
				<input class="add-button" type="submit" name="create" value="Create" />
				<a class="add-button" href="admin.php">Cancel</a>
			</form>				
		</main>
	<?php require '../default/footer.php'; ?>
</body>
</html>