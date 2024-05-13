<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "petdb2"; // database name goes here
	
	// Create connection
	$connection = new mysqli($servername, $username, $password);
	
	// Check connection
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error."<br>x");
	}

	mysqli_select_db($connection, $database);
?>
