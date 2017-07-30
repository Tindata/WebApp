<?php


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$stmt = $conn->prepare("SELECT * FROM datasetList WHERE Name = ?");

	$stmt->bind_param("s", $name);
	$stmt->execute();
    $stmt->close();

	$conn->close();

?>