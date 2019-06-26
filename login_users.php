<?php 
	//User login page
	session_start();
	require 'admin/default/database.php';
	if(isset($_SESSION['user_sessId'])){
		header('Location:electronics.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>LOGIN</title>
	<?php require 'default/header.php'; ?>
	<?php require 'default/section_users.php'; ?>
	<main>
		<?php 
			//when form is submitted
			if(isset($_POST['login'])){
				$authentication = $pdo->prepare("SELECT * FROM users_db_table WHERE username= :username");
				$authCriteria = ['username' => $_POST['username']];
				$authentication->execute($authCriteria);

				if($authentication->rowCount() > 0){
					$row = $authentication->fetch();
					//hashed password verifying
					if(password_verify($_POST['password'], $row['user_password']))
					{
						//checking if the person is admin or user
						if($row['user_role'] === 'admin')
						{
							//setting value to the session
							$_SESSION['adminSessionName'] = $row['username'];
							$_SESSION['adminSessionId'] = $row['user_id'];
							header('Location:admin/products.php');
						}
						else
						{
							$_SESSION['user_name'] = $row['user_firstname'];
							$_SESSION['user_sessId'] = $row['user_id'];
							echo '<script type="text/javascript">
							alert("YOU ARE LOGGED IN");
							document.location="electronics.php"</script>';
						}
					} 
					else echo '<h1>PASSWORD INCORRECT</h1>';
				} 
				else echo '<h2 style="color:red">USER NOT FOUND! Please Try Again</h2>';
			}
		 ?>
 		<form class="form-login" action="" method="POST">
 			<h1 class="loginAuth">Login Form</h1>
			<fieldset class="fieldset-control">
				<div class="form-control">
					<label class="label-field">Username:</label>
					<input class="input-field" type="text" name="username" required/>
				</div>
				
				<div class="form-control">
					<label class="label-field">Password:</label>
					<input class="input-field" type="password" name="password"/>
				</div>

				<!-- login button -->
				<input class="submit" type="submit" name="login" value="Login"/>
				<a class="submit" href="forgot_password.php">Forgot Passsword</a><br/><br/>
				
				<strong>New To Ed's Electronics ? &darr;</strong><br/>
				<button class="submit"><a href="register_users.php">Register</a></button>
 			</fieldset>
 		</form>
	</main>
	<?php require 'default/footer.php'; ?>
</body>
</html>