<?php
include('connection.php');

$table_name = $show_table;

$stmt = $conn->prepare("SELECT * FROM $table_name ORDER BY created_at DESC");
$stmt -> execute();
$stmt -> setFetchMode(PDO::FETCH_ASSOC);

//$created_by_name = $row['first_Name'] . '' . $row['last_Name'];

return $stmt->fetchAll(); 
