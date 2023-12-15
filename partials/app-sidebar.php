<?php
$user = $_SESSION['user'];
?>

            <div class="dashboard_sidebar" id="dashboard_sidebar">
            <h3 class="dashboard_logo" id="dashboard_logo">IMS</h3>
            <div class="dashboard_sidebar_user">
                <img src="./image/user/user-2.png" alt="user image" id="user_image">
                <span><?= $user['first_Name']. ' '.$user['last_Name']?></span>
            </div>
            <!--sidebar-->
            <div class="dashboard_sidebar_menus">
                <ul class="dashboard_menu_lists" style="list-style-type: none;">
                <!--"menuActive-->
                    <li class="liMainMenu"><a href="./dashboard.php" class="liMainMenu_link"><i class="fa fa-dashboard"></i><span class="menuText">Dashboard</span></a></li>
                    <li class="liMainMenu">
                    <li class="liMainMenu"><a href="./report.php" class="liMainMenu_link"><i class="fa fa-file"></i><span class="menuText">Report</span></a></li>
                    <li class="liMainMenu">
                    <!--<a href=""><i class="fa fa-user-plus"></i><span class="menuText">Product Management</span></a>-->
                    <a href="javascript:void(0);" class="showHideSubMenu">    
                    <i class="fa fa-tag showHideSubMenu"></i>
                    <span class="menuText showHideSubMenu">Product</span><i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu"></i>
                    </a>
                    <ul class="subMenus">
                    <li style="list-style-type: none"><a  class="subMenuLink" href="./product-view.php"><i class="fa fa-circle-o"></i>view product</a></li>    
                    <li style="list-style-type: none"><a  class="subMenuLink" href="./product-add.php"><i class="fa fa-circle-o"></i>Add product</a></li>
                    
                    
                    </ul>
                
                </li>
                    <li class="liMainMenu">
                    <!--<a href=""><i class="fa fa-user-plus"></i><span class="menuText">Supplier Management</span></a>-->
                    <a href="javascript:void(0);" class="showHideSubMenu">    
                    <i class="fa fa-truck showHideSubMenu"></i>
                    <span class="menuText showHideSubMenu">Supplier</span><i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu"></i>
                    </a>
                    <ul class="subMenus">
                    <li style="list-style-type: none"><a  class="subMenuLink" href="./suppliers-view.php"><i class="fa fa-circle-o"></i>view Supplier</a></li>    
                    <li style="list-style-type: none"><a  class="subMenuLink" href="./suppliers-add.php"><i class="fa fa-circle-o"></i>Add Supplier</a></li>
                    </ul>
                </li>

                <li class="liMainMenu">
                    <!--<a href=""><i class="fa fa-user-plus"></i><span class="menuText">Supplier Management</span></a>-->
                    <a href="javascript:void(0);" class="showHideSubMenu">    
                    <i class="fa fa-shopping-cart showHideSubMenu"></i>
                    <span class="menuText showHideSubMenu">Purchase order</span><i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu"></i>
                    </a>
                    <ul class="subMenus">
                    <li style="list-style-type: none"><a  class="subMenuLink" href="./product-order.php"><i class="fa fa-circle-o"></i>Create Order</a></li>    
                    <li style="list-style-type: none"><a  class="subMenuLink" href="./view-order.php"><i class="fa fa-circle-o"></i>View Orders</a></li>
                    </ul>
                </li>
                    <li class="liMainMenu showHideSubMenu">
                    <a href="javascript:void(0);" class="showHideSubMenu">    
                    <i class="fa fa-user-plus showHideSubMenu"></i>
                    <span class="showHideSubMenu">User</span><i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu"></i>
                    </a>
                    <ul class="subMenus">
                    <li style="list-style-type: none"><a  class="subMenuLink" href="./users-view.php"><i class="fa fa-circle-o"></i>view users</a></li>    
                    <li style="list-style-type: none"><a  class="subMenuLink" href="./users-add.php"><i class="fa fa-circle-o"></i>Add users</a></li>
                    </ul>
                    </li>
                </ul>
            </div>

        </div>