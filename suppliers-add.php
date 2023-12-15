<?php
//start the session
session_start();
if(!isset($_SESSION['user'])) header('location: login.php');
$_SESSION['table'] = 'suppliers';
$_SESSION['redirect_to'] = 'suppliers-add.php';
$user = ($_SESSION['user']);
?>
<!--the html-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supplier-Inventory Management System</title>
    
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
                <h1 class="section_header"><i class="fa fa-plus"></i>Create Supplier</h1>
                <div id="userAddFormContainer">
                    <form action="database/add.php" method = "POST" class="appForm" enctype="multipart/form-data">
                        <div class="appFormInputContainer">
                            <label for="supplier_name">Supplier Name</label>
                            <input type="text" id ="supplier_name" name="supplier_name"  placeholder= "Enter supplier name..." class = "appFormInput"/>
                        </div>

                        <div class="appFormInputContainer">
                            <label for="supplier_location">Location</label>
                            <input type = "text" id ="supplier_location" placeholder ="Enter supplier location..." name="supplier_location" class = "appFormInput productTextAreaInput">
                        </div>

                        <div class="appFormInputContainer">
                            <label for="email">Email</label>
                           <input type="text" class="appFormInput" placeholders="Enter supplier mail..." id="email" name= "mail">
                            </div>   
                      <button type="submit" class = "appBtn"><i class="fa fa-plus"></i>Create Supplier</button>
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