<?php
require_once 'login.php';
require_once 'helper.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_POST['table'])) {
	$table = sanitizeMySQL($conn, $_POST['table']);
	$rows = $_POST['rows'];
	$query = "";
	$msg = "success";

	switch ($table) {
		case 'Institutions':
			foreach ($rows as $row) {
				$query = "DELETE FROM Institutions " . 
						"WHERE InstitutionID = $row[1]";
				$result = $conn->query($query);
				if (!$result) {
					$msg = "$conn->error";
					break;
				}
			}
			break;
		case 'Participants':
			foreach ($rows as $row) {
				$query = "DELETE FROM Participants " . 
						"WHERE ParticipantID = $row[1]";
				$result = $conn->query($query);
				if (!$result) {
					$msg = "$conn->error";
					break;
				}
			}
			break;
		case 'Events':
			foreach ($rows as $row) {
				$query = "DELETE FROM Events " . 
						"WHERE EventID = $row[1]";
				$result = $conn->query($query);
				if (!$result) {
					$msg = "$conn->error";
					break;
				}
			}
			break;
		case 'Participations':
			foreach ($rows as $row) {
				$query = "DELETE FROM Participations " . 
						"WHERE ParticipantID = $row[1] AND EventID = $row[4]";
				$result = $conn->query($query);
				if (!$result) {
					$msg = "$conn->error";
					break;
				}
			}
			break;
		default:
			break;
	}

	echo $msg;
}
$conn->close();
?>