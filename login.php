<?php
session_start();
if(isset($_SESSON['user'])) header('location: dashboard.php');

$error_message = "";

if($_POST){
    include('database/connection.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    $query = 'SELECT * FROM user WHERE user.email="'. $username.'" AND user.password="'. $password.'"LIMIT 1';
    $stmt = $conn->prepare($query);
     $stmt -> execute();

     if($stmt -> rowCount() > 0){
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetchAll()[0];

        //capture data of currently login users
        $_SESSION['user'] = $user;

        header('Location: dashboard.php');
     } else $error_message = 'please make sure your username and password are correct.';
            
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS Login-Inventory Management System</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body id="loginBody">
    <div id="errorMessage">
        <?php
        if(!empty($error_message)){ ?>
        <strong>Error:</strong><p><?= $error_message ?></p>
    </div>
    <?php } ?>
    <div class="blur"></div>
    <div class="container">
        <div class="loginHeader">
            <h1>IMS</h1>
            <p>Inventory Management System</p>
        </div>
        <div class="loginBody">
            <form action="login.php" method ="POST">
                <div class="loginInputContainer">
                    <label for="">Username</label>
                    <input type="text" name="username" placeholder="username">
                </div>
                <div class="loginInputContainer">
                    <label for="">Password</label>
                    <input type="password" name="password" placeholder="password">
                </div>
                <div class="loginButtonContainer">
                    <button>login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>