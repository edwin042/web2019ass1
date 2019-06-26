<?php 
	//Logout users
	session_start();
	session_unset();
	session_destroy();
	// redirect to the login page
	header('Location:../login_users.php');
 ?>