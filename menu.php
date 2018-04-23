<?php require 'session.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel Power-Timisha  |Our Menu</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <style type="text/css">.focus {
  background-color: #ff00ff;
  color: #fff;
  cursor: pointer;
  font-weight: bold;
}
.pageNumber {
  padding: 2px;
}</style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include 'header.php';?>
  <!-- Left side column. contains the logo and sidebar -->
<?php include 'aside.php';?>  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bar & Restaurant Menu
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Menu</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">
      <div class="col-md-12">
        <?php
            if (isset($_GET['err'])) {
              echo '<div class="alert alert-danger alert-dismissible" style="text-align:center;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                '.$_GET['err'].'
              </div>';
            }
             if (isset($_GET['msg'])) {
              echo '<div class="alert alert-success alert-dismissible" style="text-align:center;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Information!</h4>
                '.$_GET['msg'].'
              </div>';
            }


             ?>
</div>
 <div class="col-md-5">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Menus</h3>
              <button class="btn btn-success fa fa-plus pull-right"  data-toggle="modal" data-target="#modal-default"> <small>Add Menu</small></button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover" id="example1">
                <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $menu_sql="SELECT * FROM menu";
                $menu_query=mysqli_query($con,$menu_sql);
                if (mysqli_num_rows($menu_query)>0) {
                  $i=1;
                  while ($m_row=mysqli_fetch_array($menu_query)) {
                    echo '<tr>
                  <td>'.$i++.'.</td>
                  <td>'.$m_row['name'].'</td>
                    <td>
                   <button class="btn btn-primary" onclick="showmenu('.$m_row['id'].')"><i class="fa fa-eye"></i> Expand</button>
                    <button class="btn btn-success" onclick="editmenu('.$m_row['id'].')"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-danger" onclick="delmenu('.$m_row['id'].')"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>';
                  }
                 }else{
                  echo '<tr><td colspan="3"> Not Menus</td></tr>';
                 } 
                
                ?>
               </tbody> 
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            </div>
          </div>
          <!-- /.box -->

         
        </div>
<div class="col-md-7">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Menus Items for<small id="menu_name"></small></h3>
              <button class="btn btn-primary fa fa-plus pull-right"  data-toggle="modal" data-target="#additem"> <small>Add Menu Items</small></button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Action</th>
                </tr>
                </thead>
                   <tbody id="q_results"></tbody>
               
              </table>
            </div>
           
     </div>
 </div>    

    </section>
    <!-- /.content -->
  </div>
  <div class="modal fade" id="modal-default">
          <div class="modal-dialog" style="width: 1000px;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Menu </h4>
              </div>
              <div class="modal-body">
              <div class="col-md-12">
              <form method="POST" action="addmenu.php">  
                <div class="form-group col-md-6">
                <input type="text" name="name"  class="form-control" placeholder="Menu Name">
              </div>
               <div class="form-group col-md-6">
                <button class="btn btn-success"> Save Item</button>
              </div>
              </form>
              </div>
              
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

   <div class="modal fade" id="edit_menu">
          <div class="modal-dialog" style="width: 1000px;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Menu </h4>
              </div>
              <div class="modal-body">
              <div class="col-md-12">
              <form method="POST" action="updatemenu.php">  
                <div class="form-group col-md-6">
                <input type="text" name="name"  class="form-control" placeholder="Menu Name" id="_name">
                <input type="hidden" name="menu_id" id="menu_id">
              </div>
               <div class="form-group col-md-6">
                <button class="btn btn-success"> Update Menu</button>
              </div>
              <p><strong>Note:</strong> For Any long Name add this <<code>br</code>>  in between the words</p>
              </form>
              </div>
              
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>       

  <div class="modal fade" id="additem">
          <div class="modal-dialog" style="width: 1000px;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Menu Item </h4>
              </div>
              <div class="modal-body">
              <div class="col-md-12">
              <form method="POST" action="addmenuitem.php">  
                <div class="form-group col-md-4">
                <input type="text" name="name"  class="form-control" placeholder="Item Name">
              </div>
              <div class="form-group col-md-4">
                <input type="text" name="description"  class="form-control" placeholder="Description">
              </div>
              <div class="form-group col-md-4">
                <input type="text" name="price"  class="form-control" placeholder="Price">
              </div>
              <div class="form-group col-md-4">
                Select Main Menu Category
                <SELECT class="form-control" name="menu_id">
                <?php
                $m_sql="SELECT * FROM menu ORDER BY name ASC";
                $m_query=mysqli_query($con,$m_sql);
                if (mysqli_num_rows($m_query)>0) {
                  $i=1;
                  while ($me_row=mysqli_fetch_array($m_query)) {
                echo '<option value="'.$me_row['id'].'">'.$me_row['name'].'</option>';
                  }
                 }else{
                echo '<option disabled="">No Menues Found</option>';
                 }
                
                ?>
              </SELECT>
              </div>
                  <div class="form-group col-md-4">
                Select Item Code If Applicable
                <SELECT class="form-control" name="item_code">
                <?php
                $p_sql="SELECT * FROM products ORDER BY name ASC";
                $p_query=mysqli_query($con,$p_sql);
                if (mysqli_num_rows($p_query)>0) {
                  echo '<option value="">Select If Applys</option>';
                  $i=1;
                  while ($pdt_row=mysqli_fetch_array($p_query)) {
                echo '<option value="'.$pdt_row['item_code'].'">'.$pdt_row['name'].'</option>';
                  }
                 }else{
                echo '<option disabled="">No Menues Found</option>';
                 }
                
                ?>
              </SELECT>
              </div>
                <div class="form-group col-md-4">
                Select Department
                <SELECT class="form-control" name="dept">
                <?php
                $d_sql="SELECT * FROM departments ORDER BY name ASC";
                $d_query=mysqli_query($con,$d_sql);
                if (mysqli_num_rows($d_query)>0) {
                  echo '<option value="" disabled="">Department</option>';
                  $i=1;
                  while ($dept_row=mysqli_fetch_array($d_query)) {
                echo '<option value="'.$dept_row['id'].'">'.$dept_row['name'].'</option>';
                  }
                 }else{
                echo '<option disabled="">No Dept Found</option>';
                 }
                
                ?>
              </SELECT>
              </div>
              <div class="form-group col-md-4">
                <br>
                <button class="btn btn-success">Save Menu Item</button>
              </div>
              </form>
              </div>
              
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>


          <div class="modal fade" id="edit_item">
          <div class="modal-dialog" style="width: 1000px;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Menu Item </h4>
              </div>
              <div class="modal-body">
              <div class="col-md-12">
              <form method="POST" action="updatemenuitem.php">  
                <div class="form-group col-md-4">
                <input type="text" name="name"  class="form-control" placeholder="Item Name" id="_item">
              </div>
              <div class="form-group col-md-4">
                <input type="text" name="description"  class="form-control" placeholder="Description" id="desc">
              </div>
              <div class="form-group col-md-4">
                <input type="text" name="price"  class="form-control" placeholder="Price" id="price">
                <input type="hidden" name="id" id="item_id">
              </div>
             
              <div class="form-group col-md-4">
                <br>
                <button class="btn btn-success">Update Menu Item</button>
              </div>
              </form>
              </div>
              
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>





  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2014-<?php echo date("Y");?> <a href="https://adminlte.io">Jotechnologies Uganda</a>.</strong> All rights
    reserved.
  </footer>

<?php  include 'control.php';?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="actions/users.js"></script>
<script>


function showmenu(q){
 $.ajax({
            type: 'POST',
            url: 'getmenuitems.php',
            data: 'q='+q,
            dataType: 'html',
            cache: false,
            success: function(result) {
                //$('#content1').html(result[0]);
             
             document.getElementById("q_results").innerHTML=result;
               
            },
        });

    
  
}

function editmenu(q){
   $('#edit_menu').modal('show');
 $.ajax({
            type: 'POST',
            url: 'getmenu.php',
            data: 'q='+q,
            dataType: 'json',
            cache: false,
            success: function(result) {
                $('#menu_id').val(result['id']);
               document.getElementById('_name').value=result[1];
             
               
            },
        });

    
  
}


function edititem(q){
   $('#edit_item').modal('show');
 $.ajax({
            type: 'POST',
            url: 'getitem.php',
            data: 'q='+q,
            dataType: 'json',
            cache: false,
            success: function(result) {
                $('#item_id').val(result['id']);
               document.getElementById('_item').value=result['name'];
               document.getElementById('desc').value=result['description'];
               document.getElementById('price').value=result['price'];
             
               
            },
        });

    
  
}


function delmenu(q){
  var r=confirm("WARNING!!!!\n Are You Sure You Want to remove This Menu and its Items ?");

  if (r==true) {
 $.ajax({
            type: 'POST',
            url: 'deletemenu.php',
            data: 'q='+q,
            dataType: 'html',
            cache: false,
            success: function(result) {
               // window.location.reload();
               var p =confirm(result);
               if (p==true) {
                window.location.reload();
              }else{
                window.location.reload();
              }
                
        
            },
              
        });
}
    
  
}
function deleteItem(q){
  var r=confirm("WARNING!!!!\n Are You Sure You Want to remove This Menu Item ?");

  if (r==true) {
 $.ajax({
            type: 'POST',
            url: 'deletemenuitem.php',
            data: 'q='+q,
            dataType: 'html',
            cache: false,
            success: function(result) {
               // window.location.reload();
               var p =confirm(result);
               if (p==true) {
                window.location.reload();
              }else{
                window.location.reload();
              }
                
        
            },
              
        });
}
    
  
}



  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
