<?php
$servername = "";
$username = "";
$password = "";
$dbname = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE datasetList SET url = 'https://www.data.act.gov.au/Government-and-Transparency/Contracts-Register-2000-to-2016/8wge-3sy9' WHERE name = 'Contracts Register - 2000 to 2016';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	echo json_encode($row)."\n\r";
    }
} else {
    echo "0 results";
}
$conn->close();

?>