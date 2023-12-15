<?php
//start the session
session_start();
if(!isset($_SESSION['user'])) header('location: login.php');

//Get graph data- purchase order by status
include('database/po_status_pie_graph.php');
//Get graph data- supplier product count
include('database/supplier_product_bar_graph.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS Dashboard-Inventory Management System</title>
    <link rel="stylesheet" href="css/login.css">   
</head>
<body>
    <div id="dashboard_MainContainer">
            <?php include('partials/app-sidebar.php') ?>
       
        <div class="dashboard_content_container" id = "dashboard_content_container">
        <?php include('partials/app-topNav.php') ?>
            <div id="reportsContainer">
                <div class="reportTypeContainer">
                <div class="reportType">
                <p>Export Products</p>
                <div class="alignRight">
                <a href="database/report_csv.php?report=product" class="reportExportBtn">Excel</a>
                 <a href="database/report_pdf.php?report=product"class="reportExportBtn">PDF</a>
                </div>
                 </div>
                <div class="reportType">
                <p>Export Suppliers</p>
                <div class="alignRight">
                <a href="database/report_csv.php?report=supplier" class="reportExportBtn">Excel</a>
                 <a href=""class="reportExportBtn">PDF</a>
                </div>
                 </div>
                </div>
                
                <div class="reportTypeContainer">
                <div class="reportType">
                <p>Export Deliveries</p>
                <div class="alignRight">
                <a href="" class="reportExportBtn">Excel</a>
                 <a href="database/report_csv.php" class="reportExportBtn">PDF</a>
                </div>
                 </div>
                <div class="reportType">
                <p>Export Purchase Order</p>
                <div class="alignRight">
                <a href="" class="reportExportBtn">Excel</a>
                 <a href="database/report_csv.php"class="reportExportBtn">PDF</a>
                </div>
                 </div>
                </div>
                
                
                </div>    
                </div>
                </div>  
            </div>        
        </div>
    </div>
    <script src="js/script.js"> </script>
    
       