<?php
	/*
		You need to login to get access to the files where redirect.php is added
		else you will be redirect to the index page
	*/
	if(!isset($_SESSION['adminSessionId'])){
		header('Location:../index.php');
	}
 ?>