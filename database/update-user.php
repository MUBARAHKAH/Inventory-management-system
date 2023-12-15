<?php
$data = $_POST;
$user_id= (int)$data['userId'];
$first_Name= $data['f_name'];
$last_Name= $data['l_name'];
$email = $data['email'];



try{
$sql = "UPDATE user SET email=?, first_Name=?, last_Name=?, updated_at=? WHERE id=?";

    //Adding the record
include('connection.php');

$conn->prepare($sql)->execute([$email, $first_Name, $last_Name, date('Y-m-d H:i:s'), $user_id]);

//$conn->exec($command);

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