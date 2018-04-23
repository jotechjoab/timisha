<?php require 'session.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel Power-Timisha  | Inventory</title>
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
        Inventory Item
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inventory Item</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">
       <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Inventory Item </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
              <i class="fa fa-user-plus"></i> Add Inventory Item</button>
            <button type="button" class="btn btn-success">
              <i class="fa fa-print"></i> Print</button>
          </div>
        </div>
        <div class="box-body">
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
             <input type="hidden" name="id" id="id" value="<?php echo $info['id'];?>">
          <table class="table table-bordered table-hover" id="example1">
               <thead>
                 <tr>
                   <th>#</th>
                   <th>Code</th>
                   <th>Name</th>
                   <th>Size</th>
                   <th>Purchased</th>
                   <th>In Store</th>
                   <th>Status</th>
                   <th>Purchase Date</th>
                 </tr>
               </thead>
          <tbody>
          <?php
          
        $sql="SELECT i.id,p.item_code,p.name as pname,p.size,p.unit_of_measure,i.status,i.qty_purchased,i.qty_in_store,i.purchase_date,i.batch_no  FROM products p,inventories i WHERE p.item_code=i.item_code ORDER BY i.created_at DESC ";
        $query=mysqli_query($con,$sql);
        if (mysqli_num_rows($query)>0) {
          $i=1;
       $status="";   
          while ($row=mysqli_fetch_array($query)) {
            if ($row['status']=='Ready') {
       $status='<span class="label bg-green">Ready</span>';
            }else{
       $status='<span class="label bg-red">Under review</span>';       
            }
           echo '
             <tr>
                   <td>'.$i++.'</td>
                   <td>'.$row['item_code'].'</td>
                    <td>'.$row['pname'].'</td>
                   <td>'.$row['size'].'</td>
                   <td>'.$row['qty_purchased'].'</td>
                   <td>'.$row['qty_in_store'].'</td>
                   <td>'.$status.'</td>
                   <td>'.$row['purchase_date'].'</td>
             
                 </tr>

           ';
          }
              
            }else{
              echo mysqli_error($con);
            }    
           
                 ?>
          </tbody>     
          </table>



        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
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
                <h4 class="modal-title">Add Product </h4>
              </div>
              <div class="modal-body">
                       <div class="col-md-12">
               <form  autocomplete="off" method="POST" action="addproduct.php" enctype="multipart/form-data">
                  <div class="col-md-6 form-group">
          <input type="text" name="item_code" placeholder="Product Code" class="form-control input-lg" readonly="" id="item_code">
             </div>
                <div class="col-md-6 form-group">
          <input type="text" name="pname" placeholder="Product Name" class="form-control input-lg">
             </div> 
             <div class="col-md-6 form-group">
              Select Supplier
          <SELECT name="supplier" class="form-control input-lg" onchange="MakeCode(this.value)" >
            <?php 
            $sup_sql="SELECT * FROM suppliers";
            $sup_query=mysqli_query($con,$sup_sql);
            if (mysqli_num_rows($sup_query)>0) {
               echo '<option disabled=""> SELECT Suppliers </option>';
            while ($sup_row=mysqli_fetch_array($sup_query)) {
             echo '<option value="'.$sup_row['id'].'">'.$sup_row['name'].'</option>';
            }
            }else{
               echo '<option disabled=""> No Suppliers Found '.mysqli_error($con).'</option>';
            }
            
            ?>
          </SELECT>  
             </div> 
           <div class="col-md-6 form-group">
              Select Department
          <SELECT name="dept" class="form-control input-lg">
            <?php 
            $sup_sql="SELECT * FROM departments";
            $sup_query=mysqli_query($con,$sup_sql);
            if (mysqli_num_rows($sup_query)>0) {
              echo '<option disabled=""> SELECT Department </option>';
            while ($sup_row=mysqli_fetch_array($sup_query)) {
             echo '<option value="'.$sup_row['id'].'">'.$sup_row['name'].'</option>';
            }
            }else{
               echo '<option disabled=""> No Department Found '.mysqli_error($con).'</option>';
            }
            
            ?>
          </SELECT>  
             </div>  
             <div class="col-md-6 form-group">
          <input type="text" name="description" placeholder="Description" class="form-control input-lg">
             </div> 
             <div class="col-md-6 form-group">
          <input type="text" name="size" placeholder="Product Size" class="form-control input-lg" required="">
             </div>
             <div class="col-md-6 form-group">
          <input type="text" name="uom" placeholder="Unit Of Measure" class="form-control input-lg" required="">
             </div> 
             <div class="col-md-6 form-group">
          <input type="text" name="min_threshold" placeholder="Minimum Level" class="form-control input-lg" required="">
             </div> 
              
              
          <input type="hidden" name="creator" value="<?php echo $info['id'];?>">
         
              <div class="col-md-12 form-group" style="text-align: center;">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-warning">Reset</button>
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
function MakeCode(dept){
  var Bran='TH-';
  var sdept=dept.substr(0,1).toLowerCase();

 var code= Bran+sdept;
 $.ajax({
            type: 'POST',
            url: 'checkCode.php',
            data: 'id='+code,
            dataType: 'json',
            cache: false,
            success: function(result) {
                //$('#content1').html(result[0]);
             
             document.getElementById("item_code").value=result['new_code'];
               
            },
        });

    
  
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
