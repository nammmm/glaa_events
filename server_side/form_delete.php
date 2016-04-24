<?php
require_once 'login.php';
require_once 'helper.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_POST['table'])) {
	$table = sanitizeMySQL($conn, $_POST['table']);
	$query = "";

	switch ($table) {
		case 'Institutions':
			$institutionID = sanitizeMySQL($conn, $_POST['institutionID']);
			$query = "DELETE FROM Institutions " . 
						"WHERE InstitutionID = $institutionID";
			break;
		case 'Participants':
			$participantID = sanitizeMySQL($conn, $_POST['participantID']);
			$query = "DELETE FROM Participants " . 
						"WHERE ParticipantID = $participantID";
			break;
		case 'Events':
			$eventID = sanitizeMySQL($conn, $_POST['eventID']);
			$query = "DELETE FROM Events " . 
						"WHERE EventID = $eventID";
			break;
		default:
			break;
	}

	$result = $conn->query($query);
	if (!$result) 
		echo "$conn->error";
	else
		echo "success";
}
$conn->close();
?>