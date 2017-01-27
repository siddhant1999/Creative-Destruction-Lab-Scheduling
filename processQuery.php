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

$src1= $_POST['sqlQuery'];
echo "Hi";
echo $scr1;

//echo mysqli_query($conn,$scr1);

foreach ($src1 as &$str) {
	echo $conn->query($str);
	/*$foo =$conn->query($str);
	if ($foo === TRUE) {
		echo $foo;
    	echo "New record created successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}*/
}