<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  </head>
<body>
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

$src1= "SELECT * FROM Ventures WHERE Continent IS NOT NULL;";

$result = $conn->query($src1);
    
    
    $ventures = array();
    
    
    while ($row = $result->fetch_array()){
        $row1 = array();

        $row1["Name"] = $row['Name'];
        $row1["City"] = $row['City'];
        $row1["Country"] = $row['Country'];
        $row1["Continent"] = $row['Continent'];
        $row1["URL"] = $row['URL'];

        $ventures[] = $row1;
    }
$src2 = "SELECT *, count(*) AS frequency FROM Ventures WHERE LENGTH(Continent) GROUP BY Continent ORDER BY count(*) DESC;";
$result2 = $conn->query($src2);
    
    
    $vens = array();
    $sizeArray = array();
    $contArray = array();
    $totalSum = 0;
    while ($row = $result2->fetch_array()){
        $row2 = array();

        $row2["Name"] = $row['Name'];
        $row2["City"] = $row['City'];
        $row2["Country"] = $row['Country'];
        $row2["Continent"] = $row['Continent'];
        $row2["URL"] = $row['URL'];

        array_push($sizeArray, $row['frequency']);
        array_push($contArray, $row['Continent']);
        $totalSum += $row['frequency'];

        $vens[] = $row2;
    }
    //echo json_encode(array("data"      => array("ventures"   => $ventures)));
?>
	<div id="con_1" class="cons"></div><div id="con_2" class="cons"></div><div id="con_3" class="cons"></div><div id="con_4" class="cons"></div><div id="con_5" class="cons"></div><div id="con_6" class="cons"></div>
</body>
</html>

<style type="text/css">
#con_1 {
	background-color: red;
}
#con_2 {
	background-color: orange;
}
#con_3 {
	background-color: yellow;
}
#con_4 {
	background-color: green;
}
#con_5 {
	background-color: blue;
}
#con_6 {
  background-color: purple;
}
.cons{
	display: inline-block;
}
body {
	display: flex;
	margin: 0;
	padding: 0;
}

</style>

<script type="text/javascript">
var sizes, totalSum, continents;
$(function() {
    
    var venture_data = '<?php echo json_encode(array("data"      => array("ventures"   => $ventures)));?>';
    venture_data = JSON.parse(venture_data);
    console.log(venture_data);

    var ven_data = '<?php echo json_encode(array("data"      => array("vens"   => $vens)));?>';
    ven_data = JSON.parse(ven_data);
    console.log(ven_data);

    sizes = '<?php echo json_encode(array("data"      => array("sizes"   => $sizeArray)));?>';
    sizes = JSON.parse(sizes)
    console.log(sizes);

    continents = '<?php echo json_encode(array("data"      => array("continents"   => $contArray)));?>';
    continents = JSON.parse(continents);
    console.log(continents["data"]["continents"]);

    totalSum = '<?php echo json_encode($totalSum);?>';
    totalSum = JSON.parse(totalSum);
    console.log(totalSum);

    onresize();
});

var onresize = function() {
  //your code here
  //this is just an example
  width = document.body.clientWidth;
  height = document.body.clientHeight;

  //console.log(sizes["data"]);

  document.getElementById("con_1").style.width = width*sizes["data"]["sizes"][0]/totalSum;
  document.getElementById("con_2").style.width = width*sizes["data"]["sizes"][1]/totalSum;
  document.getElementById("con_3").style.width = width*sizes["data"]["sizes"][2]/totalSum;
  document.getElementById("con_4").style.width = width*sizes["data"]["sizes"][3]/totalSum;
  document.getElementById("con_5").style.width = width*sizes["data"]["sizes"][4]/totalSum;
  document.getElementById("con_6").style.width = width*sizes["data"]["sizes"][5]/totalSum;
  
  document.getElementById("con_1").style.height = height;
  document.getElementById("con_2").style.height = height;
  document.getElementById("con_3").style.height = height;
  document.getElementById("con_4").style.height = height;
  document.getElementById("con_5").style.height = height;
  document.getElementById("con_6").style.height = height;

  $('#con_1').text(continents["data"]["continents"][0]);
  $('#con_2').text(continents["data"]["continents"][1]);
  $('#con_3').text(continents["data"]["continents"][2]);
  $('#con_4').text(continents["data"]["continents"][3]);
  $('#con_5').text(continents["data"]["continents"][4]);
  $('#con_6').text(continents["data"]["continents"][5]);

   console.log(width + " " + height);
}
window.addEventListener("resize", onresize);

	//alert(screen.innerWidth + " " + screen.innerHeight);
</script>