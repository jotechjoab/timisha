<?php require 'session.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel Power-Timisha  | Restaurant Sales </title>
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
      Sales
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">

     <div class="col-md-12">
       <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Generate Custom Report</h3>

          <div class="box-tools pull-right">
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
              <i class="fa fa-plus"></i> Add Products to PO</button> -->
           <!--  <button type="button" class="btn btn-success">
              <i class="fa fa-print"></i> Print</button> -->
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

      <div class="col-md-12">
                <form  autocomplete="off" id="dateform" method="POST" action="custom_food_report.php" >
                <input type="hidden" name="user" value="<?php echo $info['id'];?>">
                <input type="hidden" name="type" value="sales">
                <input type="hidden" name="dept" value="3">
                <div class="col-md-6">
                    <div class="form-group">
                <label>From :</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker" name="from">
                </div>
                <!-- /.input group -->
              </div>

              <!-- Date range -->
             </div> 

              <div class="col-md-6">
                    <div class="form-group">
                <label>To:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker1" name="to">
                </div>
                <!-- /.input group -->
              </div>

              <!-- Date range -->
             </div> 
               
                <div class="col-md-5" >
                 
                 </div>
                  <div class="col-md-2" >
                   <button class="btn-lg btn-info  fa fa-download" > Generate Report</button>
                 </div>
                  <div class="col-md-5" >
                  
                 </div> 
                 </form>
                 </div>
       </div>
       </div>   




       <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">View Sales</h3>

          <div class="box-tools pull-right">
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
              <i class="fa fa-plus"></i> Add Products to PO</button> -->
            <button type="button" class="btn btn-success">
              <!-- <i class="fa fa-print"></i> Print</button> -->
          </div>
        </div>
        <div class="box-body">
        
         
         <?php


 if (!$con) {echo 
  'connection error';
  }
  else{
//$datefrom=date("Y-m-d",strtotime($_GET['from']))." 00:00:00";
//$dateto=date("Y-m-d",strtotime($_GET['to']))." 23:59:59";   
$i=1;
$totalsum=0;

$sql="SELECT i.details_grp_id,t.trans_code,t.trans_date,p.id as item_code,p.name,d.quantity,d.rate,u.fname,u.lname,(d.quantity*d.rate) as totalprice,i.payment_status,p.dept FROM users u,menu_items p,invoice_details d, invoices i,transactions t WHERE  (u.id=d.created_by AND p.id=d.pdt_code) AND (d.details_grp_id=i.details_grp_id) AND (t.created_at=i.created_at AND p.dept=3)";
$results=mysqli_query($con,$sql);
if($results){
$color='#000';
?>
<h3 style='text-align:center'>Timisha Restaurant Sales Report </h3>
<table id="example2" class="table table-bordered">
                <thead>
                <tr>
                <th>#</th>
                  <th>Date Sold</th>
                  <th>Item Code</th>
                  <th>Name</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>Food</th>
                  <th>Payment Status</th>
                  <th >Sold By</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
<?php                
if (mysqli_num_rows($results)>0) {

  while ($row=mysqli_fetch_array($results)) {

if ($row['payment_status']=='partial') {
  $color="red";
  
}else{
  $color="#000";
  
}

  $bar=0;
  $food=0;

  if ($row['dept']==3) {
    $food=$row['totalprice'];
  }else if($row['dept']==1){
    $bar=$row['totalprice'];
  }


    echo "<tr style='color:".$color.";'>";
    echo '<td>'.$i++.'</td>
       <td>'.$row['trans_date'].'</td>
       <td>'.$row['item_code'].'</td>
       <td>'.$row['name'].'</td>
       <td>'.$row['quantity'].'</td>
       <td>'.number_format($row['rate']).'</td>
       <td>'.number_format($food).'</td>
       <td>'.$row['payment_status'].'</td>
       <td>'.$row['fname'].' '. $row['lname'].'</td>
       <td><a href="#" onclick="reprint(\''.$row['details_grp_id'].'\',\''.$row['trans_code'].'\')"><i class="fa fa-print" style="color:green;"></i></a></td>

</tr>


    ';

    $totalsum+=$row['totalprice'];

  }




}
}else
{
  echo mysqli_error($con);
}
}
?>

</tbody></table>
<table class="table">
  <?php echo "
<tr style=' font-weight: bold; '><td colspan='6'>Total</td><td>".number_format($totalsum)."</td></tr>";?>
</table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <!-- Footer -->
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
                <h4 class="modal-title">Edit Stock Request Details</h4>
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
   <div class="modal fade" id="add_to_inv">
          <div class="modal-dialog" style="width: 1000px;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Purchase Order To Inventory</h4>
              </div>
              <div class="modal-body">
               <div class="col-md-12" id="q_inv">
                 <input type="text" class="form-control pull-right" id="datepicker">
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
function editpodetail(id,dept){
  $('#modal-default').modal('show');
   // document.getElementById("q_results").innerHTML=id;
 
 // $.ajax({
 //            type: 'POST',
 //            url: 'getsrdetails.php',
 //            data: 'q='+id,
 //            dataType: 'html',
 //            cache: false,
 //            success: function(result) {
 //                //$('#content1').html(result[0]);  
 //             document.getElementById("q_results").innerHTML=result;
               
 //            },
 //        });

 $.post("getsrdetails.php", { 
    q: id,
    dept:dept
}, function(data) {
   document.getElementById("q_results").innerHTML=data;
});

    
  
}

function reprint(grp_id,trans_code){
 $.post("print.php", { 
    trans_code: trans_code,
    group_id:grp_id
}, function(data) {
  // document.getElementById("q_results").innerHTML=data;
});

    
  
}


function showdatep(){
  $('#datepicker').datepicker({
      autoclose: true
    })
}  
function deleteitem(q){
  var r=confirm("Are You Sure You Want to remove This Item?");

  if (r==true) {
 $.ajax({
            type: 'POST',
            url: 'deletesr.php',
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
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })

  
 //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    $('#datepicker1').datepicker({
      autoclose: true
    });



</script>
</body>
</html>
