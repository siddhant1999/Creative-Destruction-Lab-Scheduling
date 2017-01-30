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
echo $scr1;
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

    /*
        $row is the current entry

        Use $row['FieldName'] to get information of a column
        For example, $row['Meeting_ID'] returns the Meeting ID
    */

    //echo $row['Meeting_ID'];
}

//echo $fullArray;
/*foreach($fullArray as &$k){
    foreach($k as &$o){
        echo $o;
        echo " ";
    }
    echo "<br>";
}
*/

function message($n){
    return $n * $n;
}


//$abc = json_encode("{'errors': [{'message': 34}]}")
/*$a = array(1,2,3,4,5);
$abc = array_map("message", $a);
$abc = json_encode($abc);*/
//echo var_dump($abc);
//$data = '{"errors":[{"message":"Sorry, that page does not exist","code":34}]}';
//$manage = json_decode($data);
//$manage = (array) json_decode($data);
header('Content-Type: application/json');
$abc = json_encode($fullArray);
echo $abc;
//echo var_dump($fullArray);
//echo 
?>