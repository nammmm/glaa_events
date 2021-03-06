<?php
require_once 'login.php';
require_once 'helper.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$conn->set_charset('utf8mb4');

// if (true) {
if (isset($_POST['table'])) {
	$table = sanitizeMySQL($conn, $_POST['table']);
	$query = "";

	switch ($table) {
		case 'Institutions':
			$institutionName = sanitizeMySQL($conn, $_POST['institutionName']);
			$isGLCA = (sanitizeMySQL($conn, $_POST['isGLCA']) == "yes") ? 1 : 0;

			$query = "INSERT INTO Institutions (Institution, IsGLCA)" .
                    "VALUES('$institutionName', $isGLCA)";
			break;
		case 'Participants':
			$firstName = sanitizeMySQL($conn, $_POST['firstName']);
			$lastName = sanitizeMySQL($conn, $_POST['lastName']);
			$institutionID = sanitizeMySQL($conn, $_POST['institutionID']);
			$role = sanitizeMySQL($conn, $_POST['role']);
			$title = sanitizeMySQL($conn, $_POST['title']);
			$email = sanitizeMySQL($conn, $_POST['email']);

			$query = "INSERT INTO Participants (FirstName, LastName, InstitutionID, Role, Title, Email)" .
                    "VALUES('$firstName', '$lastName', $institutionID, '$role', '$title', '$email')";
			break;
		case 'Events':
			$name = sanitizeMySQL($conn, $_POST['eventName']);
			$description = sanitizeMySQL($conn, $_POST['description']);
			$academicYear = sanitizeMySQL($conn, $_POST['academicYear']);
			$hostID = sanitizeMySQL($conn, $_POST['hostID']);

			$query = "INSERT INTO Events (Name, Description, AcademicYear, HostID)" .
                    "VALUES('$name', '$description', '$academicYear', $hostID)";
			break;
		case 'ParticipationsPa':
			$participantID = sanitizeMySQL($conn, $_POST['participantID']);
			$eventIDs = json_decode($_POST['eventIDs']);

			$query = "INSERT INTO Participations (ParticipantID, EventID) VALUES ";
			foreach ($eventIDs as $eventID)
				$query .= "(" . $participantID . ", " . $eventID . "), "; 
			$query = rtrim($query, ", ");
			break;
		case 'ParticipationsEv':
			$eventID = sanitizeMySQL($conn, $_POST['eventID']);
			$participantIDs = json_decode($_POST['participantIDs']);

			$query = "INSERT INTO Participations (ParticipantID, EventID) VALUES ";
			foreach ($participantIDs as $participantID)
				$query .= "(" . $participantID . ", " . $eventID . "), "; 
			$query = rtrim($query, ", ");
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