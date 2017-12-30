<?php
$servername = "shareddb1b.hosting.stackcp.net";
$username = "cl27-siddhant";
$password = "123456";
$dbname = "cl27-siddhant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Create connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$src1= $_POST['sql'];

//echo $src1;
/*
Venture_Name
URL
Founder
Email
isContacted
Location
*/
$conflicts = array();

/*$result = $conn->query("SELECT Email FROM Master WHERE Email='a@a.com';");
    while ($row = $result->fetch_array()){
        echo $row['Email'];

    }
return;*/
foreach ($src1 as &$str) {
	//$q = "SELECT TOP 1 Venture_Name FROM Master WHERE Email= '". $str[3] ."' OR URL='". $str[1] ."' OR (Founder= '". $str[2] ."' AND Venture_Name='". $str[0] ."');";
	$q = "SELECT * FROM Master WHERE Email='". $str[3] ."' OR URL='". $str[1] ."' OR (Founder= '". $str[2] ."' AND Venture_Name='". $str[0] ."');";
	$res = $conn->query($q);
	$counter = 0;
	while ($row = $res->fetch_array()){
        $row1 = array();
        $row1["Email"] = $row['Email'];

        $counter = $counter + 1;
    }
	if ($counter){
		//meaning it already exists
		//return conflict
		echo "added ";
		$conflicts[] = $str;
		//you also need something that notifies all of the people when an update has been made
		//add lowercasing as well
		//also once you contact the company there needs to be some way of indicating that and adding it to the database
		//also this assumes that the location stuff isnt in there yet so dont add that
		//right now the main problem is that everything is just being added to the conflict list and not inserted
	}
	else {

		$w = "INSERT INTO Master (Venture_Name, URL, Founder, Email, isContacted, Contacted_By, Location, Priority) VALUES ('".$str[0]."','".$str[1]."','".$str[2]."','".$str[3]."','".$str[4]."','".$str[6]."','".$str[5]."','".$str[6]."');";
		$conn->query($w);
	}
}
header('Content-Type: application/json');
echo json_encode(array(
    "data"      => array(
        "conflicts"   => $conflicts)));

/*
if ($conn->query($str) === TRUE) {
    	echo "New record created successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}*/