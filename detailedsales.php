<?php require 'session.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel Power-Timisha  | Detailed Report</title>
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
      Receipts
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Receipts</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">
       <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">View Receipts</h3>

          <div class="box-tools pull-right">
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
              <i class="fa fa-plus"></i> Add Products to PO</button> -->
            <button type="button" class="btn btn-success">
              <i class="fa fa-print"></i> Print</button>
          </div>
        </div>
        <div class="box-body">
         <?php
         require __DIR__ . '/vendor/mike42/escpos-php/autoload.php';
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
              <!--   <form  autocomplete="off" id="dateform" > -->
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
                   <button class="btn-lg btn-info  fa fa-download" onclick="gen()"> Generate Report</button>
                 </div>
                  <div class="col-md-5" >
                  
                 </div> 
             <!--     </form> -->
                 </div>

  <div id="results" class="col-md-12">       
         <?php


  if (!$con) {echo 
  'connection error';
  }
  else{
//$datefrom=date("Y-m-d",strtotime($_GET['from']))." 00:00:00";
//$dateto=date("Y-m-d",strtotime($_GET['to']))." 23:59:59";     
$i=1;
$totaltender=0;
$totalpaid=0;
$totalbaldue=0;
$sql="SELECT r.id,t.trans_date,r.trans_code,a.name,r.paymt_mode,r.cash_tendered,r.amount_paid,r.change_returned,r.balance_due,u.fname,u.lname FROM users u,accounts a,receipts r,transactions t WHERE (u.id=r.created_by AND a.id=r.received_by) AND (r.trans_code=t.trans_code)";
$results=mysqli_query($con,$sql);
if($results){
$color='#000';
  echo  "<h3 style='text-align:center'>Timisha Hotel Receipts Report </h3>";
  echo '<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>#</th>
                  <th>Date Created</th>
                  <th>Receipt No.</th>
                  <th>Received By</th>
                  <th>Payment Mode</th>
                  <th>Amount</th>
                  <th>Cash Tendered</th>
                  <th>Change Returned</th>
                  <th>Balance Due</th>
                  <th >Issued By</th>

                </tr>
                </thead>
                <tbody>';
if (mysqli_num_rows($results)>0) {

  while ($row=mysqli_fetch_array($results)) {

if ($row['balance_due']>0) {
  $color="red";
  $button='<a href="finishpay/'.$row['id'].'"><i class="fa fa-pencil-square-o" style="color:green;"> Clear Amount</i></a>';
}else{
  $color="#000";
  $button='';
}
$bal=$row['balance_due'];
if ($bal<0) {
$bal=0;
}
$mth=$row['paymt_mode'];
$pay=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM pay_methods WHERE id='$mth'"));
    echo "<tr style='color:".$color.";'>";
    echo '<td>'.$i++.'</td>
       <td>'.$row['trans_date'].'</td>
       <td>'.$row['trans_code'].'</td>
       <td>'.$row['name'].'</td>
       <td>'.$pay['method'].'</td>
       <td>'.number_format($row['amount_paid']).'</td>
       <td>'.number_format($row['cash_tendered']).'</td>
       <td>'.number_format($row['change_returned']).'</td>
       <td>'.number_format($bal).'</td>
       <td>'.$row['fname'].' '. $row['lname'].'</td>
 
</tr>


    ';

    $totaltender+=$row['cash_tendered'];
    $totalpaid+=$row['amount_paid'];
    $totalbaldue+=$bal;

  }
  echo "
<tr style=' font-weight: bold; '>
<td colspan='5'>Total</td>
<td>Total Amount Due: ".number_format($totalpaid)."</td><td>Total Cash Tendered: ".number_format($totaltender)."</td><td></td><td>Total Balance due: ".number_format($totalbaldue)."</td></tr>

  </tbody></table";
}
}else
{
  echo mysqli_error($con);
}
}

?>
</div>
</div></div></div></section>  


  <!-- /.content-wrapper -->
  <!-- <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2014-<?php echo date("Y");?> <a href="https://adminlte.io">Jotechnologies Uganda</a>.</strong> All rights
    reserved.
  </footer> -->

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
 function gen() {
var from=document.getElementById("datepicker").value;
var to = document.getElementById("datepicker1").value;
  if (from=="" && to=="") {
    document.getElementById("results").innerHTML="Nuh values";
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
      document.getElementById("results").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","salereport.php?from="+from+"&to="+to,true);
  xmlhttp.send();
}



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

    function reprint(grp_id,trans_code){
 $.post("print.php", { 
    trans_code: trans_code,
    group_id:grp_id
}, function(data) {
  // document.getElementById("q_results").innerHTML=data;
});

    
  
}

</script>
</body>
</html>
