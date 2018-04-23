<?php require 'session.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel Power-Timisha  | Puchase Order</title>
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
        Purchase Order
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Purchase Order</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">
       <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">View Purchase Orders </h3>

          <div class="box-tools pull-right">
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
              <i class="fa fa-plus"></i> Add Products to PO</button> -->
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
                   <th>Date</th>
                   <th>PO Number</th>
                   <th>Supplier</th>
                   <th>Payment Status</th>
                   <th>Approval Status </th>
                   <th>Amount</th>
                   <th>Actions</th>
                 </tr>
               </thead>
          <tbody>
          <?php
          
        $sql="SELECT p.created_at,p.details_grp_id,s.name as sname,p.approval_status,p.payment_status,p.amount FROM po p,suppliers s WHERE p.supplier_id=s.id";
        $query=mysqli_query($con,$sql);
        if (mysqli_num_rows($query)>0) {
          $i=1;
       $pay_status=""; 
       $app_status="";  
      
          while ($row=mysqli_fetch_array($query)) {
             $group_id=$row['details_grp_id'];
           
            switch ($row['payment_status']) {
              case 'None':
              $pay_status='<span class="label bg-red"> None</span>';
                break;
               case 'Partial':
             $pay_status='<span class="label bg-orange"> Partion</span>';
                break; 
               case 'Full':
              $pay_status='<span class="label bg-green"> Full</span>';
                break;     
              
              default:
               $pay_status='<span class="label bg-red"> None</span>';
                break;
            }

            switch ($row['approval_status']) {
              case 'Approved':
            $app_status='<span class="label bg-green"> Approved</span>';
                break;
               case 'Pending':
             $app_status='<span class="label bg-orange"> Pending</span>';
                break;  
              case 'Rejected':
             $app_status='<span class="label bg-red"> Rejected</span>';
                break;  
              default:
              $app_status='<span class="label bg-orange"> Pending</span>';
                break;
            }

            
            $button_down="";
            if ($row['amount']<=0) {
             $button_down='disabled=""';
            }
           echo '
             <tr>
                   <td>'.$i++.'</td>
                   <td>'.date("d/M/Y",strtotime($row['created_at'])).'</td>
                   <td>'.$row['details_grp_id'].'</td>
                   <td>'.$row['sname'].'</td>
                   <td>'.$pay_status.'</td>
                   <td>'.$app_status.'</td>
                   <td>'.$row['amount'].'</td>
                   <td>
                   <a class="btn btn-primary fa fa-eye" href="real_po.php?po='.$row['details_grp_id'].'"></a>
                   <button type="button" class="btn btn-success fa  fa-check-square" onclick="editpodetail(\''.$group_id.'\')" '.$button_down.' > Approve</button>
                   <button class="btn btn-danger fa fa-trash"></button>
                   </td>
                 </tr>

           ';
          }
              
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
                <h4 class="modal-title">Edit Po Details</h4>
              </div>
              <div class="modal-body">
              <div class="col-md-12" id="q_results">
                
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
function editpodetail(id){
  $('#modal-default').modal('show');
   // document.getElementById("q_results").innerHTML=id;
 
 $.ajax({
            type: 'POST',
            url: 'getadminpodetails.php',
            data: 'q='+id,
            dataType: 'html',
            cache: false,
            success: function(result) {
                //$('#content1').html(result[0]);  
             document.getElementById("q_results").innerHTML=result;
               
            },
        });

    
  
}
function deleteitem(q){
  var r=confirm("Are You Sure You Want to remove This Item?");

  if (r==true) {
 $.ajax({
            type: 'POST',
            url: 'deletepo.php',
            data: 'q='+q,
            dataType: 'html',
            cache: false,
            success: function(result) {
                window.location.reload();
                
        
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
