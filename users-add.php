<?php
//start the session
session_start();
if(!isset($_SESSION['user'])) header('location: login.php');
$_SESSION['table'] = 'user';
$_SESSION['redirect_to'] = 'users-add.php';
$user = ($_SESSION['user']);

$show_table = 'user';
$users = include('database/show.php');
?>
<!--the html-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User-Inventory Management System</title>
    
    <?php include('partials/app-header-script.php'); ?>
</head>
<body>
<div id="dashboard_MainContainer">
        <?php include('partials/app-sidebar.php') ?>
    <div class="dashboard_content_container" id = "dashboard_content_container">
        <?php include('partials/app-topNav.php') ?>
        <div class="dashboard_content">
        <div class="dashboard_content_main">
            <div class="row">
             <div class=" column column-12">
                <h1 class="section_header"><i class="fa fa-plus"></i>Create User</h1>
                <div id="userAddFormContainer">
                    <form action="database/add.php" method = "POST" class="appForm">
                        <div class="appFormInputContainer">
                            <label for="first_name">First Name</label>
                            <input type="text" id ="first_name" name="first_Name"  class = "appFormInput"/>
                        </div>

                        <div class="appFormInputContainer">
                            <label for="last_name">Last Name</label>
                            <input type="text" id ="last_name" name="last_Name" class = "appFormInput"/>
                        </div>

                        <div class="appFormInputContainer">
                            <label for="email">E-mail</label>
                            <input type="email" id ="email" name="email" class = "appFormInput"/>
                        </div>

                        <div class="appFormInputContainer">
                            <label for="password">Password</label>
                            <input type="password" id ="password" name="password" class = "appFormInput"/>
                        </div>
                      <button type="submit" class = "appBtn"><i class="fa fa-plus"></i>Add User</button>
                    </form>
                    <?php if(isset($_SESSION['response'])){
                    $response_message = $_SESSION['response']['message'];
                    $is_success = $_SESSION['response']['success'];
                    ?>
                    <div class="responseMessage">
                        <p class="responseMessage <?= $is_success ? 'responseMessage_success' : 'responseMessage_error'?>" >
                            <?= $response_message ?>
                    </p>
                    </div>
                    <?php unset($_SESSION['response']); } ?>
              </div>
           </div>
             
        </div>  
    </div>
                    </div>
</div>
<?php include('partials/app-scripts.php'); ?>
</body>
</html>