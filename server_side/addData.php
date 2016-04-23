<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_POST['']))
$query  = "SELECT * FROM Institutions";
$result = $conn->query($query);
if (!$result) 
    die ("Database access failed: " . $conn->error);

?>