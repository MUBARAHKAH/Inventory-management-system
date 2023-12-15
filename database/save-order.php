<?php
session_start();

$post_data = $_POST;
$products = $post_data['products'];
$count = count($products);
// $qty = array_values($post_data['quantity']);
// print_r($products);
// print_r($qty);



$post_data_arr = [];

include('connection.php');


$batch = time();

$success= false;
try {
    //code...
    for($i = 0; $i<$count; $i++){
       $sid = 4;
       $quantity_received = 0;
       $quantity_remaining = 0;
            //Insert to database.
            $values = [$sid, $post_data['products'][$i], $post_data['quantity'][$i],$quantity_received, $quantity_remaining, 'pending', $batch, $_SESSION['user']['id'], date('Y-m-d H:i:s'), date('Y-m-d H:i:s')
    ];
                    
         $sql = "INSERT INTO order_product
        (supplier, product, quantity_ordered, quantity_received, quantity_remaining, status, batch, created_by, updated_at, created_at)
           VALUES
         (?, ?, ?, ?, ?, ?, ?, ?,?,?)";
    
        $stmt = $conn->prepare($sql);
        $stmt->execute($values);
      
        }

$success = true;
$message = 'order successfully created!';
} catch (\Exception $e) {
    $message = $e->getMessage();
}
$_SESSION['response'] =[
    'message' => $message,
    'success' => $success
];

header('location: ../product-order.php');