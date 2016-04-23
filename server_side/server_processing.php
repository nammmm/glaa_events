<?php 
require_once 'login.php';
require_once 'helper.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$table = sanitizeMySQL($conn, $_POST['table']);

$query  = "SELECT * FROM " . $table;
$result = $conn->query($query);
if (!$result) 
    die ("Database access failed: " . $conn->error);
$data = array();
foreach ($result as $row ) {
    $data[] = $row ;
}
// for ($j = 0 ; $j < $rows ; ++$j)
// {
//     $result->data_seek($j);
//     $row = $result->fetch_array(MYSQLI_ASSOC);
// }

echo json_encode($data);

$result->close();
$conn->close();
?>