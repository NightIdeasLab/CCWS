<?php
session_start();

include('function/configDB.php');

// Connect to the DB
$con=mysqli_connect($host,$user,$pass,$database);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error($con);
  }

$var_uuid = $_SESSION['uuid'];

$_SESSION['age'] = $_POST['Age'];
$var_age = $_SESSION['age'];

$_SESSION['nationality'] = $_POST['Nationality'];
$var_nationality = $_SESSION['nationality'];

$_SESSION['gender'] = $_POST['Gender'];
$var_gender = $_SESSION['gender'];

$_SESSION['native_eng'] = $_POST['NativeEnglish'];
$var_native = $_SESSION['native_eng'];


if(isset($_POST['LanguageProficiency']))
{
	$_SESSION['lang_proficiency'] = $_POST['LanguageProficiency'];
	$var_lang_proficiency = $_SESSION['lang_proficiency'];
}
else
{
	$_SESSION['lang_proficiency'] = 'NULL';
	$var_lang_proficiency = $_SESSION['lang_proficiency'];
}

$_SESSION['speech_experience'] = $_POST['SpeechExperience'];
$var_speech_experience = $_SESSION['speech_experience'];

$_SESSION['background'] = $_POST['Background'];
$var_background = $_SESSION['background'];

$_SESSION['microphone'] = $_POST['Microphone'];
$var_microphone = $_SESSION['microphone'];

if(isset($_POST['Nickname']))
{
	$_SESSION['nickname'] = $_POST['Nickname'];
	$var_nickname = $_SESSION['nickname'];
}
else
{
	$_SESSION['nickname'] = 'NULL';
	$var_nickname = $_SESSION['nickname'];
}

// Check if the user already exist
//$arrErrors = array();
if ((!empty($_SESSION['uuid'])==1) && (!empty($_SESSION['age'])==1) && (!empty($_SESSION['nationality'])==1) && (!empty($_SESSION['gender'])==1) && (!empty($_SESSION['native_eng'])==1) && (!empty($_SESSION['speech_experience'])==1) && (!empty($_SESSION['background'])==1) && (!empty($_SESSION['microphone'])==1))
{

$query = "SELECT * FROM Users WHERE uuid='$var_uuid'";
$result = $con->query($query);

	if($result->num_rows > 0)
	{
		// It prints when the uuid already exists.
		echo "<script language='javascript'>alert('Something went wrong please go back to the last page and refresh it!!!');</script>";
	}
	else
	{
		$sql="INSERT INTO Users (uuid, age, nationality, gender, native, language_proficiency, speech_experience, background, microphone, name)
	   		VALUES
	   		('$var_uuid','$var_age','$var_nationality','$var_gender','$var_native','$var_lang_proficiency','$var_speech_experience','$var_background', '$var_microphone', '$var_nickname')";

		if (!mysqli_query($con,$sql))
		{
			die('Please contact the <a href="mailto:ulici_gabriel@yahoo.com">administrator</a> and paste this error: ' . mysqli_error($con) . ' in the email. Thanks');
		}
	}

$result->close();

}
else
{
	echo "<script language='javascript'>alert('Something went wrong please start from the beginning!!!');</script>";
}

// Closing the connection with the DB
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Robot Capabilities - S4R Experiment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
      .soundBite input {
        margin-right: 4px;
      }
    </style>

    <script>
     function openStepOne()
     {
  	   window.open("instructions.php","_self")
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

  <body>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="#" align="middle">Speaky For Robots Experiment</a> 
        </div>
      </div>
    </div>

     <noscript>
        <div id="noscript-warning">This web site needs javascript activated to work properly. Please activate it. Thanks!</div>
    </noscript>

    <div class="recorder container">
  <br /><b>Your platform: Erratic Robot</b>
      <img align="right" src="img/erratic.jpg" class="img-polaroid"> 
      <p>Imagine to control a mobile wheeled robot (e.g. an Erratic robot) within an indoor environment. The robot is equipped with the following sensors: odometry, 2D laser rangefinder, and a Kinect device. Even more, there's a stand with a clamped tablet. The robot can be controlled through a voice user interface.</p>

      <p><b>The type of actions that the robot can perform concerns the navigation within the environment.</b></p>
      <b>The robot can:</b>
      <ul>
      <li>reach a specific place, identified by a symbol, AND NOT by raw coordinates</li>
      <li>reach a place from a specific direction (e.g. go left of the technical room)</li>
      <li>move or reach a place with a given speed (e.g. slow, fast, and so on)</li>
      <li>follow people, by tracking them through a vision-based system</li>
      <li>enable the camera to look or control a specific area in the environment</li>
      <li>carry and bring objects on its tray. However, it has to ask people for pulling and dropping objects on the tray</li>
      <li>ask questions or speak to people, by repeating the sentence commanded by the user</li>
		</ul>

      <b>The robot can't:</b>
      <ul>
      <li>open or close doors, but they can ask people for supporting them in this</li>
      <li>climb stairs, but it can use elevators.</li>
      <li>call the elevator, but can ask nearby people to support it in this</li>
      <li>manipulate objects</li>
      </ul>

    <center>
     <button onclick="openStepOne()" id="stepOneBtn" class="btn btn-primary" disabled >Next</button>
    </center>

    </div>

     <hr>

      <div class="footer">
        <div class="container">
	      <p> &copy; S4R Data Collector has been designed and developed by <a href="http://labrococo.dis.uniroma1.it/wiki/doku.php" target="_blank">RoCoCo Lab </a> at <a href="http://www.uniroma1.it/" target="_blank">Sapienza University of Rome</a></p>
	    </div>
      </div>

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="jquery/js/jquery-1.7.2.js"></script>
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

     <script type="text/javascript">
	    var _onload = window.onload || function()
	    {
		    document.getElementById('stepOneBtn').disabled = false;
		}
		_onload();
	</script>

    </div>
  </body>
</html>
