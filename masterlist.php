<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  </head>
<body>
<button class="buttons" onclick="">View</button><button class="buttons" onclick="upload()">Upload</button>

<div id="uploadspace"></div>
<div id="uploadstart"></div>
<div id="tableview"></div>

</body>
</html>

<script type="text/javascript">

function upload(){
	var str = "<div>Email Address</div><textarea id='email'></textarea><div>Location</div><select id='location'><option>Ontario</option><option>British Columbia</option><option>Quebec</option><option>Nova Scotia</option><option>Alberta</option></select><button onclick='allowUpload()'>Submit</button>";
	
	$('#uploadspace').append(str);
	$('.buttons').remove();
}
var ema, loc;
function allowUpload(){
	ema = $("#email").val()
	loc = $("#location option:selected").val()
	$('#uploadspace').remove();
	var str = "<textarea id='inserted'></textarea><button onclick='beginUpload()'>Import</button>";
	$('#uploadstart').append(str);
}
var insertArray = [];
function beginUpload(){
	var lines = $('#inserted').val().split('\n');
	//console.log(lines);
var inserted_table = "<table id='table_1' class='mytable'>";
	for(var i = 0;i < lines.length;i++){
		var vals = lines[i].split(/[\t]/);
		
		inserted_table= inserted_table.concat("<tr class='row-"+ i +"'>");
		
		var miniArray = [];
		for (var j = 0; j < vals.length; j++) {
			/*if(i==0){
				inserted_table = inserted_table.concat("<th class='col-"+ j +"'>" + vals[j] + "</th>");
			}*/
			miniArray.push(vals[j]);
				inserted_table = inserted_table.concat("<td class='col-"+ j +"'>" + vals[j] + "</td>");
			

		}
		miniArray.push(ema);
		miniArray.push(loc);
		insertArray.push(miniArray);
		
		inserted_table = inserted_table.concat("</tr>");

		/*if (i == 0) {
			inserted_table = inserted_table.concat("</thead></tbody>");
		}*/

		lines[i] = vals;
	}

	inserted_table += "</tbody></table><button onclick='finalUpload()'>Looks Good</button>";
	//console.log(inserted_table);
	//console.log(insertArray);
	//lets do the query building here

	$('#uploadstart').remove();
	$('#tableview').append(inserted_table);
}
function finalUpload(){
	for (var i = 0; i < insertArray.length; i++) {
		for (var j = 0; j < insertArray[i].length; j++) {
			
		}
	}
	$.ajax({
        type: "POST",
        url: "mastergather.php",
        data: {
        	sql: insertArray
        },
        success: function(data) {
        	console.log(data);
        }
    });
}
</script>