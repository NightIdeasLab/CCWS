<?php
session_start();
  
$var_uuid = $_SESSION['uuid'];

$var_age = $_SESSION['age'];

$var_nationality = $_SESSION['nationality'];

// Chooses a random page
$var_native = $_SESSION['native_eng'];

$var_pagesArray = $_SESSION['pagesArray'];

if (!isset($_SESSION['loaded5']))
{	
	$pagesArray = array_values($var_pagesArray);
	if (!$pagesArray)
	{
		$next_page = 'step_two.php';
		$var_pageStep = $_SESSION['pageStep'] + 1;		
		$_SESSION['pageStep'] = $var_pageStep;
	}
	else
	{
		$randNum = rand(0, count($pagesArray)-1);
		$next_page = $pagesArray[$randNum];
		$_SESSION['page']= $pagesArray[$randNum];
		unset($pagesArray[$randNum]);
		$_SESSION['pagesArray'] = $pagesArray;
		
		$var_pageStep = $_SESSION['pageStep'] + 1;		
		$_SESSION['pageStep'] = $var_pageStep;
	}
}
else
{
	// The page was refreshed
	echo "<script language='javascript'>alert('You refreshed the page. Please do not do it again, because data can be lost!!!');</script>";
	$var_pageStep = $_SESSION['pageStep'];
	$next_page = $_SESSION['page'];
}

$_SESSION['loaded5'] = true;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>First Experiment - S4R Experiment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- The styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
      .soundBite input {
        margin-right: 4px;
      }
    </style>

    <script type="text/javascript" src="js/swfobject.js"></script>
    <script type="text/javascript" src="js/recorder.js"></script>
    <script src="jquery/js/jquery-1.7.2.js"></script>

    <!-- The recorder settings -->
    <script>
	function setup()
	{ 
		Wami.setup("wami");
		window.location.href += "#";
		setTimeout("changeHashAgain()", "50");
	}
	
	function changeHashAgain()
	{
		window.location.href += "1";
	}

	var storedHash = window.location.hash;
	window.setInterval(function ()
	{
    	if (window.location.hash != storedHash)
    	{
        	window.location.hash = storedHash;
        }
     }, 50);

	// initialize some global vars
    var recording = '';
    var recordingUrl = '';
    var playBackUrl = '';
    var age = <? echo $var_age; ?>;  
    var nationality = <? echo '"'.$var_nationality.'"'; ?>;
    var nativeEng = <? echo '"'.$var_native.'"'; ?>;
    var uuid = <? echo '"'.$var_uuid.'"'; ?>;

	function record()
	{
		status("Recording...");
		recording = age + '_' + nationality + '_' + nativeEng + '_' + uuid + '_' + 'step1_audio5.wav';
        recordingUrl = 'http://localhost/web_site/audio/save_file.php?filename=' + recording;
		Wami.startRecording(recordingUrl);
	}

	function stop()
	{
		status("Stop");
		Wami.stopRecording();
		playBackUrl = 'http://localhost/web_site/audio/' + recording;
		Wami.stopPlaying();
	}

	function play()
	{
		status("Playing...");
		document.getElementById('submit').disabled = false;
		Wami.startPlaying(playBackUrl);		
	}

	function status(msg) {
		document.getElementById('status').innerHTML = msg;
	}
	
	// Adding the sentence in the DB -->
	$(function()
	{
		$('#submit').click(function()
		{

			var uuidj = '';
			uuidj = <? echo '"'.$var_uuid.'"'; ?>;
			var taskID = '';
			taskID = '5';
			var sentenceID = <? echo $var_pageStep ?>;
			var step = '1-' + <? echo $var_pageStep ?>;
			var sentence = $('#sentence').val();
			var recordingFile = recording;
				
			if (sentence == '')
			{
				$('#errorEmptySentence').modal('show')
			 	return false;
			}
			else
			{	
				$.ajax(
				{
					url: 'function/submit_to_db.php',
					type: 'POST',
					data: 'uuidj=' + uuidj + '&taskID=' + taskID + '&sentenceID=' + sentenceID + '&sentence=' + sentence + '&recordingFile=' + recordingFile + '&step=' + step,

					success: function(result)
					{
						document.getElementById('status').innerHTML = result;
						if (result == 'Sentence added successfully!')
						{
							document.getElementById('stepTwoBtn').disabled = false;
							$('#sentence').val('');
							$('#arrow').fadeOut(500);
						}
					}
				});
			}
				return false;
		});
	 });
	 
	</script>

	<script>
	function step_two()
     {
	 	var nextPage = <? echo '"'.$next_page.'"'; ?>;
	 	window.open(nextPage,"_self")
	 }
	 
	 var random_images_array = ["bathroom.png", "bedroom.png", "dining_room.png", "kitchen.png", "living_room.png"];

	function getRandomImage(imgAr, path)
	{
    	path = path || 'img/experiment/'; // default path here
    	var num = Math.floor( Math.random() * imgAr.length );
    	var img = imgAr[ num ];
    	var imgStr = '<img src="' + path + img + '" alt = "">';
    	document.write(imgStr); document.close();
    }
    
	</script>

    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- fav and touch icons -->
    <link rel="shortcut icon" href="bootstrap/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="bootstrap/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="bootstrap/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="bootstrap/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="bootstrap/ico/apple-touch-icon-57-precomposed.png">
  </head>

<!--  <body onload="setup()"> -->
<body onload="setup()">
    
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand">Speaky For Robots Experiment</a>
        </div>
      </div>
    </div>

	<!-- If JavaScript is disabled will dispaly a banner -->    
    <noscript>
        <div id="noscript-warning">This web site needs javascript activated to work properly. Please activate it. Thanks!</div>
    </noscript>

    <div class="recorder container">
	    <p style="font-size: 20pt">Experiment 1-<?php echo ($var_pageStep);?></p>
	    <p style="font-size: 15pt">Description task</p>
	    
	    <center><script type="text/javascript">getRandomImage(random_images_array)</script></center>

		<div id="wami"></div>

		<br>

	    <p style="font-size: 20pt">Describe to the robot the scene displayed in the picture.</p>
        <p style="font-size: 20pt">You can either specify the position of an object (e.g. "there is a fridge on the right of the oven")</p>
        <p style="font-size: 20pt">or give a general description of the enviroment (e.g. "this is a kitchen with a wooden floor").</p>
	    <p style="font-size: 20pt">In the first case feel free to choose a typical object for this location.</p>
	    		
		<br />
			    
	    <p>Please give Abode Flash control over the microphone also before you enable microphone input either plug in headphones or turn the volume down if you want to avoid ear splitting feedback, especially while playing back already recorded sounds</p>

		<span class="label label-important" style="font-size: 13.5pt">Please check whether your command has been correctly recorded before saving the file! Thank you.</span>

	    <br />
        <hr />

		<center>
		
			<!-- Fourth recording -->

			<p>
				<form method="post" action="function/submit_to_db.php" class="form-inline">
					<div id="container2">
						<input type="button" class="btn btn-primary" value="Record" onclick="record()"></input>
						<input type="button" class="btn btn-warning" value="Stop" onclick="stop()"></input>
						<input type="button" class="btn btn-success" value="Play" onclick="play()"></input>
						<input type="text2" name="sentence" id="sentence" class="input-xxlarge" placeholder="First, record your command, then write it down here..."></input>
						<button name="submit" id="submit" class="btn btn-inverse" disabled >Save</button>
						<img height=25px src="img/arrow.gif" id="arrow" class="img-polaroid">
					</div>
				</form>
			</p>

		</center>

		<form class="form-inline">
			<label class="control-label" >Status : </label> <span class="label label-important" id="status"></span>
		</form>

		<hr />

		<center>
			<button onclick="step_two()" id="stepTwoBtn" class="btn btn-primary" disabled >Next Step</button>
		</center>

    </div>

    <hr>

     <!-- Error Agreement Modal -->    
     <center>
        <div id="errorEmptySentence" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	        <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		        <h3 id="myModalLabel">ERROR EMPTY SENTENCE</h3>
		    </div>
		    <div class="modal-body">
			    <p>You need to enter a task in order to go to the next step!</p>
		    </div>
		   <div class="modal-footer">
			  <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
	      </div>
	   </div>
     </center>


    <div class="footer">
	    <div class="container">
		    <p> &copy; S4R Data Collector has been designed and developed by <a href="http://labrococo.dis.uniroma1.it/wiki/doku.php" target="_blank">RoCoCo Lab </a> at <a href="http://www.uniroma1.it/" target="_blank">Sapienza University of Rome</a></p>
		</div>
	</div>

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/js/bootstrap-transition.js"></script>
    <script src="bootstrap/js/bootstrap-alert.js"></script>
    <script src="bootstrap/js/bootstrap-modal.js"></script>
    <script src="bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="bootstrap/js/bootstrap-tab.js"></script>
    <script src="bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="bootstrap/js/bootstrap-popover.js"></script>
    <script src="bootstrap/js/bootstrap-button.js"></script>
    <script src="bootstrap/js/bootstrap-collapse.js"></script>
    <script src="bootstrap/js/bootstrap-carousel.js"></script>
    <script src="bootstrap/js/bootstrap-typeahead.js"></script>

  </body>
</html>
