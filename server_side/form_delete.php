<?php
require_once 'login.php';
require_once 'helper.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$conn->set_charset('utf8mb4');

if (isset($_POST['form'])) {
	$form = sanitizeMySQL($conn, $_POST['form']);
	$rows = $_POST['rows'];
	$query = "";
	$msg = "success";

	switch ($form) {
		case '#institutionForm':
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
		case '#participantForm':
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
		case '#eventForm':
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
		case '#participationByPaForm':
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

	$result->close();
	$conn->close();
}
?>