<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Select Venture</title>
        <meta name="description" content="Custom Drop-Down List Styling with CSS3" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css' />
		<script type="text/javascript" src="js/modernizr.custom.79639.js"></script> 
		<noscript><link rel="stylesheet" type="text/css" href="css/noJS.css" /></noscript>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="		sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="		sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="shortcut icon" type="image/png" href="/dots.png"/>
		<link rel="stylesheet" type="text/css" href="indexstyle.css">
		<script src="indexscript.js"></script>
    </head>
<body>
<?php

	$venName = $_GET["venname"];
	if (is_null($venName)):

?>
   
        <div class="container">
		
			<section class="main">
				<div class="wrapper-demo">
					<div id="dd" class="wrapper-dropdown-5" tabindex="1">Venture
						<ul class="dropdown">
						</ul>
					</div>
				​</div>
			</section>
			
		</div>

<script type="text/javascript">
$(document).ready()
   	$.ajax({
     		type: "POST",
     		url: "processQuery.php",
     		async: false,
     		data: {
            sqlQuery: "returnVentures"
        },
     	success: function(result){
     		var curstr = "";
      		for (var i = 0; i < result.length; i++) {
				var arr = result[i];
				curstr += "<li value='" + arr + "'><a href='?venname="+ arr +"'>" + arr + "</a></li>" ;
			}
			$(".dropdown").append(curstr);
		}
   	});

	function DropDown(el) {
		this.dd = el;
		this.initEvents();
	}
	DropDown.prototype = {
		initEvents : function() {
			var obj = this;
			obj.dd.on('click', function(event){
				$(this).toggleClass('active');
				event.stopPropagation();
			});	
		}
	}
	$(function() {
		var dd = new DropDown( $('#dd') );
		$(document).click(function() {
			// all dropdowns
			$('.wrapper-dropdown-5').removeClass('active');
		});
	});

</script>

<?php
else:
?>
<div id="scheduleTable"></div>
<script>
var nml = "<?php echo $venName; ?>";
	startSearch(nml);
</script>

<?php
endif;
?>
</body>
</html>




	