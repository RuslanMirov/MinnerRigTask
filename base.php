<?php 

function connectDB () {
	include 'config.php';

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error)."<br>";
	}
	
	return $conn;
}

function base_query ($query) {
	$conn = connectDB();

	$result = $conn->query($query);
	$conn->close();

	return $result;
}

 ?>