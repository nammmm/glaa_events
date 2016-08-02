<?php
require_once 'login.php';
require_once 'helper.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$conn->set_charset('utf8mb4');

if (isset($_POST['table'])) {
	$table = sanitizeMySQL($conn, $_POST['table']);
	$query = "";

	switch ($table) {
		case 'Institutions':
			$institutionID = sanitizeMySQL($conn, $_POST['institutionID']);
			$institutionName = sanitizeMySQL($conn, $_POST['institutionName']);
			$isGLCA = (sanitizeMySQL($conn, $_POST['isGLCA']) == "yes") ? 1 : 0;

			$query = "UPDATE Institutions SET " .
						"Institution = '$institutionName', " .
						"IsGLCA = $isGLCA " . 
						"WHERE InstitutionID = $institutionID";
			break;
		case 'Participants':
			$participantID = sanitizeMySQL($conn, $_POST['participantID']);
			$firstName = sanitizeMySQL($conn, $_POST['firstName']);
			$lastName = sanitizeMySQL($conn, $_POST['lastName']);
			$institutionID = sanitizeMySQL($conn, $_POST['institutionID']);
			$role = sanitizeMySQL($conn, $_POST['role']);
			$title = sanitizeMySQL($conn, $_POST['title']);
			$email = sanitizeMySQL($conn, $_POST['email']);
			
			$query = "UPDATE Participants SET " .
						"FirstName = '$firstName', " . 
						"LastName = '$lastName', " . 
						"InstitutionID = $institutionID, " . 
						"Role = '$role', " . 
						"Title = '$title', " . 
						"Email = '$email' " . 
						"WHERE ParticipantID = $participantID";
			break;
		case 'Events':
			$eventID = sanitizeMySQL($conn, $_POST['eventID']);
			$name = sanitizeMySQL($conn, $_POST['eventName']);
			$description = sanitizeMySQL($conn, $_POST['description']);
			$academicYear = sanitizeMySQL($conn, $_POST['academicYear']);
			$hostID = sanitizeMySQL($conn, $_POST['hostID']);
			
			$query = "UPDATE Events SET " .
						"Name = '$name', " . 
						"Description = '$description', " . 
						"AcademicYear = '$academicYear', " . 
						"HostID = $hostID " . 
						"WHERE EventID = $eventID";
			break;
		case 'Participations':
			$participantID = sanitizeMySQL($conn, $_POST['participantID']);
			$eventID = sanitizeMySQL($conn, $_POST['eventID']);
			
			$query = "UPDATE Participations SET " .
						"EventID = $eventID " . 
						"WHERE ParticipantID = $participantID";
			break;
		default:
			break;
	}

	$result = $conn->query($query);
	if (!$result) 
		echo "$conn->error";
	else
		echo "success";


	$result->close();
	$conn->close();
}
?>