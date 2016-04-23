<?php
require_once 'login.php';
require_once 'helper.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_POST['table'])) {
	$table = sanitizeMySQL($conn, $_POST['table']);
	$query = "";
	$data = "";

	switch ($table) {
		case 'Institutions':
			$institutionID = sanitizeMySQL($conn, $_POST['institutionID']);
			$isGLAA = (sanitizeMySQL($conn, $_POST['isGLAA']) == "yes") ? 1 : 0;
			$query = "UPDATE Institutions SET " .
						"IsGLAA = $isGLAA " . 
						"WHERE InstitutionID = $institutionID";
			$result = $conn->query($query);
			if (!$result) 
				echo "$conn->error";
			else {
				$query  = "SELECT * FROM Institutions";
				$result = $conn->query($query);
				$rows = $result->num_rows;
				for ($j = 0 ; $j < $rows ; ++$j) {
				    $result->data_seek($j);
				    $row = $result->fetch_array(MYSQLI_ASSOC);
				    $data .= "<tr>" . 
				    		"<td></td>" . 
				    		"<td>" . $row['InstitutionID'] . "</td>" . 
				    		"<td>" . $row['Institution'] . "</td>";
				    if ($row['IsGLAA'])	$data .= "<td>Yes</td>";
				    else $data .= "<td>No</td>";
				    $data .= "</tr>";
				}
			}
			break;
		default:
			break;
	}

	// echo "$query";
	// $result = $conn->query($query);
	// if (!$result) 
	// 	echo "$conn->error";
	// else
	echo $data;
}
$conn->close();
?>