<?php
$servername = "localhost";
$username = "cl44-siddhant";
$password = "123456";
$dbname = "cl44-siddhant";

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is good
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Execute the query and store it in $result

$src1= $_POST['sqlQuery'];
//echo $scr1;
//$src1 = "SELECT * FROM Meetings WHERE Venture_Name='ICSPI' ORDER BY Time_Start;" ;
$result = $conn->query($src1);


$fullArray = array();

// there are 3 queries that I have to make
//

while ($row = $result->fetch_array()){
    $row1 = array();

    $row1["Meeting_Number"] = $row['Meeting_Number'];
    $row1["Lead_1"] = $row['Lead_1'];
    $row1["Lead_2"] = $row['Lead_2'];
    $row1["Lead_3"] = $row['Lead_3'];
    $row1["Time_Start"] = $row['Time_Start'];
    $row1["Time_End"] = $row['Time_End'];
    $row1["Room_Number"] = $row['Room_Number'];
    
    //array_push($fullArray, $row1);
    //trying bracket notation
    $fullArray[] = $row1;
    //we don't need the venture name because we query by it

}

header('Content-Type: application/json');
$abc = json_encode($fullArray);
echo $abc;
//echo var_dump($fullArray);
//echo 
?>