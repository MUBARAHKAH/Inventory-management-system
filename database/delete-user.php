<?php
$data = $_POST;
$user_id= (int)$data['user_id'];
$first_Name= $data['f_name'];
$last_Name= $data['l_name'];

try{

    $command = "DELETE FROM user WHERE id=($user_id)";
//Adding the record
include('connection.php');

$conn->exec($command);

echo json_encode([
    'success' => true,
    'message' => $first_Name . ' ' . $last_Name . ' Sucessfully deleted'
]);

}  catch (PDOException $e) {
    
echo json_encode([
    'success' => false,
    'message' => 'Error processing your request!'
]);
}