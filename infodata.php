<?php
header('Content-Type: application/json');

$servername = "shareddb1b.hosting.stackcp.net";
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

$q= $_POST['sqlquery'];
$tab = $_POST['theTable'];

$results = $conn->query($q);
    
    $connections = array();
    
    while ($rows = $results->fetch_array()){
    	$row2 = array();

		if ($tab == "connect") {
    	    $row2["Connection_ID"] = $rows['Connection_ID'];
    	    $row2["Species_1_ID"] = $rows['Species_1_ID'];
    	    $row2["Species_2_ID"] = $rows['Species_2_ID'];
    	    $row2["Connection_Type"] = $rows['Connection_Type'];
    	    $row2["Connection_Desc"] = $rows['Connection_Desc'];
    	    $row2["Connection_Priority"] = $rows['Connection_Priority'];
    	    $row2["Date_Added"] = $rows['Date_Added'];
    	    $row2["Date_Updated"] = $rows['Date_Updated'];
		}
    	else if($tab == "food"){
    		$row2["Food_ID"] = $rows['Food_ID'];
    	    $row2["Species_ID"] = $rows['Species_ID'];
    	    $row2["Location_ID"] = $rows['Location_ID'];
    	    $row2["Food_Image_URL"] = $rows['Food_Image_URL'];
    	    $row2["Food_Name"] = $rows['Food_Name'];
    	    $row2["Date_Added"] = $rows['Date_Added'];
    	    $row2["Date_Updated"] = $rows['Date_Updated'];
    	}
    	else if($tab == "species_food"){
    		$row2["Species_Food_ID"] = $rows['Species_Food_ID'];
    	    $row2["Species_Food_Desc"] = $rows['Species_Food_Desc'];
    	    $row2["Species_ID"] = $rows['Species_ID'];
    	    $row2["Consumption_Low_Percentage"] = $rows['Consumption_Low_Percentage'];
    	    $row2["Consumption_High_Percentage"] = $rows['Consumption_High_Percentage'];
    	    $row2["Average_Consumption"] = $rows['Average_Consumption'];
    	    $row2["Date_Added"] = $rows['Date_Added'];
    	    $row2["Date_Updated"] = $rows['Date_Updated'];
    	}
    	else if($tab == "subgroup"){
    		$row2["Subgroup_ID"] = $rows['Subgroup_ID'];
    	    $row2["Subgroup_Name"] = $rows['Subgroup_Name'];
    	    $row2["Subgroup_Desc"] = $rows['Subgroup_Desc'];
    	    $row2["Subgroup_Image_URL"] = $rows['Subgroup_Image_URL'];
    	    $row2["Date_Added"] = $rows['Date_Added'];
    	    $row2["Date_Updated"] = $rows['Date_Updated'];
    	}
        else if($tab == "spec_loc"){
            $row2["Species_Location_ID"] = $rows['Species_Location_ID'];
            $row2["Species_ID"] = $rows['Species_ID'];
            $row2["Location_ID"] = $rows['Location_ID'];
            $row2["Species_Location_Desc"] = $rows['Species_Location_Desc'];
            $row2["Species_Location_Priority"] = $rows['Species_Location_Priority'];
            $row2["Location_Expanse_Area"] = $rows['Location_Expanse_Area'];
        }
        else if($tab == "loc"){
            $row2["Location_ID"] = $rows['Location_ID'];
            $row2["Location_Name"] = $rows['Location_Name'];
            $row2["Location_Latitude"] = $rows['Location_Latitude'];
            $row2["Location_Longitude"] = $rows['Location_Longitude'];
            $row2["Location_Address"] = $rows['Location_Address'];
            $row2["Location_Image_URL"] = $rows['Location_Image_URL'];
        }
    	$connections[] = $row2;
	}
    //echo "Hia";
    echo json_encode(array("connections" => $connections));
?>