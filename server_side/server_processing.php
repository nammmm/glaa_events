<?php
require_once 'helper.php';
// if (true) {
if (isset($_POST['eventID']) && isset($_POST['institutionID'])) { 
	require_once 'login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);

	$eventID = sanitizeMySQL($conn, $_POST['eventID']);
	$institutionID = sanitizeMySQL($conn, $_POST['institutionID']);

	if ($institutionID == "Select institution") {
		$query = "(SELECT pa.ParticipantID, pa.FirstName, pa.LastName FROM Participants pa LEFT JOIN Participations pp ON pp.ParticipantID = pa.ParticipantID WHERE pp.ParticipantID IS NULL) UNION " . "(SELECT pa.ParticipantID, pa.FirstName, pa.LastName FROM Events ev " . 
					"LEFT JOIN Participations pp " . 
					"ON ev.EventID = pp.EventID " . 
					"LEFT JOIN Participants pa " . 
					"ON pp.ParticipantID = pa.ParticipantID " . 
					"WHERE pp.EventID <> $eventID)";
	}
	else {
		$query = "(SELECT pa.ParticipantID, pa.FirstName, pa.LastName FROM Participants pa LEFT JOIN Participations pp ON pp.ParticipantID = pa.ParticipantID WHERE pp.ParticipantID IS NULL AND pa.InstitutionID = $institutionID) UNION " . "(SELECT pa.ParticipantID, pa.FirstName, pa.LastName FROM Events ev " . 
					"LEFT JOIN Participations pp " . 
					"ON ev.EventID = pp.EventID " . 
					"LEFT JOIN Participants pa " . 
					"ON pp.ParticipantID = pa.ParticipantID " . 
					"WHERE pp.EventID <> $eventID AND pa.InstitutionID = $institutionID)";
	}

	$return = array();
	if ($result = $conn->query($query)) {
	    // fetch array
	    while ($row=mysqli_fetch_assoc($result)) {
	        $return[] = $row;
	    }

	    $result->close();
	    $conn->close();

	    echo(json_encode($return));
	}
}

function getInstitution($connection, $id)
{
	$query  = "SELECT Institution FROM Institutions WHERE InstitutionID = " . $id;
	$result = $connection->query($query)->fetch_array(MYSQLI_ASSOC);
	$name = $result['Institution'];
	return $name;
}

function getInstitutionByType($connection, $id, $type)
{
	if ($type == "pa") {
		$query  = "SELECT ins.Institution, pa.FirstName, pa.LastName " . 
				"FROM Institutions ins " . 
				"LEFT JOIN Participants pa " . 
				"ON ins.InstitutionID = pa.InstitutionID " . 
				"WHERE pa.ParticipantID = $id";
	}
	else if ($type == "ev") {
		$query  = "SELECT ev.Name, ev.AcademicYear, ins.Institution " . 
				"FROM Institutions ins " . 
				"LEFT JOIN Events ev " . 
				"ON ins.InstitutionID = ev.HostID " . 
				"WHERE ev.EventID = $id";
	}
	$result = $connection->query($query)->fetch_array(MYSQLI_ASSOC);
	if (!$result) 
	    die ("Database access failed: " . $conn->error);
	return $result;
}
?>