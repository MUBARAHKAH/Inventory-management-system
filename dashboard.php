<?php
//start the session
session_start();
if(!isset($_SESSION['user'])) header('location: login.php');
$user = ($_SESSION['user']);

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
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <div class="col-50">
                    <figure class="highcharts-figure">
                    <div id="container"></div>
                    <p class="highcharts-description">
                        Here is the breakdown of the purchase orders by status
                    </p>
                    </figure>
                    </div>
                    <div class="col-50">
                    <!-- <figure class="highcharts-figure">
                    <div id="containerBarChart"></div>
                    <p class="highcharts-description">
                        Here is the breakdown of product count for each supplier.
                    </figure> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/script.js"> </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        var graphData = <?= json_encode($results)?>;
        
        Highcharts.chart('container', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Purchase Orders By status'
        },
        tooltip: {
            valueSuffix: '%'
        },
        plotOptions: {
            series: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: [{
                    enabled: true,
                    distance: 20
                }, {
                    enabled: true,
                    distance: -40,
                    format: '{point.percentage:.1f}%',
                    style: {
                        fontSize: '1.2em',
                        textOutline: 'none',
                        opacity: 0.7
                    },
                    filter: {
                        operator: '>',
                        property: 'percentage',
                        value: 10
                    }
                }]
            }
        },
        series: [
            {
                name: 'Percentage',
                colorByPoint: true,
                data: <?=json_encode($results)?>
            }
        ]
        });

        var barGraphData = <?= json_encode($bar_chart_data)?>;
        var barGraphCategories = <?= json_encode($categories)?>;
        

        console.log(barGraphCategories,barGraphData)
        Highcharts.chart('containerBarChart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Product Count Assigned to Supplier',
        align: 'left'
    },
    xAxis: {
        categories: barGraphCategories,
        crosshair: true,
        accessibility: {
            description: 'Countries'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Product Count'
        }
    },
    tooltip: {
        valueSuffix: ' (1000)'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Suppliers',
            data: barGraphData
        }
    ]
});

</script>
</body>
</html>