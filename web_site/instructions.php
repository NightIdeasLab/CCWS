<?php
session_start();

$var_uuid = $_SESSION['uuid'];

$var_age = $_SESSION['age'];

$var_nationality = $_SESSION['nationality'];

$var_native = $_SESSION['native_eng'];

// Chooses a random page
$pagesArray = array("step_one_1.php", "step_one_2.php", "step_one_3.php", "step_one_4.php", "step_one_5.php");
$randNum = rand(0, count($pagesArray)-1);

$nextPage = $pagesArray[$randNum];

unset($pagesArray[$randNum]);

$_SESSION['pagesArray'] = $pagesArray;

$_SESSION['pageStep'] = 0;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Instructions - S4R Experiment</title>
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
		window.location.href += "6";
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
		recording = age + '_' + nationality + '_' + nativeEng + '_' + uuid + '_' + 'temp.wav';
        recordingUrl = 'http://localhost/web_site/audio/temp/save_file.php?filename=' + recording;
        
		Wami.startRecording(recordingUrl);
	}

	function stop()
	{
		status("Stop");
		Wami.stopRecording();
		playBackUrl = 'http://localhost/web_site/audio/temp/' + recording;
		Wami.stopPlaying();
	}

	function play()
	{
		status("Playing...");
		Wami.startPlaying(playBackUrl);	
		document.getElementById('Save').disabled = false;	
	}

	function status(msg) {
		document.getElementById('status').innerHTML = msg;
	}  
        
	function save()
	{
		var sentence = $('#sentence').val();
		
		if (sentence == '')
		{
			$('#errorEmptySentence').modal('show')
		 	return false;
		}
		else
		{
			document.getElementById('stepOneBtn').disabled = false;
			status("This is just a test");
			$('#sentence').val('');
			$('#arrow').fadeOut(500);	
		}
	}
	   
     function openStepOne()
     {
  	   var nextPage = <? echo '"'.$nextPage.'"'; ?>;
  	   window.open(nextPage,"_self")
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
	    <p style="font-size: 16pt">Let's start with an example!</p>
	    <b>Description</b>
	    <ul>
		    <li>The system will randomly select for you a high level task.</li>
		    <li>For any goal, the system will also randomly select all the elements required for the task, and present them to you through images and texts</li> 
		    <li>You are <b>completely free</b> to provide the command that you prefer for that task.</li>
		</ul>
		
		<b>Hints</b>
		<ul>
			<li>Try to pronounce the command as you would normally ask your friend. Be comfortable!</li>
			<li>Add as many options as you desire to your commands. Providing different details about the task to accomplish is typical when interacting with someone.</li>
<div id="wami"></div>
	        </ul>	
		<b>Now let's try with an example</b>
		<ul>
			<li><emph>System (Presenting a descriptive text and image):-</emph> your selected task is: "check the status of the kitchen's door"</li>
			<li><emph>You (Recording your utterance):-</emph> "is the door open?"</li>
		</ul>
		
		<p>Simply enable recording and pronounce your command, then write it down!</p>
		
		<p>Please give Abode Flash control over the microphone also before you enable microphone input either plug in headphones or turn the volume down if you want to avoid ear splitting feedback, especially while playing back already recorded sounds.</p>
		
		<p><b>How to record your utterances?</b></p>
		<ul>
			<li><b>1) Press 'Record' and speech your chosen command</b></li>
			<li><b>2) When you are finished speaking your command press 'Stop' and wait for 2-3 seconds until the recording is processed</b></li>
			<li><b>3) Then press 'Play' to see if the command was recorded, if for some reason you do not hear your utterance please press 'Play' again, if not restart from step 1</b></li>
			<li><b>4) Write down the chosen command and then press 'Save' to save both the recorded and the written command.</b></li>
		</ul>
				
		<br />
   		
		<span class="label label-important" style="font-size: 13.5pt">Please check whether your command has been correctly recorded before saving the file! Thank you.</span>
		
		<br /> <br />

		<center>
			<!-- First recording -->
			<p>
				<form method="post" action="function/submit_to_db.php" class="form-inline">
					<div id="container2">
						<input type="button" class="btn btn-primary" value="Record" onclick="record()"></input>
						<input type="button" class="btn btn-warning" value="Stop" onclick="stop()"></input>
						<input type="button" class="btn btn-success" value="Play" onclick="play()"></input>
						<input type="text2" name="sentence" id="sentence" class="input-xxlarge" placeholder="First, record your command, then write it down here..."></input>
						<input type="button" id="Save" class="btn btn-inverse" value="Save" onclick="save()" disabled ></input>
						<img height=25px src="img/arrow.gif" id="arrow" class="img-polaroid">
					</div>
				</form>
			</p>

		</center>

		<form class="form-inline">
			<label class="control-label" >Status : </label> <span class="label label-important" id="status"></span>
		</form>


		<p><b>IMPORTANT</b></p>
		<ul>
			<li><b>1) DO NOT press 'Save' more then once.</b></li>
			<li><b>2) DO NOT refresh any page, because the data is displayed randomly.</b></li>
			<li><b>3) DO NOT try to go back to a page, because data can be lost or corrupted.</b></li>
			<li><b>4) Thanks for your time.</b></li>
		</ul>
		
		<br />
	
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

		<center>
			<button onclick="openStepOne()" id="stepOneBtn" class="btn btn-primary" disabled >OK, I got it, now let's start!!!</button>
		</center>	    

    </div>
    
    <br/>
    <br/>

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