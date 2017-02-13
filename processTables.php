<?php
$servername = "localhost";
$username = "cl27-siddhant";
$password = "123456";
$dbname = "cl27-siddhant";

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
//echo "Connected successfully";

/*$sql = "INSERT INTO Meetings (Meeting_Number, Lead_1, Lead_2, Venture_Name, Room_Number) VALUES ('1', 'foo1', 'foo2', 'Apple.Placehodler', '327')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();*/
?>
