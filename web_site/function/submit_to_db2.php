<?php
include_once('configDB.php');

$conn = new mysqli($host,$user,$pass,$database);

// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error($con);
}

$query = "INSERT into GrammarUserSentences (uuid, task_id, sentence_id, sentence, audio_filename) VALUES (?, ?, ?, ?, ?)";
$query1 = "INSERT into AudioFiles (uuid, step_number, audio_filename) VALUES (?, ?, ?)"; 

$stmt = $conn->stmt_init();
if($stmt->prepare($query)) {
	$stmt->bind_param('sssss', $_POST['uuidj'], $_POST['step'], $_POST['sentenceID'], $_POST['sentence'], $_POST['recordingFile']);
	$stmt->execute();
}

if($stmt->prepare($query1)) {
	$stmt->bind_param('sss', $_POST['uuidj'], $_POST['step'], $_POST['recordingFile']);
	$stmt->execute();
}

if($stmt) {
echo "Sentence " . $_POST['step'] . " added successfully!";
} else {
echo "There was a problem adding the sentence " . $_POST['step'] . " into the database. Please try again later.";
}

$stmt->close();

// Closing the DB connection
mysqli_close($conn);
?>