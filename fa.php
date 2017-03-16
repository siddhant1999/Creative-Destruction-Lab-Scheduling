<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="shortcut icon" type="image/png" href="/dots.png"/>
<link rel="stylesheet" type="text/css" href="fastyle.css">
</head>

<img id="printlogo" src="/dots.png"/>

<?php


$leadName = $_GET["faname"]; 
$curDate = $_GET["date"];

if (is_null($leadName) And is_null($curDate)):

?>

<body>

<select id="fa" class="selectpicker">

</select>

<script type="text/javascript">

$(document).ready()
   	$.ajax({
     		type: "POST",
     		url: "processQuery.php",
     		async: false,
     		data: {
            sqlQuery: "returnLeads"
        },
     	success: function(result){
     		var curstr = "";
      		for (var i = 0; i < result.length; i++) {
				var arr = result[i];
				curstr += "<option value='" + arr + "'>" + arr + "</option>" ;
			}
			$("#fa").append(curstr);      		
		}
   	});

</script>


<button id="subven" onclick="startSearch()">Submit</button>

<div id="scheduleTable"></div>


</body>
</html>


<?php 
else :
?>
<div id="header" class="row">
<div class="col-sm-3"></div>
<div id="logocon" class="col-sm-1" ><img id="logo" src="/dots.png"/></div>


</div>

<div id="scheduleTable"></div>
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
	$("#header").append("<div id='titleHead' class='col-sm-4' ><h3><b>G7/ML7 Meeting<i> - "+ date + "</i><br>" + har + "</b></h3>");

	var dateQuery = "SELECT * FROM Meetings;";
	$.ajax({
		        type: 'post',
		        url: 'processQuery.php',
		        async: false,
		        data: {
		            sqlQuery: dateQuery
		            //sqlInserts: allstrings
		        },
		        success: function( dateData ) {
		        	console.log(dateData);
		        	var mySet = new Set();
		        	for (var i = 0; i < dateData.length; i++) {
						var arr = dateData[i];
						console.log(arr['Date']);

						//$("#scheduleTable").append("<a href='"+ arr['Date'] +"''>"+ arr['Date'] +"</a><br>");
						if (arr['Date'] != date)
							mySet.add(arr['Date']);
					}
					for (let item of mySet){
						str = "?faname=" + har + "&date=" + item;
						$("#titleHead").append("<h4><a href='"+ str +"''>View: <u>"+ item +"</a></u></h4>");
					} 
				$("#titleHead").append("</div>");
					

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


		        },
		        error: function(){
    				alert('error!');
  				}
		    });

	
}

function helper(time){
	time = time.split(':'); // convert to array
	
	// fetch
	var hours = Number(time[0]);
	var minutes = Number(time[1]);
	
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

	for (var i = 0; i < obj.length; i++) {
		var arr = obj[i];
		//console.log("i : " + i);
		distable += "<tr class='row_" + i + "'>";
		if (arr['is_Custom']) {
			var ty = har;
			if (arr['Venture_Name']!=ty) {
				continue;
			}
		}
		
		var a = helper(arr["Time_Start"]);
		var b = helper(arr["Time_End"]);

		if (a == b) {
			distable += "<td style='text-align:center;' rowspan='"+ 1 +"'>" + a +"</td>";
		}
		else if (prev1!=a && prev2 !=b) {

			if (prev2 != a && prev2) {
				//add break
				//console.log("Need break here");
				distable += "<td style='text-align:center;' class='greyback'>" + prev2 + " - " + a +"</td><td class='greyback' colspan='2'>Break</td></tr>" + "<tr class='row_" + i + "'>";
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

		$(theid).addClass("greyback");
		//$(theid).css("background-color", "#ececec");
		//$(theid).css("background-color", "#ececec !important", "print");
		//$(theid).append('<style type="text/css" media="print">background-color: #ececec !important</style>');
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

