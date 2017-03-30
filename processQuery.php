<?php
$servername = "localhost";
$username = "cl27-siddhant";
$password = "123456";
$dbname = "cl27-siddhant";

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is good
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$src1= $_POST['sqlQuery'];
//$src1= "returnVentures";

if ($src1 == "returnLeads"){
    $str = "SELECT Lead_1, Lead_2, Lead_3 FROM Meetings WHERE LENGTH(Lead_1) > 0 AND Lead_1 IS NOT NULL;";
    $result = $conn->query($str);

    $fullArray = array();
    while ($row = $result->fetch_array()){
        $row1 = array();
        array_push($fullArray, $row['Lead_1']);
        if(strlen($row['Lead_2'])){
            array_push($fullArray, $row['Lead_2']);
        }
        if(strlen($row['Lead_3'])){
            array_push($fullArray, $row['Lead_3']);
        }
    }
    header('Content-Type: application/json');
    $uniq = array_unique($fullArray);
    sort($uniq);
    $abc = json_encode($uniq);
    echo $abc;
}
else if ($src1 == "returnVentures"){
    $str = "SELECT Venture_Name FROM Meetings WHERE LENGTH(Venture_Name) > 0 AND Venture_Name IS NOT NULL;";
    $result = $conn->query($str);

    $fullArray = array();
    while ($row = $result->fetch_array()){
        $row1 = array();
        array_push($fullArray, $row['Venture_Name']);
    }
    header('Content-Type: application/json');
    $uniq = array_unique($fullArray);
    sort($uniq);
    $abc = json_encode($uniq);
    echo $abc;
}
else {
    $result = $conn->query($src1);
    
    
    $fullArray = array();
    
    
    while ($row = $result->fetch_array()){
        $row1 = array();
    
        $row1["Meeting_Number"] = $row['Meeting_Number'];
        $row1["Lead_1"] = $row['Lead_1'];
        $row1["Lead_2"] = $row['Lead_2'];
        $row1["Lead_3"] = $row['Lead_3'];
        $row1["Time_Start"] = $row['Time_Start'];
        $row1["Time_End"] = $row['Time_End'];
        $row1["Room_Number"] = $row['Room_Number'];
        $row1["Description"] = $row['Description'];
        $row1["Venture_Name"] = $row['Venture_Name'];
        $row1["Date"] = $row['Date'];
        $row1["is_AM"] = $row['is_AM'];
        $row1["is_Custom"] = $row['is_Custom'];
        
        //array_push($fullArray, $row1);
        //trying bracket notation
        $fullArray[] = $row1;
        //we don't need the venture name because we query by it
    
    }
    
    header('Content-Type: application/json');
    $abc = json_encode($fullArray);
    echo $abc;
}
?>