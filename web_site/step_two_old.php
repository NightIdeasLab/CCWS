<?php error_reporting(E_ALL);
session_start();

include_once('function/configDB.php');

// Connect to the DB
$con=mysqli_connect($host,$user,$pass,$database);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error($con);
  }
$var_uuid = $_SESSION['uuid'];

$var_age = $_SESSION['age'];

$var_nationality = $_SESSION['nationality'];

$var_native = $_SESSION['native_eng'];

// Retriving our own sentences
$sql="SELECT id,sentence FROM GrammarSentences order by RAND() LIMIT 1,2";
$result_grammar=mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result_grammar, MYSQLI_ASSOC)) 
{
$grammarSentencesID[] = $row['id'];			       
$grammarSentences[] = $row['sentence'];			       
}

mysqli_free_result($result_grammar);

// Retriving the sentences introduced by the user
$sql1="SELECT id,sentence FROM TaskUserSentences order by RAND() LIMIT 1,2";
$result_task=mysqli_query($con,$sql1);
while($row = mysqli_fetch_array($result_task, MYSQLI_ASSOC)) 
{
$taskSentencesID[] = $row['id'];
$taskSentences[] = $row['sentence'];
}
mysqli_free_result($result_task);

// Closing the connection with the DB
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Second Experiment - S4R Experiment</title>
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
	function setup() {
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
    var recording1 = '';
    var recordingUrl1 = '';
    var playBackUrl1 = '';
    var recording2 = '';
    var recordingUrl2 = '';
    var playBackUrl2 = '';
    var recording3 = '';
    var recordingUrl3 = '';
    var playBackUrl3 = '';
    var recording4 = '';
    var recordingUrl4 = '';
    var playBackUrl4 = '';
    var grammarSentences1 = <? echo '"'.$grammarSentencesID[0].'"'; ?>; 
    var grammarSentences2 = <? echo '"'.$grammarSentencesID[1].'"'; ?>; 
    var taskSentences1 = <? echo '"'.$taskSentencesID[0].'"'; ?>; 
    var taskSentences2 = <? echo '"'.$taskSentencesID[1].'"'; ?>; 
    var age = <? echo $var_age; ?>;  
    var nationality = <? echo '"'.$var_nationality.'"'; ?>;
    var nativeEng = <? echo '"'.$var_native.'"'; ?>;
    var uuid = <? echo '"'.$var_uuid.'"'; ?>;
      
    // first recording 
	function record1() {
		status("Recording...");
		recording1 = age + '_' + nationality + '_' + nativeEng + '_' + uuid + '_' + grammarSentences1 + '_' + 'g' + '_' + 'step2_audio1.wav';
        recordingUrl1 = 'http://www.dis.uniroma1.it/~s4r/audio/save_file.php?filename=' + recording1;
        console.log('recording urdl: ' + recordingUrl1);
        console.log('recording: ' + recording1);
		Wami.startRecording(recordingUrl1);
	}

	function stop1() {
		status("Stop");
		Wami.stopRecording();
		playBackUrl1 = 'http://www.dis.uniroma1.it/~s4r/audio/' + recording1;
		console.log('playbacks urdl: ' + playBackUrl1);
		<?php $link = "<script>document.write(recording)</script>"?>   
		Wami.stopPlaying();
	}

	function play1() {
		status("Playing...");
		console.log('playback url' + playBackUrl1);
		Wami.startPlaying(playBackUrl1);		
	}
	//end of first recording
	
	// second recording 
	function record2() {
		status("Recording...");
		recording2 = age + '_' + nationality + '_' + nativeEng + '_' + uuid + '_' + grammarSentences2 + '_' + 'g' + '_' + 'step2_audio2.wav';
        recordingUrl2 = 'http://www.dis.uniroma1.it/~s4r/audio/save_file.php?filename=' + recording2;
        console.log('recording urdl: ' + recordingUrl2);
        console.log('recording: ' + recording2);
		Wami.startRecording(recordingUrl2);
	}

	function stop2() {
		status("Stop");
		Wami.stopRecording();
		playBackUrl2 = 'http://www.dis.uniroma1.it/~s4r/audio/' + recording2;
		console.log('playbacks urdl: ' + playBackUrl2);
		<?php $link = "<script>document.write(recording)</script>"?>   
		Wami.stopPlaying();
	}

	function play2() {
		status("Playing...");
		console.log('playback url' + playBackUrl2);
		Wami.startPlaying(playBackUrl2);		
	}
	//end of second recording
		
	// third recording 
	function record3() {
		status("Recording...");
		recording3 = age + '_' + nationality + '_' + nativeEng + '_' + uuid + '_' + taskSentences1 + '_' + 't' + '_' + 'step2_audio3.wav';
        recordingUrl3 = 'http://www.dis.uniroma1.it/~s4r/audio/save_file.php?filename=' + recording3;
        console.log(recordingUrl3);
		Wami.startRecording(recordingUrl3);
	}

	function stop3() {
		status("Stop");
		Wami.stopRecording();
		playBackUrl3 = 'http://www.dis.uniroma1.it/~s4r/audio/' + recording3;
		console.log(playBackUrl3);
		<?php $link = "<script>document.write(recording)</script>"?>   
		Wami.stopPlaying();
	}

	function play3() {
		status("Playing...");
		console.log('playback url' + playBackUrl3);
		Wami.startPlaying(playBackUrl3);		
	}
	//end of third recording

	// fourth recording 
	function record4() {
		status("Recording...");
		recording4 = age + '_' + nationality + '_' + nativeEng + '_' + uuid + '_' + taskSentences2 + '_' + 't' + '_' + 'step2_audio4.wav';
        recordingUrl4 = 'http://www.dis.uniroma1.it/~s4r/audio/save_file.php?filename=' + recording4;
        console.log(recordingUrl4);
		Wami.startRecording(recordingUrl4);
	}

	function stop4() {
		status("Stop");
		Wami.stopRecording();
		playBackUrl4 = 'http://www.dis.uniroma1.it/~s4r/audio/' + recording4;
		console.log(playBackUrl4);
		<?php $link = "<script>document.write(recording)</script>"?>   
		Wami.stopPlaying();
	}

	function play4() {
		status("Playing...");
		console.log('playback url' + playBackUrl4);
		Wami.startPlaying(playBackUrl4);		
	}
	//end of fourth recording

	function status(msg) {
		document.getElementById('status').innerHTML = msg;
	}
	
	function saveRec()
	{
		console.log(playBackUrl);
		//console.log(recording);
	}
	
     function thanks()
     {
	 window.open("thanks.php","_self")
	 }
	 
	 // Adding the fourth sentence in the DB -->
	$(function()
	{
		$('#submit1').click(function()
		{

			var uuidj = '';
			var recordingFile = '';
			uuidj = <? echo '"'.$var_uuid.'"'; ?>;
			var step = '2';
			var sentenceID = '1';
			var recordingFile = recording1;
			var grammarSentence1 = <? echo '"'.$grammarSentences[0].'"'; ?>; 
    
			$.ajax(
			{
				url: 'function/submit_to_db2.php',
				type: 'POST',
				data: 'uuidj=' + uuidj + '&recordingFile=' + recordingFile + '&step=' + step + '&sentenceID=' + sentenceID + '&sentence=' + grammarSentence1,

				success: function(result)
				{
					document.getElementById('status').innerHTML = result;
				}
			});
			return false;	
		});
	 });
	 
	 // Adding the fourth sentence in the DB -->
	$(function()
	{
		$('#submit2').click(function()
		{

			var uuidj = '';
			var recordingFile = '';
			uuidj = <? echo '"'.$var_uuid.'"'; ?>;
			var step = '2';
			var sentenceID = '2';
			var recordingFile = recording2;
			var grammarSentence2 = <? echo '"'.$grammarSentences[1].'"'; ?>; 
    
			$.ajax(
			{
				url: 'function/submit_to_db2.php',
				type: 'POST',
				data: 'uuidj=' + uuidj + '&recordingFile=' + recordingFile + '&step=' + step + '&sentenceID=' + sentenceID + '&sentence=' + grammarSentence2,

				success: function(result)
				{
					document.getElementById('status').innerHTML = result;
				}
			});
			return false;	
		});
	 });
	 
	 // Adding the fourth sentence in the DB -->
	$(function()
	{
		$('#submit3').click(function()
		{

			var uuidj = '';
			var recordingFile = '';
			uuidj = <? echo '"'.$var_uuid.'"'; ?>;
			var step = '2';
			var sentenceID = '3';
			var recordingFile = recording3;
			var taskSentence1 = <? echo '"'.$taskSentences[0].'"'; ?>; 
				
			$.ajax(
			{
				url: 'function/submit_to_db2.php',
				type: 'POST',
				data: 'uuidj=' + uuidj + '&recordingFile=' + recordingFile + '&step=' + step + '&sentenceID=' + sentenceID + '&sentence=' + taskSentence1,

				success: function(result)
				{
					document.getElementById('status').innerHTML = result;
				}
			});
			return false;	
		});
	 });
	 
	 // Adding the fourth sentence in the DB -->
	$(function()
	{
		$('#submit4').click(function()
		{
			var uuidj = '';
			var recordingFile = '';
			uuidj = <? echo '"'.$var_uuid.'"'; ?>;
			var step = '2';
			var sentenceID = '4';
			var recordingFile = recording4;
			var taskSentence2 = <? echo '"'.$taskSentences[1].'"'; ?>;
				
			$.ajax(
			{
				url: 'function/submit_to_db2.php',
				type: 'POST',
				data: 'uuidj=' + uuidj + '&recordingFile=' + recordingFile + '&step=' + step + '&sentenceID=' + sentenceID + '&sentence=' + taskSentence2,

				success: function(result)
				{
					document.getElementById('status').innerHTML = result;
				}
			});
			return false;
		});
	 });
	  
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
      <p style="font-size: 20pt">Experiment 2</p>
	    <p style="font-size: 16pt">This time we will propose some commands for you. Enable recording and pronounce your commands.</p>

    <br />
      <p>Please give Abode Flash control over the microphone also before you enable microphone input either plug in headphones or turn the volume down if you want to avoid ear splitting feedback, especially while playing back already recorded sounds</p>
      <span class="label label-important" style="font-size: 13.5pt">Please check whether your command has been correctly recorded before saving the file! Thank you.</span>
      </br>
        <hr />

      <div id="wami"></div>

      <center>

      <!-- First recording from our phrases -->
      <p>
	      <form method="post" action="function/submit_to_db2.php" class="form-inline">
	      <div id="container1">
	      	<?     		
	      		echo "<pre1 style='width: 630px'><b>Task 1: ". $grammarSentences[0] ."</b></pre1>"; 
	      	?>
		  	<input type="button" class="btn btn-primary" value="Record" onclick="record1()"></input>
	      	<input type="button" class="btn btn-warning" value="Stop" onclick="stop1()"></input>
	      	<input type="button" class="btn btn-success" value="Play" onclick="play1()"></input>
	        <button name="submit1" id="submit1" class="btn btn-inverse" >Save</button>
		  </div>
		</form>
      </p>

      <!-- Second recording from our phrases -->
      <p>
	      <form method="post" action="function/submit_to_db2.php" class="form-inline">
	      <div id="container2">
	      <?     		
	      		echo "<pre1 style='width: 630px'><b>Task 2: ". $grammarSentences[1] ."</b></pre1>"; 
	      	?>
		  	<input type="button" class="btn btn-primary" value="Record" onclick="record2()"></input>
	      	<input type="button" class="btn btn-warning" value="Stop" onclick="stop2()"></input>
	      	<input type="button" class="btn btn-success" value="Play" onclick="play2()"></input>
		    <button name="submit2" id="submit2" class="btn btn-inverse" >Save</button>
		  </div>
		</form>
      </p>

      <!-- First recording from the user phrases -->
      <p>
	      <form method="post" action="function/submit_to_db2.php" class="form-inline">
	      <div id="container1">
	      	<?     		
	      		echo "<pre1 style='width: 630px'><b>Task 3: ". $taskSentences[0] ."</b></pre1>";  
	      	?>
		  	<input type="button" class="btn btn-primary" value="Record" onclick="record3()"></input>
	      	<input type="button" class="btn btn-warning" value="Stop" onclick="stop3()"></input>
	      	<input type="button" class="btn btn-success" value="Play" onclick="play3()"></input>
	        <button name="submit3" id="submit3" class="btn btn-inverse" >Save</button>
		  </div>
		</form>
      </p>

      <!-- Second recording from the user phrases -->
      <p>
	      <form method="post" action="function/submit_to_db2.php" class="form-inline">
	      <div id="container2">
	      <?     		
	      		echo "<pre1 style='width: 630px'><b>Task 4: ". $taskSentences[1] ."</b></pre1>";  
	      	?>
		  	<input type="button" class="btn btn-primary" value="Record" onclick="record4()"></input>
	      	<input type="button" class="btn btn-warning" value="Stop" onclick="stop4()"></input>
	      	<input type="button" class="btn btn-success" value="Play" onclick="play4()"></input>
		    <button name="submit4" id="submit4" class="btn btn-inverse" >Save</button>
		  </div>
		</form>
      </p>

      </center>
      <form class="form-inline">
      	<label class="control-label" >Status : </label> <span class="label label-important" id="status"></span>
      </form>

      <center>
     <button onclick="thanks()" id="thanksBtn" class="btn btn-primary" >Finish</button>
      </center>

        <hr />

    </div>

     <hr>

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

    </div>
  </body>
</html>
