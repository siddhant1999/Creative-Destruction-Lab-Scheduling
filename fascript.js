
    var removing = [];
    var dateonpage;
function executeQuery(query){
  $("#header").append("<div id='titleHead' class='col-sm-4' ><h3><b>G7/ML7 Meeting<i> - "+ date + "</i><br>" + har + "</b></h3>");
dateonpage = date;
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

                //$("#scheduleTable").append("<a href='"+ arr['Date'] +"''>"+ arr['Date'] +"</a><br>");
                if (arr['Date'] != date && (arr['Lead_1'] == har || arr['Lead_2'] == har || arr['Lead_3'] == har))
                  mySet.add(arr['Date']);
                }
          for (let item of mySet){

            str = '?faname=' + har+ '&date=' + item;
            //console.log("item: " + str);
            $("#titleHead").append('<h4 class="printRemove"><a href="'+ str +'">View: <u>'+ item +'</a></u></h4>');
          } 
        
          

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

  var distable = "<table class='mytable'><thead><tr><th style='width: 11.2em; min-width: 9.2em;'>&nbspTime</th><th>&nbspVenture</th><th>&nbspRoom</th></tr></thead><tbody>";
  var prev1 = "";
  var prev2 = "";
  var leadfor = "";
  var isFirstLedVenture = 0;
  var idk = true;

  for (var i = 0; i < obj.length; i++) {
    var arr = obj[i];
    //console.log("i : " + i);
    distable += "<tr class='row_" + i + "'>";
    if (arr['is_Custom']) {
      var ty = har;
      if (arr['Lead_1']!=ty) {
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
      if (!arr["Venture_Name"]) {
        var stre = ".row_" + i; 
        //console.log(stre);
        removing.push(i);
        console.log(removing);
        console.log(removing.length);
        //$(stre).remove();

      }
      //meaning this is a specific individual meeting
      //we also want to include the other Leads they are also with
      var withLeads;

      var strLeads = "";

      var arrayLeads = []; // this is going to store the leads that this person (lead) is sharing the room with in the meeting

      if (arr['Lead_1'] && arr['Lead_1'] != har) {
        strLeads += arr['Lead_1'] + " ";
        arrayLeads.push(arr['Lead_1']);
      }
      if (arr['Lead_2'] && arr['Lead_2'] != har) {
        strLeads += arr['Lead_2'] + " ";
        arrayLeads.push(arr['Lead_2']);
      }
      if (arr['Lead_3'] && arr['Lead_3'] != har) {
        strLeads += arr['Lead_3'] + " ";
        arrayLeads.push(arr['Lead_3']);
      }
      if (arrayLeads.length > 0) {
        if (arrayLeads.length > 1) {
          distable += "<td>" + arr["Venture_Name"] + " (with "+ arrayLeads[0] + " & " + arrayLeads[1] +")" + "</td><td>Room <b>" + arr['Room_Number'] + "</b></td>";
        }
          else distable += "<td>" + arr["Venture_Name"] + " (with "+ arrayLeads[0] +")" + "</td><td>Room <b>" + arr['Room_Number'] + "</b></td>";
      }
      //check to make sure that strLeads is not empty
      else distable += "<td>" + arr["Venture_Name"] + "</td><td>Room <b>" + arr['Room_Number'] + "</b></td>";
      

      //distable += " <b>(Room " + arr["Room_Number"] + ")</b></td>";
    }
    else if (arr["Description"]) {
      
      if (arr['is_Custom']) {
        //console.log("isCustom");
        //console.log(har + " + " + arr['Venture_Name']);
        var ty = har;
        if (har == "A&amp;K Robotics") {ty = "A&K Robotics"}

        if (arr['Lead_1']==ty) {
          if (arr['Room_Number']) {
            distable += "<td class='greyback'>" + arr["Description"] + "</td><td class='greyback'>Room <b>" + arr['Room_Number'] + "</b></td>";
            isGrey.push(i);
          }
          else {
            distable += "<td colspan='2' class='greyback'>" + arr["Description"] + "</td>";
            isGrey.push(i);
          }
          //console.log("Yay");
        }
      }
      else {
        if (arr['Room_Number']) {
          distable += "<td>" + arr["Description"] + "</td><td>Room <b>" + arr['Room_Number'] + "</b></td>";
        }
        else {
          distable += "<td colspan='2'>" + arr["Description"] + "</td>";
        }
        isGrey.push(i);
      }
    }
    else if(arr["Venture_Name"] && arr["Lead_1"]) {
      
      //this is a track meeting
      
      if (arr["Lead_1"].toLowerCase() == har.toLowerCase()) {
        console.log(isFirstLedVenture);
        if (isFirstLedVenture == 1) {
          leadfor += "</i> | <i>";
        }
        distable += "<td colspan='2'><b>" + arr["Venture_Name"] + "</b></td>";
        leadfor += arr['Venture_Name'];
        isFirstLedVenture = 1;
      }

      else distable += "<td colspan='2'>" + arr["Venture_Name"] + "</td>";
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

  if (leadfor.length > 1) {
    leadfortitle = "<h4><b>Lead for: <i>" + leadfor + "</i></b></h4>";
    $("#titleHead").append(leadfortitle + "</div>");
  }

  $("#scheduleTable").append(distable);
  console.log("Over here");
  console.log(removing.length);

  for (var llii = 0; llii < removing.length; llii++) {
    console.log("Over here");
    var stre = ".row_" + removing[llii]; 
        console.log(stre);
        //removing.push(i);
        $(stre).remove();
        console.log("removed");
  }
  
  
  for (var j = 0; j < isGrey.length; j++) {
    var theid = ".row_" + isGrey[j];

    $(theid).addClass("greyback");
    //$(theid).css("background-color", "#ececec");
    //$(theid).css("background-color", "#ececec !important", "print");
    //$(theid).append('<style type="text/css" media="print">background-color: #ececec !important</style>');
  }

  $("#scheduleTable").append("<br><h4 class='printRemove'><b><u>REMINDER: </b></u> Please arrive at each of your meeting locations 10 minute early. All afternoon sessions are in 1065.</h4>");

  
  $("#scheduleTable").append("<h4 class='printRemove'><a href='https://goo.gl/maps/8uSykS526Q22'>105 St George St, Toronto, ON M5S 2E8</a></h4><br>");
  $("#venture").remove();
  $("#subven").remove();
}
function startSearch(){
  var name = $("#fa option:selected").val();
  //alert(name);
  str = "http://cdlschedules.com/fa.php?faname=" + name + "&date=2017-10-24"; // <-- this is temporary, in the future I want to be able to query the current date and then make the schedule query based on that

  window.location.assign(str);
  //this is redirecting to the next page in the case where the selection page is presented

  //var query = "SELECT * FROM Meetings WHERE LOWER(Lead_1)='" + name +"' OR (Meeting_Number IS NULL AND is_AM='" + queryAM +  "' AND Date='"+ queryDate +"' ) ORDER BY Time_Start;" ;
}