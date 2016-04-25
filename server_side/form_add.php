<?php
require_once 'login.php';
require_once 'helper.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

// if (true) {
if (isset($_POST['table'])) {
	$table = sanitizeMySQL($conn, $_POST['table']);
	$query = "";

	switch ($table) {
		case 'Institutions':
			$institutionName = sanitizeMySQL($conn, $_POST['institutionName']);
			$isGLAA = (sanitizeMySQL($conn, $_POST['isGLAA']) == "yes") ? 1 : 0;

			$query = "INSERT INTO Institutions (Institution, IsGLAA)" .
                    "VALUES('$institutionName', $isGLAA)";
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
			$name = sanitizeMySQL($conn, $_POST['name']);
			$description = sanitizeMySQL($conn, $_POST['description']);
			$academicYear = sanitizeMySQL($conn, $_POST['academicYear']);
			$hostID = sanitizeMySQL($conn, $_POST['hostID']);

			$query = "INSERT INTO Events (Name, Description, AcademicYear, HostID)" .
                    "VALUES('$name', '$description', '$academicYear', $hostID)";
			break;
		case 'Participations':
			$eventID = sanitizeMySQL($conn, $_POST['eventID']);
			$participantIDs = json_decode($_POST['participantIDs']);

			$query = "INSERT INTO Participations (ParticipantID, EventID) VALUES ";
			foreach ($participantIDs as $participantID)
				$query .= "(" . $participantID . ", " . $eventID . "), "; 
			$query = rtrim($query, ", ");
			// print_r($query);
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