<?php
require_once 'helper.php';
if (isset($_POST['file'])) {
	require_once 'login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);

	if (isset($_POST['participantID'])) { 
		$participantID = sanitizeMySQL($conn, $_POST['participantID']);

		$query = "SELECT ev.EventID, ev.Name FROM Events ev " .
				"WHERE ev.EventID NOT IN " .
				"(SELECT pp.EventID FROM Participations pp " .
				"WHERE pp.ParticipantID = $participantID)";

		$return = array();
		if ($result = $conn->query($query)) {
		    // fetch array
		    while ($row=mysqli_fetch_assoc($result)) {
		        $return[] = $row;
		    }
		    echo(json_encode($return));
		}
	}
	elseif (isset($_POST['eventID'])) {
		$eventID = sanitizeMySQL($conn, $_POST['eventID']);

		$query = "SELECT pa.ParticipantID, pa.FirstName, pa.LastName FROM Participants pa " .
				"WHERE pa.ParticipantID NOT IN " .
				"(SELECT pp.ParticipantID FROM Participations pp " .
				"WHERE pp.EventID = $eventID)";

		$return = array();
		if ($result = $conn->query($query)) {
		    // fetch array
		    while ($row=mysqli_fetch_assoc($result)) {
		    	$row['Institution'] = getInstitutionByType($conn, $row['ParticipantID'], 'pa')['Institution'];
		        $return[] = $row;
		    }
		    echo(json_encode($return));
		}
	}

	$result->close();
	$conn->close();
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
		$query  = "SELECT ev.Name, ev.AcademicYear, ins.Institution as Host " . 
				"FROM Institutions ins " . 
				"LEFT JOIN Events ev " . 
				"ON ins.InstitutionID = ev.HostID " . 
				"WHERE ev.EventID = $id";
	}
	else if ($type == "paAll") {
		$query  = "SELECT ins.Institution, pa.FirstName, pa.LastName, pa.Role, pa.Title, pa.Email " . 
				"FROM Institutions ins " . 
				"LEFT JOIN Participants pa " . 
				"ON ins.InstitutionID = pa.InstitutionID " . 
				"WHERE pa.ParticipantID = $id";
	}
	else if ($type == "evAll") {
		$query  = "SELECT ev.Name, ev.Description, ev.AcademicYear, ins.Institution as Host " . 
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

function updateReport() {
	$query = "";

	$institutionID = $_POST['select-institution'];
	$eventID = $_POST['select-event'];
	$academicYear = $_POST['select-year'];
	$hostID = $_POST['select-host'];

	if ($institutionID == "All" && $eventID == "All" && $academicYear == "All" && $hostID == "All") {
		$query = "SELECT * FROM Participations";
	}
	// 4 choose 3
	elseif ($institutionID != "All" && $eventID != "All" && $academicYear != "All") {
		$query = "SELECT * FROM Participations pp " . 
					"LEFT JOIN Participants pa " . 
					"ON pa.ParticipantID = pp.ParticipantID " . 
					"LEFT JOIN Events ev " . 
					"ON ev.EventID = pp.EventID " . 
					"WHERE pa.InstitutionID = $institutionID AND ev.EventID = $eventID AND ev.AcademicYear = $academicYear";
	}
	elseif ($institutionID != "All" && $eventID != "All" && $hostID != "All") {
		$query = "SELECT * FROM Participations pp " . 
					"LEFT JOIN Participants pa " . 
					"ON pa.ParticipantID = pp.ParticipantID " . 
					"LEFT JOIN Events ev " . 
					"ON ev.EventID = pp.EventID " . 
					"WHERE pa.InstitutionID = $institutionID AND ev.EventID = $eventID AND ev.HostID = $hostID";
	}
	elseif ($institutionID != "All" && $academicYear != "All" && $hostID != "All") {
		$query = "SELECT * FROM Participations pp " . 
					"LEFT JOIN Participants pa " . 
					"ON pa.ParticipantID = pp.ParticipantID " . 
					"LEFT JOIN Events ev " . 
					"ON ev.EventID = pp.EventID " . 
					"WHERE pa.InstitutionID = $institutionID AND ev.AcademicYear = $academicYear AND ev.HostID = $hostID";
	}
	elseif ($eventID != "All" && $academicYear != "All" && $hostID != "All") {
		$query = "SELECT * FROM Participations pp " .  
					"LEFT JOIN Events ev " . 
					"ON ev.EventID = pp.EventID " . 
					"WHERE ev.EventID = $eventID AND ev.AcademicYear = $academicYear AND ev.HostID = $hostID";
	}
	// 4 choose 2
	elseif ($institutionID != "All" && $eventID != "All") {
		$query = "SELECT * FROM Participations pp " . 
					"LEFT JOIN Participants pa " . 
					"ON pa.ParticipantID = pp.ParticipantID " . 
					"LEFT JOIN Events ev " . 
					"ON ev.EventID = pp.EventID " . 
					"WHERE pa.InstitutionID = $institutionID AND ev.EventID = $eventID";
	}
	elseif ($institutionID != "All" && $academicYear != "All") {
		$query = "SELECT * FROM Participations pp " . 
					"LEFT JOIN Participants pa " . 
					"ON pa.ParticipantID = pp.ParticipantID " . 
					"LEFT JOIN Events ev " . 
					"ON ev.EventID = pp.EventID " . 
					"WHERE pa.InstitutionID = $institutionID AND ev.AcademicYear = $academicYear";
	}
	elseif ($institutionID != "All" && $hostID != "All") {
		$query = "SELECT * FROM Participations pp " . 
					"LEFT JOIN Participants pa " . 
					"ON pa.ParticipantID = pp.ParticipantID " . 
					"LEFT JOIN Events ev " . 
					"ON ev.EventID = pp.EventID " . 
					"WHERE pa.InstitutionID = $institutionID AND ev.HostID = $hostID";
	}
	elseif ($eventID != "All" && $academicYear != "All") {
		$query = "SELECT * FROM Participations pp " .  
					"LEFT JOIN Events ev " . 
					"ON ev.EventID = pp.EventID " . 
					"WHERE ev.EventID = $eventID AND ev.AcademicYear = $academicYear";
	}
	elseif ($eventID != "All" && $hostID != "All") {
		$query = "SELECT * FROM Participations pp " .  
					"LEFT JOIN Events ev " . 
					"ON ev.EventID = pp.EventID " . 
					"WHERE ev.EventID = $eventID AND ev.HostID = $hostID";
	}
	elseif ($academicYear != "All" && $hostID != "All") {
		$query = "SELECT * FROM Participations pp " .  
					"LEFT JOIN Events ev " . 
					"ON ev.EventID = pp.EventID " . 
					"WHERE ev.AcademicYear = $academicYear AND ev.HostID = $hostID";
	}
	// 4 choose 1
	elseif ($institutionID != "All") {
		$query = "SELECT * FROM Participations pp " . 
					"LEFT JOIN Participants pa " . 
					"ON pa.ParticipantID = pp.ParticipantID " . 
					"WHERE pa.InstitutionID = $institutionID";
	}
	elseif ($eventID != "All") {
		$query = "SELECT * FROM Participations pp " . 
					"LEFT JOIN Events ev " . 
					"ON ev.EventID = pp.EventID " . 
					"WHERE ev.EventID = $eventID";
	}
	elseif ($academicYear != "All") {
		$query = "SELECT * FROM Participations pp " . 
					"LEFT JOIN Events ev " . 
					"ON ev.EventID = pp.EventID " . 
					"WHERE ev.AcademicYear = $academicYear";
	}
	elseif ($hostID != "All") {
		$query = "SELECT * FROM Participations pp " . 
					"LEFT JOIN Events ev " . 
					"ON ev.EventID = pp.EventID " . 
					"WHERE ev.HostID = $hostID";
	}
	return $query;
}
?>