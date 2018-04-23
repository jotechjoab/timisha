<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php if (isset($info)) {echo $info['avater_path'];
              } ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php if (isset($info)) {echo $info['fname'].' '.$info['lname'];
              } ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
          <li class="active">
          <a href="home.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
      <?php   

      //  print_r($paths);
       if(in_array('bar',$paths,true) || in_array('all_routes',$paths,true)){  
       echo ' 
        <li class="treeview">
          <a href="#">
            <i class="fa  fa-glass"></i>
            <span>Bar & Restaurant</span>
            <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="order.php"><i class="fa fa-circle-o"></i> Orders</a></li>
            <li><a href="myorders.php"><i class="fa fa-circle-o"></i> My Orders</a></li>
            <li><a href="stock_request.php?dept=1"><i class="fa fa-circle-o"></i>Stock Requests</a></li>
            <li><a href="view_sr.php?dept=1."><i class="fa fa-circle-o"></i>View Requests</a></li>
            <li><a href="menu.php"><i class="fa fa-circle-o"></i> Menu</a></li>
            <li><a href="viewstock.php"><i class="fa fa-circle-o"></i> View Stock</a></li>
            <li><a href="view_daily_stock_sold.php"><i class="fa fa-circle-o"></i> View Sold Stock</a></li>
            <li><a href="ind_sales.php"><i class="fa fa-circle-o"></i> My Sales</a></li>
            <li><a href="unpaid.php"><i class="fa fa-circle-o"></i> Clear UnPaid </a></li>
             <!-- <li><a href="ind_receipts.php"><i class="fa fa-circle-o"></i> My Receipts</a></li>-->
              <li><a href="places.php"><i class="fa fa-circle-o"></i> Places</a></li>
           
          </ul>
        </li>';
      }
?>
<?php
                // print_r($paths);
        if(in_array('rooms',$paths,true) || in_array('all_routes',$paths,true)){
       echo ' <li class="treeview">
          <a href="#">
            <i class="fa  fa-bed"></i>
            <span>Rooms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="check_rooms.php"><i class="fa fa-circle-o"></i> Room Checks </a></li>
            <li><a href="ind_receipts.php"><i class="fa fa-circle-o"></i> My Receipts</a></li>
            <li><a href="rooms.php"><i class="fa fa-circle-o"></i> Rooms</a></li>
            <li><a href="room_status.php"><i class="fa fa-circle-o"></i> Room Status</a></li>
            <li><a href="guests.php"><i class="fa fa-circle-o"></i> Guests</a></li>
            <!--<li><a href="#"><i class="fa fa-circle-o"></i> Store Requests</a></li>-->
            <!--<li><a href="#"><i class="fa fa-circle-o"></i> Resourses</a></li>-->
          </ul>
        </li>';

      }

                // print_r($paths);
   if(in_array('kitchen',$paths,true) || in_array('all_routes',$paths,true)){
      echo '  <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Kitchen</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="view_kitorders.php"><i class="fa fa-circle-o"></i> View Orders</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Store Requests</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Resourses</a></li>
          </ul>
        </li>';

      }

     // print_r($paths);
      if(in_array('store',$paths,true) || in_array('all_routes',$paths,true)){
       echo ' <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Store & Inventory </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="products.php"><i class="fa fa-circle-o"></i> Products</a></li>
            <li><a href="inventory.php"><i class="fa fa-circle-o"></i> Inventory</a></li>
            <li><a href="approve_sr.php"><i class="fa fa-circle-o"></i> Stock Requests</a></li>
            <li><a href="po.php"><i class="fa fa-circle-o"></i> Purchase Order</a></li>
            <li><a href="view_po.php"><i class="fa fa-circle-o"></i> View P O</a></li>
            <li><a href="suppliers.php"><i class="fa fa-circle-o"></i> Suppliers</a></li>
            <li><a href="dept.php"><i class="fa fa-circle-o"></i> Departments</a></li>
          </ul>
        </li>';
      }
                // print_r($paths);
      if(in_array('accounts',$paths,true) || in_array('all_routes',$paths,true)){
      echo '     <li class="treeview">
          <a href="#">
            <i class="fa  fa-laptop"></i>
            <span>Accounts</span>
            <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="acc_categories.php"><i class="fa fa-circle-o"></i>Accounts Categories</a></li>
            <li><a href="accounts.php"><i class="fa fa-circle-o"></i> Account</a></li>
           
          </ul>
        </li>';}
      if(in_array('hr',$paths,true) || in_array('all_routes',$paths,true)){
      echo '  
           <li class="treeview">
          <a href="#">
            <i class="fa  fa-users"></i>
            <span>Human Resource Mgt</span>
            <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Employees</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Payrols</a></li>
           
          </ul>
        </li>';}
        if(in_array('accounts',$paths,true) || in_array('all_routes',$paths,true)){
      echo '
           <li class="treeview">
          <a href="#">
            <i class="fa fa-suitcase"></i> <span>Administration </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="sales.php"><i class="fa fa-circle-o"></i> Sales Report</a></li>
            <li><a href="receipts.php"><i class="fa fa-circle-o"></i> Reciepts Report</a></li>
             <li><a href="expenditures.php"><i class="fa fa-circle-o"></i> Expenditures</a></li>
            <li><a href="balancesheet.php"><i class="fa fa-circle-o"></i> Income & Expenditure </a></li> 
            <li><a href="admin_po.php"><i class="fa fa-circle-o"></i> Approve PO</a></li>
            <li><a href="bar.php"><i class="fa fa-circle-o"></i> Bar</a></li>
            <li><a href="room_rec.php"><i class="fa fa-circle-o"></i> Rooms</a></li>
            <li><a href="food.php"><i class="fa fa-circle-o"></i> Restaurant</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Quotations</a></li>
          </ul>
        </li>
        ';}
      echo'  
        <li><a href="#"><i class="fa fa-book"></i> <span>Help</span></a></li>
        <li class="header">System Settings</li>';
     if(in_array('admin',$paths,true) || in_array('all_routes',$paths,true)){
      echo '   
         <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>User Management </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="users.php"><i class="fa fa-circle-o"></i> Users </a></li>
            <li><a href="permisions.php"><i class="fa fa-circle-o"></i> Permissions</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> User Logs</a></li>
          </ul>
        </li>';}
        ?>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>