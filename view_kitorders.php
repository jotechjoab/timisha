<?php require 'session.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel Power-Timisha  | Kitchen Request </title>
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
       Kitchen Orders
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kitchen Orders</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">

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

        $countnew="";
        $countolde="";


             ?>
<div class="col-md-6">
<div class="box box-default">
  <div class="box-header with-border">
    <i class="fa fa-food"></i>

    <h3 class="box-title">Unfinished Orders</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
 <table class="table table-bordered table-hover" id="example3">
               <thead>
                 <tr>
                   <th>#</th>
                   <th>Order</th>
                   <th>Sent by</th>
                   <th>Quantity</th>
                 </tr>
               </thead>
          <tbody>
          <?php
          //$od=$_GET['od'];

          neworders();

  function neworders(){ 
  require 'config.php';       
        $sql="SELECT o.id,i.name,i.item_code,o.details_grp_id,o.rate,o.qty,o.comment ,o.status,o.send_status,u.fname,u.lname FROM order_details o, menu_items i, kitchen_orders k,users u WHERE (k.order_id=o.id AND o.item_id=i.id) AND (k.created_by=u.id AND k.status=0)";
        $query=mysqli_query($con,$sql);
        if (mysqli_num_rows($query)>0) {
          $i=1;
       $status="";   
          while ($row=mysqli_fetch_array($query)) {
             

           echo '
             <tr>
                   <td>'.$i++.'</td>
                   <td>'.$row['name'].' - '.$row['comment'].'</td>
                      <td>'.$row['fname'].' '.$row['lname'].'</td>
                      <td>'.$row['qty'].'</td>
                 </tr>

           ';
          }
              
            }else{
              echo '<tr><td colspan="4"><div class="alert alert-danger" style="text-align:center;">No New Orders Found  '.mysqli_error($con).'</div></td></tr>';
            }    
           }
                 ?>
          </tbody>     
          </table>   
    
    
    
  </div>
  <!-- /.box-body -->
</div>
</div>
<div class="col-md-6">
  <?php
$countnew=mysqli_num_rows(mysqli_query($con,"SELECT * FROM  kitchen_orders where status=0 AND DATE(created_at)=CURDATE()"));
$countolde=mysqli_num_rows(mysqli_query($con,"SELECT * FROM  kitchen_orders where status=1 AND DATE(created_at)=CURDATE()"));
$countall=mysqli_num_rows(mysqli_query($con,"SELECT * FROM  kitchen_orders where DATE(created_at)=CURDATE()"));

  ?>
<div class="box box-default">
  <div class="box-header with-border">
    <i class="fa fa-food"></i>

    <h3 class="box-title">Finished Orders</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
   
   <table class="table table-bordered table-hover" id="example2">
               <thead>
                 <tr>
                   <th>#</th>
                   <th>Order</th>
                   <th>Sent by</th>
                   <th>Quantity</th>
                 </tr>
               </thead>
          <tbody>
          <?php
          //$od=$_GET['od'];

          finished();

  function finished(){ 

  require 'config.php';       
        $sql="SELECT o.id,i.name,i.item_code,o.details_grp_id,o.rate,o.qty ,o.status,o.send_status,u.fname,u.lname FROM order_details o, menu_items i, kitchen_orders k,users u WHERE (k.order_id=o.id AND o.item_id=i.id) AND (k.created_by=u.id AND k.status=1) AND DATE(k.created_at)=CURDATE()";
        $query=mysqli_query($con,$sql);
        if (mysqli_num_rows($query)>0) {
          $i=1;
       $status="";   
          while ($row=mysqli_fetch_array($query)) {
             

           echo '
             <tr>
                   <td>'.$i++.'</td>
                   <td>'.$row['name'].'</td>
                      <td>'.$row['fname'].' '.$row['lname'].'</td>
                      <td>'.$row['qty'].'</td>
                 </tr>

           ';
          }
              
            }else{
              echo '<tr><td colspan="4"><div class="alert alert-danger" style="text-align:center;">No Finished Orders '.mysqli_error($con).'</div></td></tr>';
            }    
           }
                 ?>
          </tbody>     
          </table>    
    
    
    
  </div>
  <!-- /.box-body -->
</div> 
</div>

<div class="col-md-12">
  <div class="col-md-6">
    <?php 
  if($countall>0)  {
$ageNew=($countnew/$countall)*100;}
else{
  $ageNew=0;
}

    ?>
    New Orders
  <div class="progress progress-lg active">
  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $ageNew;?>%;">
    <span class="sr"><?php echo number_format($ageNew);?>% Incomplete </span>
  </div>
</div>

</div>
 <div class="col-md-6">
   <?php 
   if ($countall>0) {
     # code...
  
$ageOld=($countolde/$countall)*100;
 }
 $ageNew=0;
    ?>
  Finished Orders
  <div class="progress progress-lg active">
  <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $ageOld;?>%;">
    <span class="sr"><?php echo number_format($ageOld);?>% Complete</span>
  </div>
</div>

  
</div>


</div>
<div class="col-md-9">
<div class="box box-default">
  <div class="box-header with-border">
    <i class="fa fa-food"></i>

    <h3 class="box-title">Kitchen Orders </h3>
    <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table class="table table-bordered table-hover" id="example1">
               <thead>
                 <tr>
                   <th>#</th>
                   <th>Order</th>
                   <th>Sent by</th>
                   <th>Quantity</th>
                    <th>Action</th>
                 </tr>
               </thead>
          <tbody>
          <?php
          //$od=$_GET['od'];

          orders();

  function orders(){ 
  require 'config.php';       
        $sql="SELECT o.id,i.name,i.item_code,o.details_grp_id,o.rate,o.qty ,o.status,o.send_status,u.fname,u.lname FROM order_details o, menu_items i, kitchen_orders k,users u WHERE (k.order_id=o.id AND o.item_id=i.id) AND (k.created_by=u.id AND k.status=0)";
        $query=mysqli_query($con,$sql);
        if (mysqli_num_rows($query)>0) {
          $i=1;
       $status="";   
          while ($row=mysqli_fetch_array($query)) {
             

           echo '
             <tr>
                   <td>'.$i++.'</td>
                   <td>'.$row['name'].'</td>
                      <td>'.$row['fname'].' '.$row['lname'].'</td>
                      <td>'.$row['qty'].'</td>
                      <td><a class="btn btn-success" href="clear_kitorder.php?id='.$row['id'].'">Clear Order</a>
                      <a class="btn btn-danger" href="reject_kitorder.php?id='.$row['id'].'">Reject Order</a> </td>
                 </tr>

           ';
          }
              
            }else{
              echo '<tr><td colspan="5"><div class="alert alert-danger" style="text-align:center;">No New Orders Found '.mysqli_error($con).'</div></td></tr>';
            }    
           }
                 ?>
          </tbody>     
          </table>   
    
    
    
  </div>
  <!-- /.box-body -->
</div> 
</div>



<div class="col-md-3">
<div class="box box-default">
  <div class="box-header with-border">
    <i class="fa fa-food"></i>

    <h3 class="box-title">No. Of Guests In Rooms </h3>
    <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
 <div class="row">
 <div class="col-lg-12 col-xs-12">
    <div class="small-box bg-yellow">
            <div class="inner">
           <?php $sql_guest = mysqli_query($con,"SELECT SUM(no_of_guests) as guests FROM bookings WHERE checkin_status='IN'");
            $num=mysqli_fetch_array($sql_guest);
           ?>
              <h3><?php  echo $num['guests'];?> Guests</h3>

              <p>For Breakfast</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
           
          </div>
          </div>
 </div>
    
    
    
  </div>
  <!-- /.box-body -->
</div> 
</div>

     </div>

    </section>
    <!-- /.content -->
  </div>
  <div class="modal fade" id="modal-warning">
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Are you sure you want to send rhis request to the Kitchen? </h4>
              </div>
              <div class="modal-body">
               
                 <form method="POST" action="kitorder.php">
              <div class="col-md-12" style="text-align: center;">
                
               <div class="col-md-6 form-group">
                 <input type="hidden" name="order_id" id="order_id">
                 <button class="btn-primary btn" type="submit"> Send Order</button>
               </div>
               <div class="col-md-6 form-group">
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
               </div>
              </div>
                </form>
             
              </div>
              <div class="modal-footer">
               <!--  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                -->
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
   <div class="modal fade" id="edituser">
          <div class="modal-dialog" style="width: 1000px;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit User </h4>
              </div>
              <div class="modal-body">
                       <div class="col-md-12">
               <form  autocomplete="off" method="POST" action="updateuser.php" enctype="multipart/form-data">
                <div class="col-md-3 form-group">
                  <input type="hidden" name="userid" id="userid">
          <input type="text" name="fname" placeholder="First Name" id="fname" class="form-control input-lg">
             </div> 
             <div class="col-md-3 form-group">
          <input type="text" name="lname" placeholder="Last Name" id="lname" class="form-control input-lg">
             </div> 
             <div class="col-md-3 form-group">
          <input type="text" name="oname" placeholder="Other Name" id="oname" class="form-control input-lg">
             </div> 
             <div class="col-md-3 form-group">
          <input type="text" name="username" id="username" placeholder="Username" class="form-control input-lg" required="">
             </div>
             <div class="col-md-3 form-group">
          <input type="password" name="password" id="password" placeholder="Password" class="form-control input-lg" required="">
             </div> 
             <div class="col-md-3 form-group">
          <input type="email" name="email" id="email" placeholder="E-Mail" class="form-control input-lg" required="">
             </div> 
              <div class="col-md-3 form-group">
          <input type="text" name="phone" id="phone" placeholder="Phone" class="form-control input-lg" required="">
             </div> 
               <div class="col-md-3 form-group">
          <input type="file" name="img_url" placeholder="Image" class="form-control input-lg">
              <input type="hidden" name="oldimage" placeholder="Image" class="form-control input-lg" id="oldimage">
          <input type="hidden" name="creator" value="<?php echo $info['id'];?>">
          <input type="hidden" name="uid" id="uid" >
             </div> 
              <div class="col-md-12 form-group" style="text-align: center;">
                <button type="submit" class="btn btn-primary">Update</button>
                
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
function getproduct(q,dept){
if (q=="") {
   
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
    document.getElementById("q_results").innerHTML=this.responseText;
     //document.getElementById("msg").style.display="block";
  // window.location.reload();
    }
  }
  xmlhttp.open("GET","getproducts.php?q="+q+"&dept="+dept,true);
 
  xmlhttp.send();


    
  
}

function kitchorder(q){
//   var r=confirm("Are You Sure You Want to Send This Order to The Kitchen ?");

//   if (r==true) {
//  $.ajax({
//             type: 'POST',
//             url: 'kitorder.php',
//             data: 'q='+q,
//             dataType: 'html',
//             cache: false,
//             success: function(result) {
//                 window.location.reload();
                
        
//             },
//         });
// }
    
 document.getElementById("order_id").value=q;  
  $('#modal-warning').modal('show');    
  
}


function deleteitem(q){
//   var r=confirm("Are You Sure You Want to remove This Item?");

//   if (r==true) {
//  $.ajax({
//             type: 'POST',
//             url: 'deletepo.php',
//             data: 'q='+q,
//             dataType: 'html',
//             cache: false,
//             success: function(result) {
//                 window.location.reload();
                
        
//             },
//         });
// }


  
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
