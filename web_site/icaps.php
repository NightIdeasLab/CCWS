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

$uuid_session = uniqid(md5(rand()));

// Retriving all the centences available
$sql="SELECT sentence FROM GrammarSentences UNION SELECT sentence FROM TaskUserSentences order by RAND() LIMIT 1;";
$result_grammar=mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result_grammar, MYSQLI_ASSOC)) 
{		       
$grammarSentences[] = $row['sentence'];			       
}

mysqli_free_result($result_grammar);

// Closing the connection with the DB
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>ICAPS Conference - S4R Experiment</title>
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
    var uuid = <? echo '"'.$uuid_session.'"'; ?>;
      
    // first recording 
	function record1() {
		status("Recording...");
		recording1 = 'icaps_' + uuid + '_' + 'audio.wav';
		console.log("UUID: " + uuid);
        recordingUrl1 = 'http://localhost/web_site/audio/save_file.php?filename=' + recording1;
        console.log('recording urdl: ' + recordingUrl1);
        console.log('recording: ' + recording1);
		Wami.startRecording(recordingUrl1);
	}

	function stop1() {
		status("Stop");
		Wami.stopRecording();
		playBackUrl1 = 'http://localhost/web_site/audio/' + recording1;
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

	function status(msg) {
		document.getElementById('status').innerHTML = msg;
	}
	 
	 // Adding the sentence in the DB -->
	$(function()
	{
		$('#submit1').click(function()
		{
			
			var uuidj = '';
			var recordingFile = '';
			uuidj = <? echo '"'.$uuid_session.'"'; ?>;
			var recordingFile = recording1;
			var grammarSentence = <? echo '"'.$grammarSentences[0].'"'; ?>; 
    
			$.ajax(
			{
				url: 'function/submit_to_db_icap.php',
				type: 'POST',
				data: 'uuidj=' + uuidj + '&recordingFile=' + recordingFile + '&sentence=' + grammarSentence,

				success: function(result)
				{
					document.getElementById('status').innerHTML = result;
					console.log("Saved the data!");
					$('#thanksModal').modal('show')
					timedRefresh(2000);
				}
			});
			return false;	
		});
	 });
	 
	 function timedRefresh(timeoutPeriod) {
		 setTimeout("location.reload(true);",timeoutPeriod);
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
      <p style="font-size: 16pt">Creating a spoken corpus for service robots.</p>
      
      </br>
    <p style="font-size: 16pt">Please read the sentence below and record it: </p>

      </br>
        <hr />

      <div id="wami"></div>

      <center>

      <!-- First recording from our phrases -->
      <p>
	      <form method="post" action="function/submit_to_db_icap.php" class="form-inline">
	      <div id="container1">
	      	<?     		
	      		echo "<pre1 style='width: 800px'><b><h1>". $grammarSentences[0] ."</h1></b></pre1>"; 
	      	?>
	      	<br/>	
	      	
		  	<input type="button" class="btn btn-large btn-warning" style="width: 200px; height: 100px" value="Record" onclick="record1()"></input>&nbsp;&nbsp;&nbsp;&nbsp;
		  	<input type="button" class="btn btn-large btn-primary" style="width: 200px; height: 100px" value="Stop" onclick="stop1()"></input>&nbsp;&nbsp;&nbsp;&nbsp;
	        <button name="submit1" id="submit1" class="btn btn-large btn-success" style="width: 200px; height: 100px" >Save</button>
		  </div>
		</form>
      </p>

      </center>
      <form class="form-inline">
      	<label class="control-label" >Status : </label> <span class="label label-important" id="status"></span>
      </form>

        <hr />

    </div>

     <hr>
     
     <center>
     	<!-- Error Agreement Modal -->
        <div id="thanksModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	        <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		        <h3 id="myModalLabel">Congratulation</h3>
		    </div>
		    <div class="modal-body">
			    <p><h4>Thank you for helping us in our experiment!</h4></p>
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

    </div>
  </body>
</html>
