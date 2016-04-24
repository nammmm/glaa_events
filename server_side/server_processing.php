<?php 
require_once 'login.php';
require_once 'helper.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

// $table = sanitizeMySQL($conn, $_POST['table']);
$table = "Institutions";

$query  = "SELECT * FROM " . $table;
$result = $conn->query($query);
if (!$result)
    die ("Database access failed: " . $conn->error);

// $boxes = array();
$data = array();
foreach ($result as $row ) {
	// $boxes[] = array("empty" => "");
    $data[] = $row;
}

// $draw = $_POST["draw"];
$recordsTotal = count($data);
$recordsFiltered = $recordsTotal;
// for ($j = 0 ; $j < $rows ; ++$j)
// {
//     $result->data_seek($j);
//     $row = $result->fetch_array(MYSQLI_ASSOC);
// }

$response = array(
	"recordsTotal" => $recordsTotal,
	"recordsFiltered" => $recordsFiltered,
	"data" => $data
);
echo json_encode($data);

$result->close();
$conn->close();
?>