<?php
session_start();

$uuid_session = uniqid(md5(rand()));

$_SESSION['uuid'] = $uuid_session;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>General Info - S4R Experiment</title>
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
	    function ValidateRequiredForm()
	    {
		    var age = document.RequiredForm.Age;
		    var nationality = document.RequiredForm.Nationality;
		    var gender = document.RequiredForm.Gender;
		    var nativeEnglish = document.RequiredForm.NativeEnglish;
		    var languageProficiency = document.RequiredForm.LanguageProficiency;
		    var speechExperience = document.RequiredForm.SpeechExperience;
		    var backgroundA = document.RequiredForm.Background;
		    var mic = document.RequiredForm.Microphone;
		    var iAgree = document.getElementById('Agreement');

		    if (age.value == "" )
		    {
			    $('#errorAgeModal').modal('show')
			    age.focus();
			    return false;
			 }
			 if (nationality.value == "")
			 {
				 $('#errorNationalityModal').modal('show')
				 nationality.focus();
				 return false;
			 }
			 if (gender.value == "")
			 {
				$('#errorGender').modal('show')
			 	gender.focus();
			 	return false;
			 }
			 if (nativeEnglish.value == "")
			 {
			 	$('#errorNativeModal').modal('show')
			 	nativeEnglish.focus();
			 	return false;
			 }
			 if (nativeEnglish.value == "no")
			 {
			 	if (languageProficiency.value == "")
			 	{
			 		$('#errorLanguageProficiency').modal('show')
			 		languageProficiency.focus();
			 		return false;
			 	}
			 }
			 if (speechExperience.value == "")
			 {
			 	$('#errorKnowledgeSpeech').modal('show')
			 	speechExperience.focus();
			 	return false;
			 }
			 if (backgroundA.value == "")
			 {
			 	$('#errorBackground').modal('show')
			 	backgroundA.focus();
			 	return false;
			 }
			 if (mic.value == "")
			 {
			 	$('#errorMicrophone').modal('show')
			 	mic.focus();
			 	return false;
			 }
			 if (!iAgree.checked)
			 {
				$('#errorAgreementModal').modal('show')
			 	nativeEnglish.focus();
			 	return false;
			 }

			 return true;
		}
		
		function enableLanguage()
		{
			var lang = document.RequiredForm.NativeEnglish;
			if (lang.value == 'no')
			{
				document.getElementById('LanguageProficiency').disabled = false;
			}
			else
			{
				document.getElementById('LanguageProficiency').disabled = true;
			}
		}

		function startUp(){
			document.getElementById('submitBtn').disabled = false;
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

  <body onload="startUp()">
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" align="middle">Speaky For Robots Experiment</a> 
        </div>
      </div>
    </div>

     <noscript>
        <div id="noscript-warning">This web site needs javascript activated to work properly. Please activate it. Thanks!</div>
    </noscript>


    <div class="recorder container">
    <br />
      <b>Confidentiality Statement</b>
      <p>We undertake an agreement with each trainee to keep survey responses confidential. Any reports produced from your data will be aggregated and anonymised. Survey data will be accessed by and visible only to the team responsible for the S4R project. Survey data will not be handled by or visible to any other third parties, individuals or organizations. Confidential survey data will not be visible to or used in relation to any other areas of S4R business. Reports or publications based on survey data will be aggregated and anonymised. Individual respondents will not be identifiable.</p>
      
      <hr />

      <p>
	      <form action="robot_cap.php" class="form-inline"  method="post" name="RequiredForm" onsubmit="return ValidateRequiredForm();">
		     <label class="control-label" >Age</label>
		      <input type="number" class="input-mini" name="Age" id="Age" placeholder="Age">
		      <label class="control-label" >Nationality</label>
		      <input type="text" class="input-large" name="Nationality" id="Nationality" placeholder="Nationality">
		      <label class="control-label" >Gender</label>
		      <select name="Gender" id="Gender" style="width: 80px">
  					<option></option>
  					<option value="M" >Male</option>
 					<option value="F" >Female</option>
				</select>
				<br>
				<br>

		      <label class="control-label" >English native tongue</label>
		      	<select name="NativeEnglish" id="NativeEnglish" style="width: 70px" onchange="enableLanguage();">
  					<option></option>
  					<option value="yes" >yes.</option>
 					<option value="no" >no.</option>
				</select>

			 <label class="control-label" >Language Proficiency</label>
		      	<select name="LanguageProficiency" id="LanguageProficiency" style="width: 185px" disabled>
  					<option></option>
  					<option value="Living in Anglo-Saxon countries for at least 2 years" >Living in Anglo-Saxon countries for at least 2 years.</option>
 					<option value="Solid english speaker" >Solid english speaker.</option>
 					<option value="Week english speaker" >Weak english speaker.</option>
				</select>
				
		      	<br>
		      	<br>

		      <label class="control-label" >Speech interfaces experience</label>
		      	<select name="SpeechExperience" id="SpeechExperience" style="width: 140px">
  					<option></option>
  					<option value="I work in NLP or ASR" >I work in NLP or ASR.</option>
 					<option value="I`m not an expert but i use Siri or Google Voice" >I`m not an expert but i use 'Siri' or 'Google Voice'.</option>
 					<option value="No knowledge at all." >No knowledge at all.</option>
				</select>

			 <label class="control-label" >Background</label>
		      	<select name="Background" id="Background" style="width: 120px">
  					<option></option>
  					<option value="Robotics" >Robotics.</option>
 					<option value="Computer Science" >Computer Science.</option>
 					<option value="Other" >Other.</option>
				</select>
				
				<br>
				<br>
				
			<label class="control-label" >Microphone</label>
		      	<select name="Microphone" id="Microphone" style="width: 120px">
  					<option></option>
  					<option value="internal" >Internal</option>
 					<option value="external" >External</option>
				</select>
			<label class="control-label" >Nickname/Name*</label>
		      <input type="text" class="input-large" name="Nickname" id="Nickname" placeholder="Nickname/Name" style="width: 205px">	

		      	<br>
		      	<br>

		      <label class="checkbox" name="Agreement">
			      <input id="Agreement" name="Agreement" type="checkbox"> I agree with the Confidentiality Statement.
			  </label>
			  <br>
			  <br>

		      <a href="#errorAgreementModal" role="button" class="btn btn-danger" data-toggle="modal">I do not agree</a>

		      <button type="submit" id="submitBtn" class="btn btn-primary" disabled >Next step</button>
   		</form>
      </p>

      <p>*The field Nickname/Name is optional. By filling it you will explicitly thanked in the credits that will be published at the end of the experiment. Feel free to add your real name, a nickname, or whatever identifies you.</p>

      	<!-- Begining of the modal erros -->
      	
      <center>

        <!-- Error Agreement Modal -->
        <div id="errorAgreementModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	        <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		        <h3 id="myModalLabel">ERROR AGREEMENT</h3>
		    </div>
		    <div class="modal-body">
			    <p>In order to perform this experiment you need to agree with the license!</p>
		    </div>
		   <div class="modal-footer">
			  <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
	      </div>
	   </div>

	    <!-- Error Age Modal -->
        <div id="errorAgeModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	        <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		        <h3 id="myModalLabel">ERROR AGE</h3>
		    </div>
		    <div class="modal-body">
			    <p>Please enter a valid age!</p>
		    </div>
		   <div class="modal-footer">
			  <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
	      </div>
	   </div>

	    <!-- Error Nationality Modal -->
        <div id="errorNationalityModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	        <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		        <h3 id="myModalLabel">ERROR  NATIONALITY</h3>
		    </div>
		    <div class="modal-body">
			    <p>Please enter your nationality.</p>
		    </div>
		   <div class="modal-footer">
			  <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
	      </div>
	   </div>

	   <!-- Error Gender Modal -->
        <div id="errorGender" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	        <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		        <h3 id="myModalLabel">ERROR</h3>
		    </div>
		    <div class="modal-body">
			    <p>Please select your gender!</p>
		    </div>
		   <div class="modal-footer">
			  <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
	      </div>
	   </div>

	   <!-- Error Native Language Modal -->
        <div id="errorNativeModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	        <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		        <h3 id="myModalLabel">ERROR</h3>
		    </div>
		    <div class="modal-body">
			    <p>Please select if you are a english native speaker or not.</p>
		    </div>
		   <div class="modal-footer">
			  <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
	      </div>
	   </div>

	    <!-- Error Language Proficiency Modal -->
        <div id="errorLanguageProficiency" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	        <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		        <h3 id="myModalLabel">ERROR</h3>
		    </div>
		    <div class="modal-body">
			    <p>Please select your language proficiency.</p>
		    </div>
		   <div class="modal-footer">
			  <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
	      </div>
	   </div>

	    <!-- Error Knowledge Speech Modal -->
        <div id="errorKnowledgeSpeech" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	        <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		        <h3 id="myModalLabel">ERROR</h3>
		    </div>
		    <div class="modal-body">
			    <p>Please select your knowledge about speech interface.</p>
		    </div>
		   <div class="modal-footer">
			  <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
	      </div>
	   </div>

	    <!-- Error Background Modal -->
        <div id="errorBackground" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	        <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		        <h3 id="myModalLabel">ERROR</h3>
		    </div>
		    <div class="modal-body">
			    <p>Please select your occupancy.</p>
		    </div>
		   <div class="modal-footer">
			  <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
	      </div>
	   </div>
	   
	   <!-- Error Microphone Modal -->
        <div id="errorMicrophone" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	        <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		        <h3 id="myModalLabel">ERROR</h3>
		    </div>
		    <div class="modal-body">
			    <p>Please select what kind of microphone are you using.</p>
		    </div>
		   <div class="modal-footer">
			  <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
	      </div>
	   </div>

      </center>
	    <!-- End of Modals -->  
	    

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
		    document.getElementById('submitBtn').disabled = false;
		}
		_onload();
	</script>

    </div>
  </body>
</html>
