<?php 
	//redirects to the index page if there is no value in the session
	if(!isset($_SESSION['user_sessId'])){
		header('Location:index.php');
	}
 ?>