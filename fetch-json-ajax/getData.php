<?php
include('database.php');

$id = $_POST['id'];

// Prepare and execute the SQL query
$sql = "SELECT * FROM student WHERE id = '$id'";
$res = mysqli_query($con, $sql);

// Fetch the first row as an associative array
$row = mysqli_fetch_assoc($res);

// Encode the result as JSON
echo json_encode($row);

?>