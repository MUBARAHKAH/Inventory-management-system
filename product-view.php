<?php
//start the session
session_start();
if(!isset($_SESSION['user'])) header('location: login.php');

//Get all product
$show_table = 'products';
$products = include('database/show.php');


?>
<!--the html-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products-Inventory Management System</title>
    
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
             <div class="column column-12">
                <h1 class="section_header"><i class="fa fa-list"></i>List of Products</h1>
                <div class="section_content">
                    <div class="users">
                    <table>
                    <table>
                        <tr>
                         <th>#</th>
                           <th>img</th> 
                           <th>product_Name</th> 
                           <th>stock</th>
                           <th width="20%">description</th> 
                           <th width= "15%">Suppliers</th> 
                           <th> created_by</th>
                           <th>created_at</th>
                           <th>updated_at</th>
                           <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $index => $product){ ?>
                                <tr>
                                <td><?= $index + 1 ?></td>
                                <td class="img">
                                <img class= "productImages" src="uploads/products/<?=$product['img'] ?>" alt=""/>
                                </td>
                                <td class="last_Name"><?= $product['product_name'] ?></td>
                                <td class="last_Name"><?= intval(['stock']) ?></td>
                                <td class="email"><?= $product['description']?></td>
                                <td class="email">
                                    <?php
                                        $supplier_list = '.';
                                         $pid = $product['id'];
                                         $stmt = $conn->prepare(
                                            "SELECT supplier_name FROM suppliers, productsuppliers 
                                            WHERE 
                                            productsuppliers.product=$pid
                                            AND
                                            productsuppliers.supplier = suppliers.id
                                            ");
                                         $stmt -> execute();
                                         $row = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                                         if($row){
                                            $supplier_arr = array_column($row, 'supplier_name');
                                            $supplier_list = '<li>'.implode("</li><li>", $supplier_arr);
                                         }
                                            echo $supplier_list;
                                ?>
                                </td>
                                
                                <td>
                                <?php
                                    $uid = $product['created_by'];
                                    $stmt = $conn->prepare("SELECT * FROM user WHERE id=$uid");
                                    $stmt -> execute();
                                    $row = $stmt -> fetch(PDO::FETCH_ASSOC);
                                    $created_by_name = $row['first_Name'] . '' . $row['last_Name'];
                                    echo $created_by_name;               
                                ?>
                                </td>
                                <td><?= $product['created_by'] ?> </td>
                                <td><?= date('M d, Y, @ h:i:s A', strtotime($product['updated_at'])) ?></td>
                                <td>
                                 <a href="" class="updateProduct" data-pid="<?=$product['id'] ?>"><i class="fa fa-pencil"></i>Edit</a>
                                 <a href="" class="deleteProduct" data-name="<?=$product['product_name']?>" data-pid="<?=$product['id'] ?>"> <i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                </td>
                                </tr>
                                    <?php } ?>          
                        </tbody> 
                    </table>
                    <p class="userCount"><?=count($products)?>products</p>
                    </div>
                </div>
                </div>
            </div>
        </div>  
    </div>
                    </div>
</div>

<?php 
include('partials/app-scripts.php');                 


    $show_table = 'suppliers';
    $suppliers = include('database/show.php');

    $suppliers_arr = [];
    foreach($suppliers as $supplier){
        $suppliers_arr[$supplier['id']] = $supplier['supplier_name'];
    }
    $suppliers_arr = json_encode($suppliers_arr);  
?>
<script>
    var supplierlist = <?= $suppliers_arr ?>;
   
    function script(){

        var vm = this;

            this.registerEvents = function(){   
               document.addEventListener('click', function(e){
                    targetElement = e.target; //target element
                    classList = targetElement.classList;
                    
                    if(classList.contains('deleteProduct')){
                         e.preventDefault(); //it prevent the default mechanism
                        pId = targetElement.dataset.pid;
                        pName = targetElement.dataset.name;

                            BootstrapDialog.confirm({
                            type: BootstrapDialog.TYPE_DANGER,
                            title: 'Delete product',
                            message: 'Are you sure to delete <strong>'+ pName +'</strong>?',
                            callback: function(isDelete){
                                if(isDelete){
                                $.ajax({
                                method: 'POST',
                                data: {
                                    id: pId,
                                    table: 'products'
                                },
                                url: 'database/delete.php',
                                dataType: 'json',
                                success: function(data){
                                    message = data.success ?
                                    pName + 'successfully deleted!' : 'Error processing your request!';

                                    BootstrapDialog.alert({
                                            type: data.success ? BootstrapDialog.TYPE_SUCCESS : BootstrapDialog.TYPE_DANGER,
                                            message: message,
                                            callback: function(){
                                                if(data.success) location.reload();
                                            }
                                        });
                                }
                            });

                            }
                        }
                        })
                        
                }
                
                if(classList.contains("updateProduct")){
                    e.preventDefault(); //it prevent the default mechanism
                        pId = targetElement.dataset.pid;
                        vm.showEditDialog(pId);
                }
                    });

                document.addEventListener('submit', function(e){
                   e.preventDefault();
                   targetElement = e.target;

                   if(targetElement.id === 'editProductForm'){
                        vm.saveUpdatedData(targetElement);
                   }
                })

                },
    
    this.saveUpdatedData = function(form){
        $.ajax({
            method: 'POST',
            data: new FormData(form),
            url: 'database/update-product.php',
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data){
                BootstrapDialog.alert({
                  type: data.success ? BootstrapDialog.TYPE_SUCCESS : BoostrapDialog.TYPE_DANGER,
                  message: data.message,
                  callback: function(){
                    if(data.success) location.reload();
                  }
                })
            }
        });
    },
           

    this.showEditDialog = function(id){
       $.get('database/get-product.php', {id: id}, function(productDetails){
        let curSuppliers = productDetails['suppliers'];
        let supplierOption = '';

        for(const [supId, supName] of Object.entries(supplierList)) {
            selected = curSuppliers.indexOf(supId) > -1 ? 'selected' : '';
            supplierOption += "<option"+ selected +" value='"+ supId +"'>"+ supName +"</option>";
        }
      

BootstrapDialog.confirm({
title: 'Update <strong>' + productDetails.product_name + '</strong>',
message: '<form action="database/add.php" method = "POST" enctype="multipart/form-data" id ="editProductForm">\
    <div class="appFormInputContainer">\
    <label for="product_name">Product Name</label>\
    <input type="text" id ="product_name" value = "'+productDetails.product_name+'" name="product_name"  placeholder= "Enter product_name..." class = "appFormInput">\
</div>\
    <div class="appFormInputContainer">\
    <label for="description">Suppliers</label>\
    <select name="suppliers[]" id="suppliersSelect" multiple="">\
    <option value="">Select Supplier</option>\
        '+  supplierOption +'\
        </select>\
        </div>\
<div class="appFormInputContainer">\
    <label for="description">Description</label>\
    <textarea id ="description" placeholder ="Enter product_description..." value="'+productDetails.description+'" name="description" class ="appFormInput productTextAreaInput"> '+productDetails.description+'</textarea>\
</div>\
<div class="appFormInputContainer">\
    <label for="product_name">Product Images</label>\
    <input type="file"  name="img"/>\
</div>\
<input type="hidden" name="pid" value="'+productDetails.id+'"/>\
<input type="submit" value="submit" id="editProductSubmitBtn" class="hidden"/>\
</form>\
',

callback: function(isUpdate){
            if(isUpdate){
                document.getElementById('editProductSubmitBtn').click()          
    }
}
});

      }, 'json');

},


        this.initialize = function(){
                this.registerEvents();

        }
    }
    var script = new script;
    script.initialize();
</script>
</body>
</html>