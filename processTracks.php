<?php
$servername = "localhost";
$username = "cl44-siddhant";
$password = "123456";
$dbname = "cl44-siddhant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Create connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "process.php";

$src1= $_POST['sqlInserts'];

//echo $src1;

foreach ($src1 as &$str) {
	if ($conn->query($str) === TRUE) {
    	echo "New record created successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
}