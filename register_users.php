<?php 
	//Register Users
	session_start();
	require 'admin/default/database.php';
	if(isset($_SESSION['user_sessId'])){
		header('Location:electronics.php');
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register Users</title>
	<script type="text/javascript">
		//show the password on clicking the checkbox
		function onload(){
			var password = document.getElementById('pass');
			if(password.type === "password"){
				password.type = "text";
			}
			else{
				password.type = "password";
			}
		}
		function clickFunction(){
			var checkBtn = document.getElementById('clickBtn');
			checkBtn.addEventListener('click', onload);
		}
		document.addEventListener('DOMContentLoaded', clickFunction);
		
	</script>	
		<?php require 'default/header.php'; ?>
		<?php require 'default/section_users.php'; ?>

	<main>
		<?php 
			if(isset($_POST['register'])){
				//extracts all the form input names
				extract($_POST);
				$iserror = '';
				if($username == '') 
					$iserror .= "<p>Please enter your username</p>";
            	if($user_firstname == '') 
            		$iserror .= "<p>Please enter your First Name</p>";
	            if($user_surname == '') 
	            	$iserror .= "<p>Please enter your Surname</p>";
	            if($user_email == '') 
	            	$iserror .= "<p>Please enter your Email</p>";
	            if($user_phone == '') 
	            	$iserror .= "<p>Please enter your Phone Number</p>";
	            if($user_password == '') 
	            	$iserror .= "<p>Please enter your password</p>";
            	if(!isset($_POST['terms'])) 
            		$iserror .= "<p>Check terms and condtions</p>";
            	//if there is no errors then inserts the values in the database
				if(empty($iserror)){
					$registerNewUser = $pdo->prepare("INSERT INTO users_db_table(username, user_firstname, user_surname, user_email, user_phone, user_password, user_role) VALUES (:username, :user_firstname, :user_surname, :user_email, :user_phone, :user_password, :user_role)");
					$registerNewUserCriteria = [
						'username'       => $username,
						'user_firstname' => $user_firstname,
						'user_surname'   => $user_surname,
						'user_email'     => $user_email,
						'user_phone'     => $user_phone,
						'user_password'  => password_hash($user_password, PASSWORD_DEFAULT),
						'user_role'      => $user_role
					];
					if($registerNewUser->execute($registerNewUserCriteria))
					{
						header('Location:login_users.php');
					}
					else echo "INCORRECT VALUES";
				}
				else echo $iserror;
			}	
		 ?>
		<form class="form-login" action="register_users.php" method="POST">
			<h1 class="loginAuth">Register Here</h1>
			<fieldset class="fieldset-control">
				<input type="hidden" name="user_role" value="user"/>
				<div class="form-control">
					<label>First Name: </label>
						<input class="field-input" type="text" name="user_firstname" />
				</div>
				<div class="form-control">
					<label>Surname:</label>
						<input class="field-input" type="text" name="user_surname" />
				</div>
				<div class="form-control">
					<label>Email:</label>
						<input class="field-input" type="email" name="user_email" />
				</div>
				<div class="form-control">
					<label>Username:</label>
						<input class="field-input" type="text" name="username" />
				</div>
				<div class="form-control">
					<label>Phone Number:</label>
						<input class="field-input" type="number" name="user_phone" />
				</div>
				<div class="form-control">
					<label>PASSWORD:</label>
						<input id="pass" class="field-input" type="password" name="user_password" />
						<input type="checkbox" id="clickBtn"> Show Password <br/><br/>
				</div>
					<input type="checkbox" name="terms" value="1"> I accept all the terms and conditions <br/><br/>
				<input class="submit" type="submit" name="register" value="Register" />
				<button class="submit"><a href="index.php">Cancel</a></button>
			</fieldset>
		</form>
	</main>
	<?php require 'default/footer.php'; ?>
</body>
</html>
