<?php
require_once 'login.php';
require_once 'helper.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$conn->set_charset('utf8mb4');

if (isset($_POST['file'])) {
	$fileName = $_POST['file'];
	$file = fopen("../uploads/" . $fileName, "r");

	$headers = fgetcsv($file);
	echo "------------------------ Ready to import ---------------------<br><br>";

	$countRow = 0;
	$strBeingAdded = " is being added ...<br>";
	$strAlreadyExists = " already exists.<br>";

	while(! feof($file))
	{
		$row = fgetcsv($file);
		echo "Scanning row " . ++$countRow . " ...<br>";

		// handle institution
		$itemID = isInDB($conn, 'Institutions', $row);
		$strItem = "Institution <strong>$row[0]</strong>";
		if (!$itemID) {
			echo $strItem . $strBeingAdded;
			$row[] = addToDB($conn, 'Institutions', $row);
		}
		else {
			echo $strItem . $strAlreadyExists;
			$row[] = $itemID;
		}


		// handle host
		$itemID = isInDB($conn, 'Institutions', $row, true);
		$strItem = "Host <strong>$row[9]</strong>";
		if (!$itemID) {
			echo $strItem . $strBeingAdded;
			$row[] = addToDB($conn, 'Institutions', $row, true);
		}
		else {
			echo $strItem . $strAlreadyExists;
			$row[] = $itemID;
		}


		// handle participant
		$itemID = isInDB($conn, 'Participants', $row);
		$strItem = "Participant <strong>$row[1] " . "$row[2]</strong>";
		if (!$itemID) {
			echo $strItem . $strBeingAdded;
			$row[] = addToDB($conn, 'Participants', $row);
		}
		else {
			echo $strItem . $strAlreadyExists;
			$row[] = $itemID;
		}


		// handle event
		$itemID = isInDB($conn, 'Events', $row);
		$strItem = "Event <strong>$row[6]</strong>";
		if (!$itemID) {
			echo $strItem . $strBeingAdded;
			$row[] = addToDB($conn, 'Events', $row);
		}
		else {
			echo $strItem . $strAlreadyExists;
			$row[] = $itemID;
		}


		// handle participation
		$itemID = isInDB($conn, 'Participations', $row);
		$strItem = "Participation <strong>$row[1] " . "$row[2] => $row[6]</strong>";
		if (!$itemID) {
			echo $strItem . $strBeingAdded;
			$row[] = addToDB($conn, 'Participations', $row);
		}
		else {
			echo $strItem . $strAlreadyExists;
			$row[] = $itemID;
		}
		echo "Row $countRow imported.<br><br>";
	}
	fclose($file);
	echo "------------------------ Import completed ---------------------<br>";
	$conn->close();
}


function isInDB($conn, $table, $row, $host = false) {
	$query = "";

	switch ($table) {
		case 'Institutions':
			$institutionName = $row[0];
			if ($host)	$institutionName = $row[9];

			$query = "SELECT InstitutionID FROM Institutions WHERE Institution = '$institutionName'";
			break;
		case 'Participants':
			$firstName = $row[1];
			$lastName = $row[2];
			$email = $row[5];

			$query = "SELECT ParticipantID FROM Participants WHERE FirstName = '$firstName' AND LastName = '$lastName' AND Email = '$email'";
			break;
		case 'Events':
			$name = $row[6];
			$academicYear = $row[7];
			$hostID = $row[11];

			$query = "SELECT EventID FROM Events WHERE Name = '$name' AND AcademicYear = '$academicYear' AND HostID = '$hostID'";
			break;
		case 'Participations':
			$participantID = $row[12];
			$eventID = $row[13];

			$query = "SELECT ParticipantID FROM Participations WHERE ParticipantID = $participantID AND EventID = $eventID";
			break;
		default:
			break;
	}

	$result = $conn->query($query);
	if ($result) {
		$len = $result->num_rows;
		if ($len > 0) {
			return $result->fetch_row()[0];
		}
		else
			return false;
	}
	else
		die("$conn->error");

	$result->close();
}


function addToDB($conn, $table, $row, $host = false) {
	$query = "";

	switch ($table) {
		case 'Institutions':
			$institutionName = $row[0];
			if ($host)	$institutionName = $row[9];
			$isGLCA = 0;	// Default is set to NO

			$query = "INSERT INTO Institutions (Institution, IsGLCA)" .
                    "VALUES('$institutionName', $isGLCA)";
			break;
		case 'Participants':
			$firstName = $row[1];
			$lastName = $row[2];
			$institutionID = $row[10];
			$role = $row[3];
			$title = $row[4];
			$email = $row[5];

			$query = "INSERT INTO Participants (FirstName, LastName, InstitutionID, Role, Title, Email)" .
                    "VALUES('$firstName', '$lastName', $institutionID, '$role', '$title', '$email')";
			break;
		case 'Events':
			$name = $row[6];
			$academicYear = $row[7];
			$description = $row[8];
			$hostID = $row[11];

			$query = "INSERT INTO Events (Name, Description, AcademicYear, HostID)" .
                    "VALUES('$name', '$description', '$academicYear', $hostID)";
			break;
		case 'Participations':
			$participantID = $row[12];
			$eventID = $row[13];

			$query = "INSERT INTO Participations (ParticipantID, EventID)" . 
					"VALUES('$participantID', '$eventID')";
			break;
		default:
			break;
	}

	$result = $conn->query($query);
	if ($result)
		return $conn->insert_id;
	else
		die("$conn->error");

	$result->close();
}

?>