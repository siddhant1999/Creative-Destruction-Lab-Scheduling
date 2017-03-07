
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="shortcut icon" type="image/png" href="/dots.png"/>
</head>

<div id="scheduleTable">ok</div>

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

var name = "<?php echo $leadName; ?>";
var date = "<?php echo $curDate; ?>";

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

var prev1, prev2;
var subtracting = false;
var isGrey = [];

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

	var distable = "<table class='mytable'><thead><tr><th style='min-width: 9.2em;'>Time</th><th>Venture</th><th>Discussion Leads</th></tr></thead><tbody>";
	var prev1 = "";
	var prev2 = "";

	var idk = true;
	var har = name;

	$("#scheduleTable").append("<h3><b><u>" + har + "</u><i> - " + date +"</i></b></h3>");

	for (var i = 0; i < obj.length; i++) {
		var arr = obj[i];
		distable += "<tr class='row_" + i + "'>";
		if (arr['is_Custom']) {
			var ty = har;
			if (har == "A&amp;K Robotics") {ty = "A&K Robotics"}

				if (arr['Venture_Name']!=ty) {
					continue;
				}
		}
		console.log("Here 1");
		var a = helper(arr["Time_Start"]);
		var b = helper(arr["Time_End"]);

		if (i==0 || idk) {
			idk = false;
			var tempa = arr["Time_Start"];
			//subtracting =true;
			tempa = helper(tempa);
			//subtracting = false;

			distable += "<td style='background-color: #ececec; text-align:center;'>" + tempa + " - " + a +"</td><td style='background-color: #ececec;' colspan='2'>Check In at CDL Office <b>(Room 2052)</b></td></tr>" + "<tr>";

		}

		//k so now that we have the times this is a good time to put in the breaks
		//just check if the end time doesnt match up with the next start time, and if not add a break
		console.log("Here 2");


		if (prev1!=a && prev2 !=b) {

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

		console.log("Here 3");

		if (arr["Meeting_Number"]) {
			//meaning this is a specific individual meeting
			console.log("Here 4");
			distable += "<td colspan='2'>Individual Meeting with " + arr["Lead_1"];
			for (var l = 2;l<4; l++) {
				var tt = "Lead_" + l;
				if (arr[tt]) {
					distable += " and "  + arr[tt];
				}
				else break;

			}

			distable += " in <b>Room " + arr["Room_Number"] + "</b></td>";
		}
		else if (arr["Description"]) {
			console.log("Here 5");
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
				console.log("Here 6");
				//this is a general activity to all
				distable += "<td colspan='2'>" + arr["Description"] + "</td>";
				isGrey.push(i);
			}
		}
		else if(arr["Venture_Name"] && arr["Lead_1"]) {
			console.log("Here 7");
			//this is a track meeting
			if (arr["Venture_Name"] == har) {
				distable += "<td><b>" + arr["Venture_Name"] + "<b></td><td><b>" + arr["Lead_1"] + "</b></td>";
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
	console.log("Here Final");

	
	$("#scheduleTable").append(distable);
	console.log("Here Final2");
	for (var j = 0; j < isGrey.length; j++) {
		var theid = ".row_" + isGrey[j];

		$(theid).css("background-color", "#ececec");
	}

	$("#scheduleTable").append("<br><h4><b><u>REMINDER: </b></u> Please arrive at each of your meeting locations 10 minute early.</h4>");

	var ut, pw;

	if (har[0] <= 'B') {
		ut = "qq190481";
		pw = "Uve2eothaa";
	}
	else if (har[0] == 'C' || (har[0] == 'D' && har[0] == 'a')) {
		ut = "qq190482";
		pw = "eu2Kapeisi"
	}
	else if (har[0] < 'F') {
		ut = "qq190483";
		pw = "jo5Uqueima";
	}
	else if (har[0] <= 'G') {
		ut = "qq190484";
		pw = "ahT5reegee";
	}
	else if (har[0] <= 'K') {
		ut = "qq190469";
		pw = "ieCe8pheek";
	}
	else if (har[0] <= 'N') {
		ut = "qq190476";
		pw = "quiexai7It";
	}
	else if (har[0] <= 'R') {
		ut = "qq190479";
		pw = "phiaLira7r";
	}	
	else if (har[0] <= 'T') {
		ut = "qq190480";
		pw = "eth2oeLees";
	}
	else {
		ut = "qq190485";
		pw = "Jix5aiquai";
	}
	$("#scheduleTable").append("<h4>Network: <b>UofT</b> | Username: <b>"+ ut + "</b> | Password: <b>" + pw + "</b></h4>");
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
	name = name.toLowerCase();
	str = "?faname=" + name + "&date=2017-02-14"; // <-- this is temporary, in the future I want to be able to query the current date and then make the schedule query based on that

	window.location.replace(str);
	//var query = "SELECT * FROM Meetings WHERE LOWER(Lead_1)='" + name +"' OR (Meeting_Number IS NULL AND is_AM='" + queryAM +  "' AND Date='"+ queryDate +"' ) ORDER BY Time_Start;" ;
}
</script>