
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>

<?php

$leadName = $_GET["faname"]; 
$curDate = $_GET["date"];

if (is_null($leadName) And is_null($curDate)):

?>





<body>

<select id="fa" class="selectpicker">


<option value="Andy Burgess" >Andy Burgess</option>
<option value="Arielle Zuckerberg" >Arielle Zuckerberg</option>
<option value="Ashmeet Sidana" >Ashmeet Sidana</option>
<option value="Barney Pell" >Barney Pell</option>
<option value="Boris Wertz">Boris Wertz</option>
<option value="Dennis Bennie" >Dennis Bennie</option>
<option value="Dror Berman" >Dror Berman</option>
<option value="Geordie Rose" >Geordie Rose</option>
<option value="Haig Ferris" >Haig Ferris</option>
<option value="Johann Koss" >Johann Koss</option>
<option value="Johann Koss" >Johann Koss</option>
<option value="John Francis" >John Francis</option>
<option value="Ken Nickerson" >Ken Nickerson</option>
<option value="Lally Renentilla" >Lally Renentilla</option>
<option value="Lisa Shields" >Lisa Shields</option>
<option value="Lyon Wong" >Lyon Wong</option>
<option value="Micah Siegal" >Micah Siegal</option>
<option value="Michael Hyatt">Michael Hyatt</option>
<option value="Mike Serbinis">Mike Serbinis</option>
<option value="Nicolas Chapados" >Nicolas Chapados</option>
<option value="Richard Hyatt">Richard Hyatt</option>
<option value="Sally Daub" >Sally Daub</option>
<option value="Satish Kanwar" >Satish Kanwar</option>
<option value="Shivon Zilis" >Shivon Zilis</option>
<option value="Stephan Uhrenbacher">Stephan Uhrenbacher</option>
<option value="Ted Livingston" >Ted Livingston</option>
<option value="Tomi Poutanen" >Tomi Poutanen</option>
<option value="Tyson Clark" >Tyson Clark</option>
<option value="William Tunstall-Pedoe">William Tunstall-Pedoe</option>
<option value="Zavain Dar" >Zavain Dar</option>

<!--

Plan
Query everything where this person is listed as lead1, lead2, or lead3
Display the times as usual, but just display the venture name and do not worry about the other leads
Then query everything else as well, things that are general to everyone

Also since these are the leads we need to add an extra "reception" at the end of the day, manually
-->

</select>

<button id="subven" onclick="startSearch()">Submit</button>

<div id="scheduleTable"></div>


</body>
</html>

<?php 
else :
?>

<script>
//This is where we will process all requests
function searching() {
	var name = <?php echo $leadName; ?>;
	alert(name);
	var query = "SELECT * FROM Meetings WHERE LOWER(Lead_1)='" + name +"' OR LOWER(Lead_2)='" + name +"' OR LOWER(Lead_3)='" + name +"' OR Meeting_Number IS NULL ORDER BY Time_Start;" ;

	executeQuery(query);
	
}
function executeQuery(query){
	$.ajax({
		        type: 'post',
		        url: 'processQuery.php',
		        async: false,
		        data: {
		            sqlQuery: query
		            //sqlInserts: allstrings
		        },
		        success: function( data ) {
		        	console.log("Here is the data retrived:");
		        	document.write(data);

		            //console.log(data);
		            //console.log(allstrings);
		            //alert("Complete");
		        }
		    });
}

</script>

<?php
endif;
?>
<script>
// we also need the ability for the FAs to toggle between days (right now I will hard code that, but in the future, we really should be querying that from database, and by that I mean that we see what are the differences that appear in the database)

function startSearch(){
	var name = $("#fa option:selected").val();
	name = name.toLowerCase();
	str = "?faname=" + name + "&date=2017-12-14"; // <-- this is temporary, in the future I want to be able to query the current date and then make the schedule query based on that

	window.location.replace(str);
	//var query = "SELECT * FROM Meetings WHERE LOWER(Lead_1)='" + name +"' OR (Meeting_Number IS NULL AND is_AM='" + queryAM +  "' AND Date='"+ queryDate +"' ) ORDER BY Time_Start;" ;
}
</script>