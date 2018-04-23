<?php require 'session.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel Power-Timisha  | My Orders</title>
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
<style type="text/css">
    a[disabled="disabled"] {
        pointer-events: none;
    }
</style>

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
        My Orders
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">My Orders</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">
       <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">View  My Orders </h3>

          <div class="box-tools pull-right">
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
              <i class="fa fa-plus"></i> Add Products to SR</button> -->
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
             
         <form method="POST" action="savesr.php">  
         <input type="hidden" name="id" id="id" value="<?php echo $info['id'];?>"> 
          <table class="table table-bordered table-hover" id="example1">
               <thead>
                 <tr>
                   <th>#</th>
                   <th>Date</th>
                   <th>Client</th>
                   <th>Location</th>
                   <th>Delievery</th>
                   <th>Amount</th>
                   <th>Action</th>
                 </tr>
               </thead>
          <tbody>
          <?php
          $user=$info['id'];
        $sql="SELECT o.details_grp_id,o.post_status,o.created_at,c.name,o.location,o.delievery_status,o.amount FROM orders o,accounts c WHERE o.client=c.id AND o.created_by='$user' order by created_at DESC ";
        $query=mysqli_query($con,$sql);
        if (mysqli_num_rows($query)>0) {
          $i=1;
       $status="";   
          while ($row=mysqli_fetch_array($query)) {
            if ($row['delievery_status']=='Pending') {
              $post='<a  class="btn btn-success fa fa-send" disabled="disabled" href="order_details.php?od='.$row['details_grp_id'].'"> Post</a>';
              $cancel='<button type="button" class="btn btn-danger fa fa-ban"> Cancel</button>';
              $process='<a  href="order_details.php?od='.$row['details_grp_id'].'" class="btn btn-warning fa fa-download"> Process</a>';
            }else{
              $post='<button type="button" class="btn btn-success fa fa-send" > Post</button>';
              $cancel='<button type="button" class="btn btn-danger fa fa-ban" disabled=""> Cancel</button>';
              if ($row['post_status']==0) {
                 $process='<button class="btn btn-primary fa fa-send" onclick="posttransaction(\''.$row['details_grp_id'].'\','.$row['amount'].')"  type="button"> Post Transaction</button>';
              }else{
              $process='<button class="btn btn-success fa  fa-check-square" disabled=""> Completed</button>';}
            }
           echo '
             <tr>
                   <td>'.$i++.'</td>
                   <td>'.date("d/M/Y",strtotime($row['created_at'])).'</td>
                    <td>'.$row['name'].'</td>
                      <td>'.$row['location'].'</td>
                      <td>'.$row['delievery_status'].'</td>
                      <td>'.$row['amount'].''.mysqli_error($con).'</td>
                   <td>
              '.$process.'
              '.$cancel.'
                 </tr>

           ';
          }
              
            }    
           
                 ?>
          </tbody>     
          </table>
          <div class="col-md-12 form-group" style="text-align: center;">    
              </div> 
</form>

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
    <div class="modal modal-success fade" id="modal-success" >
          <div class="modal-dialog" style="width: 1000px;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Select Payment Information</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <form method="POST" action="make_transaction.php">
                  <input type="hidden" name="grp_id" id="grp_id">
              <div class="col-md-4 form-group">
              <input type="text" name="bill" placeholder="Bill" id="bill" readonly="" class="form-control">
              </div>
              <div class="col-md-4 form-group">
                <input type="number" name="tendered" placeholder="Enter Cash tendered" onkeyup="getbalance(this.value)" id="tendered" class="form-control" required="">
              </div>
              <div class="col-md-4 form-group">
                <input type="text" name="balance" placeholder="Balance" id="balance" class="form-control" readonly="">
              </div>
              <div class="col-md-4 form-group">
                <SELECT name="method" class="form-control" onchange="getidentifier(this.value)">
                  <option> Select Payment Method </option>
                  <?php
                  $mth_sql=mysqli_query($con,"SELECT * FROM pay_methods");
                  while($mtd=mysqli_fetch_array($mth_sql)){
                    echo '<option value="'.$mtd['id'].'">'.$mtd['method'].'</option>';
                  }

                   ?>

                </SELECT>
              </div>
              
              <div class="col-md-4 form-group">
                <input type="text" name="identifier" placeholder="Payment Id eg. Cheque No." id="identifier" class="form-control" >
              </div>
               <div class="col-md-4 form-group">
                <input type="text" name="trans_date" placeholder="Transaction date" id="datepicker" class="form-control" >
              </div>
          <div class="form-group col-md-12" style="text-align: center;">
             <button  class="btn btn-outline" type="submit">Make Transaction</button>
          </div>    
</form>
            </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


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
}}

function getbalance(bal){
  var bill=document.getElementById("bill").value;
  var balance=bal-bill;
  document.getElementById("balance").value=balance;

}


    
  

function posttransaction(q,bill){
  var r=confirm("Are You Sure You Want to Post This Transaction?");

  if (r==true) {
      $('#modal-success').modal('show');
      document.getElementById("bill").value=bill;
      document.getElementById("grp_id").value=q;


 // $.ajax({
 //            type: 'POST',
 //            url: 'deletepo.php',
 //            data: 'q='+q,
 //            dataType: 'html',
 //            cache: false,
 //            success: function(result) {
 //                window.location.reload();
                
        
 //            },
 //        });
}
    
  
}

   $('#datepicker').datepicker({
      autoclose: true
    })


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
