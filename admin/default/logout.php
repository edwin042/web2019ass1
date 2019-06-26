<?php 
	//logout the admin session
	session_start();
	session_unset();
	session_destroy();
	// redirect to the index page
	header('Location:../../index.php');
 ?>