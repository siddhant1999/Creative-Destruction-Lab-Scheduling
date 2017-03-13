<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="shortcut icon" type="image/png" href="/dots.png"/>
</head>


<div id="scheduleTable"></div>

<?php

$leadName = $_GET["faname"]; 
$curDate = $_GET["date"];

if (is_null($leadName) And is_null($curDate)):

?>





<body>

<select id="fa" class="selectpicker">


<!--<option value="Andy Burgess" >Andy Burgess</option>
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
-->


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

<script type="text/javascript">

$(document).ready(function(){
   	$("#fa").change(function(){
    	var theName = $(this).val(); /* GET THE VALUE OF THE SELECTED DATA */
     	var dataString = "SELECT * FROM Meetings WHERE Lead_1 IS NOT NULL"; /* STORE THAT TO A DATA STRING */
     	$.ajax({ /* THEN THE AJAX CALL */
       		type: "POST",
       		url: "processQuery.php"
       		async: false,
       		data: dataString,

       		success: function(result){ /* GET THE TO BE RETURNED DATA */
        		$("#scheduleTable").html(result); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
       		}
     	});
   	});
  });
</script>

<?php 
else :
?>

<script>
//This is where we will process all requests

var name = "<?php echo $leadName; ?>";
var date = "<?php echo $curDate; ?>";
var har = name;
name = name.toLowerCase();
var prev1, prev2;
var subtracting = false;

var isGrey = [];

// we still need to implement a method of toggling between dates

var query = "SELECT * FROM Meetings WHERE Date='"+ date +"' AND (LOWER(Lead_1)='" + name +"' OR LOWER(Lead_2)='" + name +"' OR LOWER(Lead_3)='" + name +"' OR Meeting_Number IS NULL) ORDER BY Time_Start;" ;

executeQuery(query);
	
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
		        	console.log(data);
		        	process(data);
		        }
		    });
}

function helper(time){
	time = time.split(':'); // convert to array
	
	// fetch
	var hours = Number(time[0]);
	var minutes = Number(time[1]);
	//var seconds = Number(time[2]);
	/*if (subtracting) {
		if (queryAM == 0) {
			hours = 8;
			minutes = 0;
		}
		else {
			if (minutes<30) {
				minutes = (minutes + 30);
				hours--;
			}
			else {
				minutes -= 30;
			}
		}
	}*/
	// calculate
	var timeValue = "" + ((hours >12) ? hours - 12 : hours);  // get hours
	timeValue += (minutes < 10) ? ":0" + minutes : ":" + minutes;  // get minutes
	//timeValue += (seconds < 10) ? ":0" + seconds : ":" + seconds;  // get seconds
	timeValue += (hours >= 12) ? " PM" : " AM";  // get AM/PM
	return timeValue;
}

function process(obj){

	var distable = "<table class='mytable'><thead><tr><th style='width: 11.2em; min-width: 9.2em;'>Time</th><th>Venture</th><th>Discussion Leads</th></tr></thead><tbody>";
	var prev1 = "";
	var prev2 = "";

	var idk = true;

	$("#scheduleTable").append("<h3><b><u>" + har + "</u><i> - " + date +"</i></b></h3>");

	for (var i = 0; i < obj.length; i++) {
		var arr = obj[i];
		console.log("i : " + i);
		distable += "<tr class='row_" + i + "'>";
		if (arr['is_Custom']) {
			var ty = har;
			if (arr['Venture_Name']!=ty) {
				continue;
			}
		}
		
		var a = helper(arr["Time_Start"]);
		var b = helper(arr["Time_End"]);



		//k so now that we have the times this is a good time to put in the breaks
		//just check if the end time doesnt match up with the next start time, and if not add a break
		

		if (a == b) {
			distable += "<td style='text-align:center;' rowspan='"+ 1 +"'>" + a +"</td>";
		}
		else if (prev1!=a && prev2 !=b) {

			if (prev2 != a && prev2) {
				//add break
				//console.log("Need break here");
				distable += "<td style='background-color: #ececec; text-align:center;'>" + prev2 + " - " + a +"</td><td style='background-color: #ececec;' colspan='2'>Break</td></tr>" + "<tr class='row_" + i + "'>";
			}

			prev1 = a;
			prev2 = b;
			var k = i+1;
			var count =1;

			if (k < obj.length) {
				while(a == helper(obj[k]["Time_Start"]) && b== helper(obj[k]["Time_End"])){
					count++;
					k++;
					if (k == obj.length) {
						break;
					}
				}
			}distable += "<td style='text-align:center;' rowspan='"+ count +"'>" + a + " - " + b +"</td>";
		}

		

		if (arr["Meeting_Number"]) {
			//meaning this is a specific individual meeting
			
			distable += "<td colspan='2'>" + arr["Venture_Name"];
			

			distable += " <b>(Room " + arr["Room_Number"] + ")</b></td>";
		}
		else if (arr["Description"]) {
			
			if (arr['is_Custom']) {
				//console.log("isCustom");
				//console.log(har + " + " + arr['Venture_Name']);
				var ty = har;
				if (har == "A&amp;K Robotics") {ty = "A&K Robotics"}
				if (arr['Venture_Name']==ty) {
					distable += "<td colspan='2'>" + arr["Description"] + "</td>";
					//console.log("Yay");
				}
			}
			else {
				
				//this is a general activity to all
				distable += "<td colspan='2'>" + arr["Description"] + "</td>";
				console.log("Outputing the array isGrey: " + isGrey);
				isGrey.push(i);
				console.log("Is still working");
			}
		}
		else if(arr["Venture_Name"] && arr["Lead_1"]) {
			
			//this is a track meeting
			if (arr["Lead_1"].toLowerCase() == har.toLowerCase()) {
				distable += "<td><b>" + arr["Venture_Name"] + "</b></td><td><b>" + arr["Lead_1"] + "</b></td>";
			}
			else distable += "<td>" + arr["Venture_Name"] + "</td><td>" + arr["Lead_1"] + "</td>";
		}
		
		/*for (var key in obj){
    		var value = obj[key];
			//we may not necessarily need to iterate over all o
    		//document.write(" " + key + ": " + value);
  		}*/
  		distable += "</tr>";
  		//document.write("<br> ");
	}
	distable += "</tbody></table>";

	
	$("#scheduleTable").append(distable);
	
	for (var j = 0; j < isGrey.length; j++) {
		var theid = ".row_" + isGrey[j];

		$(theid).css("background-color", "#ececec");
	}

	$("#scheduleTable").append("<br><h4><b><u>REMINDER: </b></u> Please arrive at each of your meeting locations 10 minute early.</h4>");

	
	$("#scheduleTable").append("<h4><a href='https://goo.gl/maps/8uSykS526Q22'>105 St George St, Toronto, ON M5S 2E8</a></h4><br>");
	$("#venture").remove();
	$("#subven").remove();
}
</script>

<?php
endif;
?>

<script>
// we also need the ability for the FAs to toggle between days (right now I will hard code that, but in the future, we really should be querying that from database, and by that I mean that we see what are the differences that appear in the database)

function startSearch(){
	var name = $("#fa option:selected").val();
	
	str = "?faname=" + name + "&date=2017-02-15"; // <-- this is temporary, in the future I want to be able to query the current date and then make the schedule query based on that

	window.location.replace(str);
	//this is redirecting to the next page in the case where the selection page is presented

	//var query = "SELECT * FROM Meetings WHERE LOWER(Lead_1)='" + name +"' OR (Meeting_Number IS NULL AND is_AM='" + queryAM +  "' AND Date='"+ queryDate +"' ) ORDER BY Time_Start;" ;
}


</script>
<style type="text/css">

body {
	font-size: 140%;
	font-family: Calibri,Arial, Helvetica, sans-serif;
	  -webkit-appearance: none; -moz-appearance: none;
  /*display: block;*/
  width: 100%;
}

h3,h4 {
	margin-left: auto;
	margin-right: auto;
	text-align: center;
}

@media (max-width: 767px) {

select {
  font-size: 240%;
}


}

select {
	margin-left: auto;
	margin-right: auto;
	font-size: 140%;
}
table {
	width: 80%;
		margin-left: auto;
		margin-right: auto;
		max-width: 800px;
}
	table.mytable {
		font-size: 130%;
		border: 1px solid #CCC; 
		font-family: Calibri, Arial, Helvetica, sans-serif;
		margin-top: 5px;
	} 
	.mytable td {
		padding: 4px;
		margin: 3px;
		border: 1px solid #000;
	}
	.mytable th {
		background-color: #000; 
		color: #FFF;
		font-weight: bold;
	}
</style>
