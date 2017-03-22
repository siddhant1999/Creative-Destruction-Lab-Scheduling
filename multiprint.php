<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="shortcut icon" type="image/png" href="/dots.png"/>
<link rel="stylesheet" type="text/css" href="fastyle.css">
<!--<script src="fascript.js"></script>-->
</head>

<img id="printlogo" src="/dots.png"/>

<body>

<div id="fa"></div>

<div id="scheduleTable"></div>
</body>

<script type="text/javascript">
var curstr = "";

$(document).ready()
   	$.ajax({
     		type: "POST",
     		url: "processQuery.php",
     		async: false,
     		data: {
            	sqlQuery: "returnLeads"
        	},
     	success: function(result){
     		secondCall(result);
     		console.log(curstr);
			$("#fa").append(curstr);      		
		}
   	});

function secondCall(result){

	curstr = "<ul>";
	var dateQuery = "";
    for (var i = 0; i < result.length; i++) {
		var arr = result[i];
		curstr += "<li value='" + arr + "'>" + arr + "</li>" ;
		curstr += "<ul>";
		dateQuery = "SELECT * FROM Meetings WHERE Lead_1='"+ arr +"' OR Lead_2='"+ arr +"' OR Lead_3='"+ arr +"' ORDER BY Date ASC;"; 

		$.ajax({
    	    type: 'post',
    	    url: 'processQuery.php',
    	    async: false,
    	    data: {
    	        sqlQuery: dateQuery
    	    },
    	    success: function( dateData ) {
    	        //console.log(dateData);
    	        var mySet = new Set();
    	        for (var ll = 0; ll < dateData.length; ll++) {
    	       		var tst = dateData[ll];
    	       		mySet.add(tst['Date']);
    	     	}
    	     	var trew = "";
    	     	for (let item of mySet){
    	       		trew += "<li><a href=''><u>"+ item +"</u></a></li>";
    	       		//trew += "<li>Testing</li>";
    	       		//curstr += trew;
    	       		//console.log(trew);
    	     	}
    	     	console.log(trew);
    	     	curstr += trew;
			}
		});
		curstr += "</ul>";
	}
}
</script>

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

//executeQuery(query);
</script>

</html>