<?php 
	// connecting to the database using PDO
	$pdo = new PDO('mysql:dbname=assessment;host=localhost','root','', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
 ?>