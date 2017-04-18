


function adding(){
	var wer = '<br><div id="date">Date: <input id="thedate" type="date"></input> AM or PM: <select id="when"><option selected disabled>-</option><option value="AM">AM</option><option value="PM">PM</option></select></div><br>';
	var abcwer = '<div id="exampletable">Example:<br><div><table id="table_1" style="background-color: #dfdfdf;" class="mytable"><thead><tr class="row-0"><th class="col-0">Room Number</th><th class="col-1">Lead 1 </th><th class="col-2">Lead 2 </th><th class="col-3">Lead 3</th><th class="col-4">Meeting 1</th><th class="col-5">Meeting 2</th><th class="col-6">Meeting 3</th><th class="col-7">Meeting 4</th></tr></thead><tbody><tr class="row-1"><td class="col-0">2066</td><td class="col-1">Dennis Bennie</td><td class="col-2">Ken Nickerson</td><td class="col-3">Andy Burgess</td><td class="col-4">Landmine Boys</td><td class="col-5">Fluent.Ai</td><td class="col-6">FREDSense</td><td class="col-7">Gbatteries</td></tr><tr class="row-2"><td class="col-0">2068</td><td class="col-1">Tomi Poutanen</td><td class="col-2">Zavain Dar</td><td class="col-3"></td><td class="col-4">Pegasus</td><td class="col-5">ICSPI</td><td class="col-6">Citizen Hex</td><td class="col-7">Vention</td></tr><tr class="row-3"><td class="col-0">2070</td><td class="col-1">Lally Rementilla</td><td class="col-2">Haig Farris</td><td class="col-3"></td><td class="col-4">FREDSense</td><td class="col-5">Citizen Hex</td><td class="col-6">Pegasus</td><td class="col-7">Landmine Boys</td></tr><tr class="row-4"><td class="col-0">2072</td><td class="col-1">Lisa Shields</td><td class="col-2">Tony Lacavera</td><td class="col-3"></td><td class="col-4">MedStack</td><td class="col-5">Elucid Labs</td><td class="col-6">Vention</td><td class="col-7">Citizen Hex</td></tr><tr class="row-5"><td class="col-0">2074</td><td class="col-1">Nicolas Chapados</td><td class="col-2">John Francis</td><td class="col-3"></td><td class="col-4">Elucid Labs</td><td class="col-5">MedStack</td><td class="col-6">H2NanO</td><td class="col-7">Fluent.Ai</td></tr><tr class="row-6"><td class="col-0">2076</td><td class="col-1">Michael Hyatt</td><td class="col-2">Satish Kanwar</td><td class="col-3"></td><td class="col-4">Citizen Hex</td><td class="col-5">Nix Sensor</td><td class="col-6">Landmine Boys</td><td class="col-7">FredSense</td></tr><tr class="row-7"><td class="col-0">2078</td><td class="col-1">Jevon MacDonald</td><td class="col-2">Lyon Wong</td><td class="col-3">Richard Hyatt</td><td class="col-4">H2NanO</td><td class="col-5">Vention</td><td class="col-6">Gbatteries</td><td class="col-7">Nix Sensor</td></tr><tr class="row-8"><td class="col-0">2080</td><td class="col-1">Dror Berman</td><td class="col-2">Micah Siegel</td><td class="col-3"></td><td class="col-4">Vention</td><td class="col-5">FREDsense</td><td class="col-6">Elucid Labs</td><td class="col-7">ICSPI</td></tr><tr class="row-9"><td class="col-0">2082</td><td class="col-1">Ashmeet Sidana</td><td class="col-2">Shivon Zillis</td><td class="col-3"></td><td class="col-4">Fluent.Ai</td><td class="col-5">H2NanO</td><td class="col-6">ICSPI</td><td class="col-7">Elucid Labs</td></tr><tr class="row-10"><td class="col-0">2084</td><td class="col-1">Sally Daub</td><td class="col-2">Mike Serbinis</td><td class="col-3">Moe Kermani</td><td class="col-4">Gbatteries</td><td class="col-5">Landmine Boys</td><td class="col-6">Nix Sensor</td><td class="col-7">MedStack</td></tr><tr class="row-11"><td class="col-0">2086</td><td class="col-1">William Tunstall-Pedoe</td><td class="col-2">Barney Pell</td><td class="col-3"></td><td class="col-4">ICSPI</td><td class="col-5">Gbatteries</td><td class="col-6">Fluent.Ai</td><td class="col-7">Pegasus</td></tr><tr class="row-12"><td class="col-0">2088</td><td class="col-1">Boris Wertz</td><td class="col-2">Stephan Uhrenbacher</td><td class="col-3"></td><td class="col-4">Nix Sensor</td><td class="col-5">Pegasus</td><td class="col-6">MedStack</td><td class="col-7">H2NanO</td></tr></tbody></table></div>';
	//Number of Leads: <select required="" id="lead_count"><option value="1">1</option><option value="2" selected="selected">2</option><option value="3">3</option></select> Number of Meetings Slots: <input id="meeting_count" type="number" min="0" value="4" style="width: 3em;"></div>';
	var abwer = '<textarea id="inserted" style="width: 60%; height: 20%; margin-top: 20px;" placeholder="Please Enter the Meeting Schedule with Leads, Room Numbers, and Meetings"></textarea><button id="text_complete" onclick="processFirst()">Import</button> <div id="firsttable"></div><div id="timeimport"></div><div id="secondtable"></div><div id="completetracks"></div><div id="allgroups"></div><div id="finalImport"></div>';
	//these are the example tables for the uploader to see and correct themselves by
	$("body").append(wer);
	$("body").append(abcwer);
	$("body").append(abwer);
	$("#ad").remove();
	$("#dl").remove();	
}

//we can either do AM or PM or ask when the morning ends and the afternoon begans

function deleting(){
	var sure = prompt("Please enter \"DELETE\" to delete ALL entries", "");
    
    if (sure != "DELETE") {
        alert("NO ACTION");
    }
    else {
    	var del = "DELETE FROM Meetings";

    	$.ajax({
    	    type: 'post',
    	    url: 'processQuery.php',
    	    async: false,
    	    data: {
    	        sqlQuery: del
    	    },
    	    success: function( data ) {
    	        alert("DELETED ALL ELEMENTS");
    	    }
    	});

    	

    }
    location.reload();	

}

function processFirst() {
	//console.log("Here");
	var lines = $('#inserted').val().split('\n');
	//header
	var inserted_table = "<table id='table_1' class='mytable'><thead>";
	if ($("#when option:selected").val() != "AM" && $("#when option:selected").val() != "PM") {
		alert("Please Select AM or PM");
		return;
	}
	if ($("#when option:selected").val() == "AM") {
		is_morn = 0;
	}
	
	for(var i = 0;i < lines.length;i++){
		var vals = lines[i].split(/[\t]/);
		inserted_table= inserted_table.concat("<tr class='row-"+ i +"'>");
		

		for (var j = 0; j < vals.length; j++) {
			if(i==0){
				inserted_table = inserted_table.concat("<th class='col-"+ j +"'>" + vals[j] + "</th>");
			}
			else {
				inserted_table = inserted_table.concat("<td class='col-"+ j +"'>" + vals[j] + "</td>");
			}

		}
		
		inserted_table = inserted_table.concat("</tr>");

		if (i == 0) {
			inserted_table = inserted_table.concat("</thead></tbody>");
		}

		lines[i] = vals;
	}
	inserted_table += "</tbody></table>";

	var time_import =  "<textarea id='timings' placeholder='Please Enter the Meeting Timings By Meeting Number, Start Time, and End Time' style='width: 40%; height: 20%; margin-top: 20px;'></textarea> <button id='time_complete' onclick='processSecond()'>Import</button>";

	var clarifications = "Number of Leads: <select required id='lead_count'><option value='1'>1</option><option value='2' selected='selected'>2</option><option value='3'>3</option></select> Number of Meetings Slots: <input id='meeting_count' type='number' min='0' value='4' style='width: 3em;'></input>";

	$("#inserted").remove();
	$("#text_complete").remove();
	$("#exampletable").remove();
	$("#firsttable").append(inserted_table);
	$("#firsttable").append(clarifications);
	var meetingtime = '<div id="exampletable2">Example:<br><table id="table_ex" style="background-color: #dfdfdf;" class="mytable"><thead><tr class="row-0"><th class="col-0">Meeting  Type</th><th class="col-1">Start time</th><th class="col-2">End Time</th></tr></thead><tbody><tr class="row-1"><td class="col-0">1</td><td class="col-1">14:00</td><td class="col-2">14:20</td></tr><tr class="row-2"><td class="col-0">2</td><td class="col-1">14:20</td><td class="col-2">14:40</td></tr><tr class="row-3"><td class="col-0">3</td><td class="col-1">14:40</td><td class="col-2">15:00</td></tr><tr class="row-4"><td class="col-0">4</td><td class="col-1">15:00</td><td class="col-2">15:20</td></tr><tr class="row-5"><td class="col-0">Deliberations</td><td class="col-1">17:40</td><td class="col-2">18:00</td></tr><tr class="row-6"><td class="col-0">Meeting Adjourns</td><td class="col-1">18:00</td><td class="col-2">18:00</td></tr></tbody></table></div>';
	//console.log("outputing meetingtime: " + meetingtime);
	$("#firsttable").append(meetingtime); // not currently working
	$("#timeimport").append(time_import); 
	//console.log(inserted_table);
	//console.log(vals);
}

function processSecond(){
	var lines = $('#timings').val().split('\n');
	//header
	var inserted_table = "<table id='table_2' class='mytable'><thead>";
	
	for(var i = 0;i < lines.length;i++){
		var vals = lines[i].split(/[\t]/);
		inserted_table= inserted_table.concat("<tr class='row-"+ i +"'>");

		for (var j = 0; j < vals.length; j++) {
			if(i==0){
				inserted_table = inserted_table.concat("<th class='col-"+ j +"'>" + vals[j] + "</th>");
			}
			else {
				inserted_table = inserted_table.concat("<td class='col-"+ j +"'>" + vals[j] + "</td>");
			}

		}
		
		inserted_table = inserted_table.concat("</tr>");

		if (i == 0) {
			inserted_table = inserted_table.concat("</thead></tbody>");
		}

		lines[i] = vals;
	}
	inserted_table += "</tbody></table>";

	$("#secondtable").append(inserted_table);
	$("#timeimport").remove();
	$("#timings").remove();
	$("#exampletable2").remove();
	$("#allgroups").append("<button id='addtrack' onclick='addTrack()'>Add a Group Meeting</button><br>");
	$("#allgroups").append("<button id='addCustom' onclick='addCustom()'>Add a Custom Event</button><br>");

	
	//console.log($("#lead_count option:selected").val());
	//alternatively .text() can also be used


	processTables($("#lead_count option:selected").val(), $('#meeting_count').val());
	//^^ this needs to go after the very final import
	//actually it might be okay to do this now because we should probably just push the track meetings to the database as they come in
	//Then we will also need a way delete all rows that pretain to a track meeting because I can't really think of another way of doing this otherwise

}

function addCustom(){

	var tin = "<div id='sdate'><br>Date: <input id='thesdate' type='date'></input> AM or PM: <select id='amorpm'><option value='AM'>AM</option><option value='PM'>PM</option></select></div>";

	tin += "<div id='timepid' ><br>Start Time: <input id='pstime' type='time'></input> End Time: <input id='petime' type='time'></input><br></div>";
	tin += "<div id='roomnum' ><br>Room: <input id='roomnums'></input>";
	tin += "<div id='des' ><br>Description <br><textarea id='desc'></textarea></div>";
	tin += "<div id='ven' ><br>Ventures Included <br><textarea id='vens' placeholder='newline seperated'></textarea></div>";
	tin += "<div id='led' ><br>Leads Included <br><textarea id='leds' placeholder='newline seperated'></textarea><br></div>";
	tin += "<button id='custombutton' onclick='customImport()'>Import Custom Event</button>"
	
	$("#allgroups").append(tin);

	//at the end of this function you need the option to import, but also the option to add another function
}

function customImport(){
	var is_morni = 1;
	if ($("#amorpm option:selected").val() == "AM") {
		is_morni = 0;
	}

	//here is where the import will take place
	var curdate = $("#thesdate").val();
	var starttime = $("#pstime").val();
	var endtime = $("#petime").val();
	var room = $("#roomnums").val();

	var description1 = $("#desc").val();
	var venturesincluded = $("#vens").val().split('\n');
	var leadsincluded = $("#leds").val().split('\n');
	//alert("Size of vens: " + venturesincluded.length + " \n Size of leds" + leadsincluded.length);

	var array = [];

	for(var pp = 0; pp < leadsincluded.length; pp++){
		if (leadsincluded[pp].length < 1) {break;}
		//every one of these needs its own insertion
		console.log("Over here, importing custom lead event");
		var inser = "INSERT INTO Meetings (Date, is_AM, Time_Start, Time_End, Description, Lead_1, is_Custom, Room_Number) VALUES ('" + curdate + "' , " +is_morni + " , '" + starttime + "', '" + endtime + "' , '" + description1 + "','" + leadsincluded[pp] + "' , '1', '" + room + "');";
		//console.log(inser);
		array.push(inser);
	}
	
	for(var i = 0; i < venturesincluded.length; i++){
		//every one of these needs its own insertion
		if (venturesincluded[i].length < 1) {break;}
		console.log("Over here, importing custom venture event");
		var inse = "INSERT INTO Meetings (Date, is_AM, Time_Start, Time_End, Description, Venture_Name, is_Custom, Room_Number) VALUES ('" + curdate + "' , " + is_morni + " , '" + starttime + "', '" + endtime + "' , '" + description1 + "','" + venturesincluded[i] + "' , '1', '" + room + "');";

		array.push(inse);
		
	}
	

	$("#sdate").remove();
	$("#timepid").remove();
	$("#des").remove();
	$("#ven").remove();
	$("#roomnum").remove();
	$("#led").remove();
	$("#custombutton").remove();
	console.log("inserting");
	for (var i = 0; i < array.length; i++) {
		console.log(array[i]);
	}
	$.ajax({
   	    type: 'post',
   	    url: 'processTables.php',
   	    async: false,
   	    data: {
   	        sqlInserts: array
   	    },
   	    success: function( data ) {
   	        //console.log(data);
   	    }
   	});

	// lets newline seperate this 


}


function addTrack(){
	$("#allgroups").append("<textarea id='groupinsert' style='width: 60%; height: 20%; margin-top: 20px;' placeholder='Please Enter the Venture Names Followed By the Corresponding Lead'></textarea>");
	$("#allgroups").append("<br><div id='timeid' >Start Time: <input id='gstime' type='time'></input> End Time: <input id='getime' type='time'></input></div><br>");
	$("#allgroups").append("<button onclick='processTrack()'>Import This Group Meeting</button>");
}

var trackcounter = 2;

var is_morn = 1;


function processTrack(){
	//here is where we will push to the database immediately
	//that way we don't have to store all the tables on hand and have it be a hastle
	
	var lines = $('#groupinsert').val().split('\n');
	trackcounter++;
	//header
	var alltrackstrings = [];
	//reject if the time slots are empty
	if (!($.trim($("#gstime").val()) && $.trim($("#getime").val()))) {
		alert("Enter a Valid Start & End Time");
		return;
	}
	var inserted_table = "<table id='table_"+ trackcounter +"' class='mytable'><thead>";
	

	for(var i = 0;i < lines.length;i++){
		var vals = lines[i].split(/[\t]/);
		inserted_table= inserted_table.concat("<tr class='row-"+ i +"'>");
		//check if is AM

		
		var insertions  = "INSERT INTO Meetings (Date, is_AM, Time_Start, Time_End,Venture_Name, Lead_1 ) VALUES ('" + $("#thedate").val() + "' , '" + is_morn + "' , '" + $("#gstime").val() + "' , '" + $("#getime").val() + "', '" + vals[0] + "' , '" + vals[1] + "');";

		//console.log("is_morn:");
		//console.log(is_morn);
		if(i){
			alltrackstrings.push(insertions);
		}

		for (var j = 0; j < vals.length; j++) {
			if(i==0){
				inserted_table = inserted_table.concat("<th class='col-"+ j +"'>" + vals[j] + "</th>");
			}
			else {
				inserted_table = inserted_table.concat("<td class='col-"+ j +"'>" + vals[j] + "</td>");
			}

		}
		
		inserted_table = inserted_table.concat("</tr>");

		if (i == 0) {
			inserted_table = inserted_table.concat("</thead></tbody>");
		}

		lines[i] = vals;
	}
	inserted_table += "</tbody></table>";
	//console.log(alltrackstrings);
	
	$("#completetracks").append(inserted_table);
	$("#allgroups").empty();

	$("#addtrack").remove();
	$("#allgroups").append("<button id='addtrack' onclick='addTrack()'>Add a Group Meeting</button><br>");
	$("#timeid").remove();
	pushTrackstoPHP(alltrackstrings);

	//var tmeets = document.getElementById("table_tr");
}

function pushTrackstoPHP(arr){
    $.ajax({
        type: 'post',
        url: 'processTables.php',
        data: {
            sqlInserts: arr
        },
        success: function( data ) {
            //console.log(data);
        }
    });
}


var globalMeetCount = 0;
var allstrings = [];

function processTables(numLeads, numMeets){
	var meets = document.getElementById("table_1");

	var times = document.getElementById("table_2");

	var meeting_identification = [];
	var start_times = [];
	var end_times = [];

	for (var i = 1, row; row = times.rows[i]; i++) {
		//skips the header row (i starting at 1)
   		for (var j = 0, col; col = row.cells[j]; j++) {
   			var cellText = $(col).html();
   			if (j == 0) {
   				meeting_identification.push(cellText);
   			}
   			if (j == 1) {
   				start_times.push(cellText);
   			}
   			if (j == 2) {
   				end_times.push(cellText);
   			}
   			//console.log(cellText);
   			//use some kind of dictionary data structure

   		}  
	}
	/*console.log(meeting_identification);
	console.log(start_times);
	console.log(end_times);*/
	

	for (var i = 1, row; row = meets.rows[i]; i++) {
		var insertions = "INSERT INTO Meetings (Date, is_AM, Room_Number, Lead_1, Lead_2, Lead_3, Time_Start, Time_End, Venture_Name, Meeting_Number) VALUES ('" + $("#thedate").val() + "' , ' " + is_morn + "', ";

		//skips the header row (i starting at 1)
		var c = '0';
   		for (var j = 0, col; col = row.cells[j]; j++) {
   			var cellText = $(col).html();
   			//console.log(j);
   			//console.log(numLeads);
   			if (j == 0) {
   				insertions += "'" + cellText + "', ";
   				//room number
   			}
   			if ((j > 0) && (j <= numLeads)) {
   				insertions += "'" + cellText + "', ";
   			}
   			if (j == numLeads) {
   				for (var k = 0; k < (3-numLeads); k++) {
   					insertions += "NULL, ";
   				}
   			}
   			var final_insert = insertions;

   			if (j > numLeads) {
   				c++;
   				//console.log(c);
   				for (var p = 0; p < meeting_identification.length; p++) {
   					//console.log(meeting_identification[p] + " " + c);

   					if (meeting_identification[p] == c) {
   						var st = start_times[p];
   						var et = end_times[p];
   						final_insert += "'" + st + "', '" + et + "', ";
   						if (c > globalMeetCount) {
   							globalMeetCount = c;
   						}
   						break;
   					}
   					
   				}
   				final_insert += "'" + cellText + "', '" + c + "');";
				//console.log(final_insert);
				allstrings.push(final_insert);
				//allstrings is an array of strings that contains all (k, I guess not all since the breaks are not in there yet, will do and then remove this comment)the insertion commands that need to be performed by the php file
   			}
   			
   		}
	}
	//console.log(allstrings);

	for (var w = 0; w < meeting_identification.length; w++) {
			console.log(meeting_identification[w]);
			console.log(globalMeetCount);

		if (isNaN(meeting_identification[w])) {
			var inser = "INSERT INTO Meetings (Date, is_AM, Time_Start, Time_End, Description) VALUES ('" + $("#thedate").val() + "' , '"  + is_morn + "' , '" + start_times[w] + "', '" + end_times[w] + "', '" + meeting_identification[w] + "');"
			allstrings.push(inser);
			//basically if it is not really a "meeting" but still considered to be one of the things we have to add to the database (things like breakfast, or break)
		}
	}
	$("#finalImport").append("<button id='beginImport' onclick='finalsubmit()'>Import Just Meetings and Times (Not Track)</button>");
}
//function processTables ends here

function finalsubmit () {
	$("#finalImport").remove();
	console.log("inserting");
	for (var i = 0; i < allstrings.length; i++) {
		console.log(allstrings[i]);
	}
    $.ajax({
        type: 'post',
        url: 'processTables.php',
        async: false,
        data: {
            sqlInserts: allstrings
        },
        success: function( data ) {
            //console.log(data);
            alert("Complete");
        }
    });
};
