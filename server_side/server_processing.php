<?php
require_once 'helper.php';
if (isset($_POST['file'])) {
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

	$institutionID = $_POST['institution_select'];
	$eventID = $_POST['event_select'];
	$academicYear = $_POST['year_select'];
	$hostID = $_POST['host_select'];

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