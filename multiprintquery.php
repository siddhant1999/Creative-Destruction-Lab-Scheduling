<?php
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
    $getLeads = 'SELECT Lead_1, Lead_2, Lead_3 FROM Meetings WHERE LENGTH(Lead_1) > 0 AND Lead_1 IS NOT NULL;';
    $result = $conn->query($getLeads);
    $fullArray = array();
    while ($row = $result->fetch_array()){
        //echo $row['Lead_1'];
        //$row1 = array();
        $qr1 = addslashes($row["Lead_1"]);
        array_push($fullArray, $qr1);

        if(strlen($row["Lead_2"])){
            $qr2 = addslashes($row["Lead_2"]);
            array_push($fullArray, $qr2);
        }
        if(strlen($row["Lead_3"])){
            $qr3 = addslashes($row["Lead_3"]);
            array_push($fullArray, $qr3);
        }
    }
    //echo "done";
    header('Content-Type: application/json');
    $uniq = array_unique($fullArray);
    sort($uniq);
    // Here we now have an array of unique Leads
    // Now we need to iterate over it
    //$abc = json_encode($uniq);
    //echo $abc;
    $dateArray = array();
    foreach($uniq as &$i) { 
        $dateQuery = 'SELECT Date FROM Meetings WHERE Lead_1="'. $i .'" OR Lead_2="'. $i .'" OR Lead_3="'. $i .'" ORDER BY Date ASC;';
        //$tst = "";
        $uniqdate = array();
        $dates = $conn->query($dateQuery);
        while ($r = $dates->fetch_array()){
            array_push($uniqdate, $r["Date"]);
        }
        $uniqueDateArray = array_unique($uniqdate);
        $smallArray = array();
        foreach ($uniqueDateArray as &$rr){
            array_push($smallArray, $rr);
            //$tst .= $rr . "<br>";
        }
        //$tst .= "<br>";
        //array_push($dateArray,array("name" => $i));
        //array_push($dateArray,array("dates" => $smallArray));
        $tem = array(
            'name' => $i,
            'dates' => $smallArray
            );
        array_push($dateArray, $tem);
        /*$post_data = array(
            'item' => array(
            'name' => $i,
            'dates' => $smallArray
            )
        );*/
    }
    //$abc = json_encode($uniq);
    //$cba = json_encode(array('leads' => $dateArray));
    //$cba = json_encode($post_data);
    $cba = json_encode($dateArray);
    //echo $abc;
    echo $cba;
?>