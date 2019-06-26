<?php 
	//Profile Page
	session_start();
	require 'admin/default/database.php';
	require 'default/redirect.php';
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<title>Profile</title>
 	<?php require 'default/header.php';?>
 	<?php require 'default/section_users.php'; ?>
	<main>
		<div class="profile_users">
			<h1>View Your Profile</h1> 
			<img class="profile-img" src="images/profile.jpg" alt="profile img" />
			<div class="profile-description">
				<label>Name: <?php echo $_SESSION['user_name']; ?></label><br/>
				<a href="default/logout_users.php"><button class="add-button">Logout <i class="fa fa-log-out"></i></button></a>
			</div>
		</div>
	</main>
	<?php require 'default/footer.php'; ?>
</body>
</html>