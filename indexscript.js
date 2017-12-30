var allstrings = [];
var har;
var queryDate;
var queryAM;

function determineTime(obj){
	//console.log("I am here right now");
	for (var i = 0; i < obj.length; i++) {
		var poi = obj[i];
		//console.log("poi is: " + poi);
		//console.log(poi["is_AM"]);
		queryDate = poi["Date"];
		queryAM = poi["is_AM"];//30 or 31

		//now that we know the date and am or pm we should query everything only pretaining to that date and only am or pm except when the actual name of the company appears in the name
	}
}

function temp(str, nameofven){
	//console.log("Here too");
	$.ajax({
        type: 'post',
        async: false,
        url: 'processQuery.php',
        data: {
            sqlQuery: str
        },
        success: function( data ) {
        	//console.log("Here is the data man:");
            //console.log(data);
            //console.log("transfering");
            if (data.length < 1) {//meaning this company does not have an individual meeting, but they could still have a track meeting
            	var strabc = "SELECT * FROM Meetings WHERE Venture_Name='" + nameofven + "';";
            	$.ajax({
            		type: 'post',
        			async: false,
        			url: 'processQuery.php',
        			data: {
            			sqlQuery: strabc
        			},
        			success: function( dat ) {
        				console.log("dat is here buddy!");
        				console.log(dat);
        				console.log("umm kk");
        				determineTime(dat);
        			}
            	});
            }
            determineTime(data);
            //console.log(allstrings);
            //alert("Complete");
        }
    });
}
var lookupProfile = [];

function makeLookup(){
lookupProfile["Chen Fong"]="https://www.creativedestructionlab.com/people/dr-t-chen-fong/";
lookupProfile["John Francis"]="https://www.creativedestructionlab.com/people/john-francis/";	
lookupProfile["Michael Hyatt"]="https://www.creativedestructionlab.com/people/michael-hyatt/";
lookupProfile["Tony Lacavera"]="https://www.creativedestructionlab.com/people/tony-lacavera/ ";
lookupProfile["Ted Livingston"]="https://www.creativedestructionlab.com/people/ted-livingston/";
lookupProfile["David Ossip"]="https://www.creativedestructionlab.com/people/david-ossip/";
lookupProfile["Michael Serbinis"]="https://www.creativedestructionlab.com/people/michael-serbinis/";
lookupProfile["Lisa Shields"]="https://www.creativedestructionlab.com/people/lisa-shields/";
lookupProfile["Barney Pell"]="https://www.creativedestructionlab.com/people/barney-pell/";
lookupProfile["Shivon Zilis"]="https://www.creativedestructionlab.com/people/shivon-zilis/";
lookupProfile["Dror Berman"]="https://www.creativedestructionlab.com/people/dror-berman/";
lookupProfile["Ken Nickerson"]="https://www.creativedestructionlab.com/people/ken-nickerson/";
lookupProfile["Manish Patel"]="https://www.creativedestructionlab.com/people/manish-patel/";
lookupProfile["Tomi Poutanen"]="https://www.creativedestructionlab.com/people/tomi-poutanen/";
lookupProfile["Geordie Rose"]="https://www.creativedestructionlab.com/people/geordie-rose/";
lookupProfile["William Tunstall-Pedoe"]="https://www.creativedestructionlab.com/people/william-tunstall-pedoe/";
lookupProfile["Lyon Wong"]="https://www.creativedestructionlab.com/people/lyon-wong/";
lookupProfile["Nick Adams"]="https://www.creativedestructionlab.com/people/nick-adams/";
lookupProfile["Umair Akeel"]="https://www.creativedestructionlab.com/people/umair-akeel/";
lookupProfile["Nick Beim"]="https://www.creativedestructionlab.com/people/nick-beim/";
lookupProfile["Dennis Bennie"]="https://www.creativedestructionlab.com/people/dennis-bennie/";
lookupProfile["Andy Burgess"]="https://www.creativedestructionlab.com/people/andy-burgess/";
lookupProfile["Nicolas Chapados"]="https://www.creativedestructionlab.com/people/nicolas-chapados/";
lookupProfile["Tyson Clark"]="https://www.creativedestructionlab.com/people/tyson-clark/";
lookupProfile["Zavain Dar"]="https://www.creativedestructionlab.com/people/zavain-dar/";
lookupProfile["Sally Daub"]="https://www.creativedestructionlab.com/people/sally-daub/";
lookupProfile["Dan Debow"]="https://www.creativedestructionlab.com/people/dan-debow/";
lookupProfile["Haig Farris"]="https://www.creativedestructionlab.com/people/haig-farris/";
lookupProfile["Richard Hyatt"]="https://www.creativedestructionlab.com/people/richard-hyatt/";
lookupProfile["Moe Kermani"]="https://www.creativedestructionlab.com/people/moe-kermani/";
lookupProfile["Johann Koss"]="https://www.creativedestructionlab.com/people/johann-koss/";
lookupProfile["Allen Lau"]="https://www.creativedestructionlab.com/people/allen-lau/";
lookupProfile["Lee Lau"]="https://www.creativedestructionlab.com/people/lee-lau/";
lookupProfile["Jevon MacDonald"]="https://www.creativedestructionlab.com/people/jevon-macdonald/";
lookupProfile["Sanjay Mittal"]="https://www.creativedestructionlab.com/people/sanjay-mittal/";
lookupProfile["Ash Munshi"]="https://www.creativedestructionlab.com/people/ash-munshi/";
lookupProfile["Lally Rementilla"]="https://www.creativedestructionlab.com/people/lally-rementilla/";
lookupProfile["Ashmeet Sidana"]="https://www.creativedestructionlab.com/people/ashmeet-sidana/";
lookupProfile["Micah Siegel"]="https://www.creativedestructionlab.com/people/micah-siegel/";
lookupProfile["Shahram Tafazoli"]="https://www.creativedestructionlab.com/people/shahram-tafazoli/";
lookupProfile["Don Tapscott"]="https://www.creativedestructionlab.com/people/don-tapscott/";
lookupProfile["Stephan Uhrenbacher"]="https://www.creativedestructionlab.com/people/stephan-uhrenbacher/";
lookupProfile["Adrian Weller"]="https://www.creativedestructionlab.com/people/adrian-weller/";
lookupProfile["Boris Wertz"]="https://www.creativedestructionlab.com/people/boris-wert/";
lookupProfile["Vincent Win"]="https://www.creativedestructionlab.com/people/vincent-win/";
lookupProfile["Shelley Zhuang"]="https://www.creativedestructionlab.com/people/shelley-zhuang/";
	
}


function startSearch(name){
	makeLookup();
	//var name = $("#venture option:selected").val();
	console.log(name);
	name = name.replace("&", "&amp;");
	har = name;
	//create the query
	//console.log(name);

	//First thing to determine is the date and AM or PM

	var deterdate = "SELECT * FROM Meetings WHERE Venture_Name='" + name + "' AND Meeting_Number IS NOT NULL;";

	temp(deterdate, name);



	//var query = "SELECT * FROM Meetings WHERE LOWER(Venture_Name)=LOWER('" + name + "');";
	var query = "SELECT * FROM Meetings WHERE Venture_Name='" + name +"' OR (Meeting_Number IS NULL AND is_AM='" + queryAM +  "' AND Date='"+ queryDate +"' ) ORDER BY Time_Start;" ;
	//this query doesn't query everything we actually need
	//we still need to query the track meetings and the general breaks/lunch etc...
	//console.log(query);
	//allstrings.push(query);
	
	theQuery(query);
	
}
function theQuery(query){
	//console.log(query);
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
	            //console.log(allstrings);
	            //alert("Complete");
	        }
	    });
}
var prev1, prev2;
var subtracting = false;

function helper(time){
	time = time.split(':'); // convert to array
	
	// fetch
	var hours = Number(time[0]);
	var minutes = Number(time[1]);
	//var seconds = Number(time[2]);
	if (subtracting) {
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
	}
	// calculate
	var timeValue = "" + ((hours >12) ? hours - 12 : hours);  // get hours
	timeValue += (minutes < 10) ? ":0" + minutes : ":" + minutes;  // get minutes
	//timeValue += (seconds < 10) ? ":0" + seconds : ":" + seconds;  // get seconds
	timeValue += (hours >= 12) ? " PM" : " AM";  // get AM/PM
	return timeValue;
}

var isGrey = [];

function process(obj){

	var distable = "<table class='mytable'><thead><tr><th style='min-width: 9.9em;'>Time</th><th>Venture</th><th>Discussion Leads</th></tr></thead><tbody>";
	var prev1 = "";
	var prev2 = "";

	var idk = true;
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

		var a = helper(arr["Time_Start"]);
		var b = helper(arr["Time_End"]);

		if (i==0 || idk) {
			idk = false;
			var tempa = arr["Time_Start"];
			subtracting =true;
			tempa = helper(tempa);
			subtracting = false;

			distable += "<td style='background-color: #ececec; text-align:center;'>" + tempa + " - " + a +"</td><td style='background-color: #ececec;' colspan='2'>Check In at CDL Office <b>(Room 2052)</b></td></tr>" + "<tr>";

		}

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
			console.log("look: '" + arr["Lead_1"] + "'  " + lookupProfile[arr["Lead_1"]])
			if (lookupProfile[arr["Lead_1"]]) {
				//console.log()
				distable += "<td colspan='2'>Individual Meeting with <a target='_blank' href='"+ lookupProfile[arr["Lead_1"]] +"'>" + arr["Lead_1"] + "</a> ";
			}
			else distable += "<td colspan='2'>Individual Meeting with " + arr["Lead_1"];

			for (var l = 2;l<4; l++) {
				var tt = "Lead_" + l;
				if (arr[tt]) {
					if (lookupProfile[arr[tt]]) {
						distable += " and <a target='_blank' href='"+ lookupProfile[arr[tt]] +"'>" + arr[tt] + "</a> ";
					}
					else distable += " and "  + arr[tt];
				}
				else break;

			}

			distable += " in <b>Room " + arr["Room_Number"] + "</b></td>";
		}
		else if (arr["Description"]) {
			if (arr['is_Custom']) {
				//console.log("isCustom");
				//console.log(har + " + " + arr['Venture_Name']);
				var ty = har;
				if (har == "A&amp;K Robotics") {ty = "A&K Robotics"}
				if (arr['Venture_Name']==ty) {
					if (arr['Room_Number']) {
						distable += "<td colspan='2'>" + arr["Description"] + " <b>(Room "+ arr['Room_Number'] +")</b>" + "</td>";
					}
					else distable += "<td colspan='2'>" + arr["Description"] + "</td>";
					//console.log("Yay");
				}
			}
			else {
				//this is a general activity to all
				distable += "<td colspan='2'>" + arr["Description"] + "</td>";
				isGrey.push(i);
			}
		}
		else if(arr["Venture_Name"] && arr["Lead_1"]) {
			//this is a track meeting
			if (arr["Venture_Name"] == har) {
				if (lookupProfile[arr["Lead_1"]]) {
					distable += "<td><b>" + arr["Venture_Name"] + "</b></td><td><b><a target='_blank' href='"+ lookupProfile[arr["Lead_1"]] +"'>" + arr["Lead_1"] + "</a></b></td>";
				}
				else distable += "<td><b>" + arr["Venture_Name"] + "</b></td><td><b>" + arr["Lead_1"] + "</b></td>";
			}
			else if (lookupProfile[arr["Lead_1"]]) {
				distable += "<td>" + arr["Venture_Name"] + "</td><td><a target='_blank' href='"+ lookupProfile[arr["Lead_1"]] +"'>" + arr["Lead_1"] + "</a></td>";
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

	$("#scheduleTable").append("<h3><b><u>" + har + "</u><i> - " + queryDate +"</i></b></h3>");
	$("#scheduleTable").append(distable);
	for (var j = 0; j < isGrey.length; j++) {
		var theid = ".row_" + isGrey[j];

		$(theid).css("background-color", "#ececec");
	}

	if (queryDate == "2017-06-08") {
		console.log("hia");
    //var strer = "<br><table class='mytable'><tbody><tr><td style='width: 11.2em; min-width: 9.2em; text-align: center;'>4:30 PM</td><td>Graduation Party</td><td>Desautels Hall</td></tr></tbody></table>";
    //$("#scheduleTable").append("<br><table style='border-width: 2px; border-color: black;' class='mytable'><tbody><tr><td style='width: 11.2em; min-width: 9.2em; text-align: center;'>4:30 PM</td><td>Graduation Party</td><td>Desautels Hall</td></tr></tbody></table>");
  }
  else {
  	//$("#scheduleTable").append("<br><table style='border-width: 2px; border-color: black;' class='mytable'><tbody><tr><td style='width: 11.2em; min-width: 9.2em; text-align: center;'>4:30 PM</td><td>Graduation Party (June 8)</td><td>Desautels Hall</td></tr></tbody></table>");
  }

	$("#scheduleTable").append("<br><h4><b><u>REMINDER: </b></u> Please arrive at each of your meeting locations 10 minute early.</h4>");// All afternoon sessions are in 1065.

	var ut, pw;

	if (har[0] <= 'B') {
		ut = "qq204033";
		pw = "Ieh5eizich";
	}
	else if (har[0] == 'C' || (har[0] == 'D' && har[0] == 'a')) {
		ut = "qq204034";
		pw = "ootheS5gei"
	}
	else if (har[0] < 'F') {
		ut = "qq195147";
		pw = "aegh7Eeyei";
	}
	else if (har[0] <= 'G') {
		ut = "qq204035";
		pw = "eeru4veeRo";
	}
	else if (har[0] <= 'K') {
		ut = "qq204036";
		pw = "Ahmi3gohsh";
	}
	else if (har[0] <= 'N') {
		ut = "qq204037";
		pw = "aequae5Sho";
	}
	else if (har[0] <= 'R') {
		ut = "qq204038";
		pw = "iaY9aeshup";
	}	
	else if (har[0] <= 'T') {
		ut = "qq204039";
		pw = "sute4ziaSa";
	}
	else {
		ut = "qq204040";
		pw = "Penee6oemom";
	}
	$("#scheduleTable").append("<h4>Network: <b>UofT</b> | Username: <b>"+ ut + "</b> | Password: <b>" + pw + "</b></h4>");
	$("#scheduleTable").append("<h4><a target='_blank' href='https://goo.gl/maps/8uSykS526Q22'>105 St George St, Toronto, ON M5S 2E8</a></h4><br>");
	$("#venture").remove();
	$("#subven").remove();
}