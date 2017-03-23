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

theLeads = [];
theList = [];
var lll = 0;

$(document).ready(function(){
   	$.ajax({
     		type: "POST",
     		url: "processQuery.php",
     		data: {
            	sqlQuery: "returnLeads"
        	},
     	success: function(result){
     		leadArray = [];
     		var dateQuery = "";
    		for (var i = 0; i < result.length; i++) {
    			//iterate over every Lead
				var arr = result[i];
				var ttt = "<li>" + arr + "</li>" ;
				theLeads.push(ttt);
				leadArray.push(arr);
			}
			for (; lll < leadArray.length; lll++) {
				secondCall(leadArray[lll])
			}
			
     		//console.log(curstr);
     		     		
		}
   	});
   	//finished();
});
function finished(){
	var curr = "<ul>";
     	console.log("Lists: ");
     	for (var qq = 0; qq < theLeads.length; qq++) {
     		curr += theLeads[qq];
     		curr += "<ul>" + theList[qq] + "</ul>";
     		console.log(theList[qq]);
     	}
     	curr += "</ul>";
     	console.log("curr");
     	console.log(curr);
     	console.log(theLeads);
     	console.log(theList);
		$("#fa").append(curr); 
}

function secondCall(result){
	console.log("result");
	console.log(result);

	var dateQuery = "";
    	//iterate over every Lead
		var arr = result;
		dateQuery = "SELECT * FROM Meetings WHERE Lead_1='"+ arr +"' OR Lead_2='"+ arr +"' OR Lead_3='"+ arr +"' ORDER BY Date ASC;"; 
		console.log(dateQuery);
		$.ajax({
    	    type: 'post',
    	    url: 'processQuery.php',
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
    	     	}
    	     	console.log("trew" + trew);
    	     	theList.push(trew);
    	     	console.log(arr);
    	     	console.log(trew);
    	     	console.log("This is the value of lll: " + lll);
    	     	
    	     	
			}
		});if (lll == 29) {finished();}
		//curstr += "</ul>";
	
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