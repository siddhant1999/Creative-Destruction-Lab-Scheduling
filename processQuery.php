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

//Execute the query and store it in $result

$src1= $_POST['sqlQuery'];

echo "starting here";
return;
if ($src1 == "returnLeads"){
    echo "we are here";
    $str = "SELECT Lead_1, Lead_2, Lead_3 FROM Meetings WHERE Lead_1 IS NOT NULL;";
    $result = $conn->query($str);
    
    
    $fullArray = array();
    
    // there are 3 queries that I have to make
    //
    
    while ($row = $result->fetch_array()){
        $row1 = array();
    
        $row1["Lead_1"] = $row['Lead_1'];
        //$row1["Lead_1"] = $row['Lead_2'];
        //$row1["Lead_1"] = $row['Lead_3'];
        
        //I'm trying this, but I don't really know if it will work or not (Lead_1, Lead_1, Lead_1)
        $fullArray[] = $row1;

    }

    
    // hold on before returning this lets make sure it is entirely unique and sorted alphabetically
    header('Content-Type: application/json');
    //$abc = json_encode(array_unique($fullArray));
    $abc = json_encode($fullArray);
    echo $abc;
}
else {
    echo "we are right here";
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
//echo var_dump($fullArray);
//echo 
?>