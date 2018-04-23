<?php require 'session.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel Power-Timisha  | Stock Requests</title>
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
      My Unpaid Transactions
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">My Unpaid Transactions</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">
       <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">View My Unpaid Transactions</h3>

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
             
         <form method="POST" action="savepo.php">  
         <input type="hidden" name="id" id="id" value="<?php echo $info['id'];?>"> 
          <table class="table table-bordered table-hover" id="example1">
               <thead>
                 <tr>
                   <th>#</th>
                   <th>Date</th>
                   <th>Invoice No </th>
                   <th>Transaction No </th>
                   <th>Pending Amount</th>
                    <th>Status </th>
                   <th>Actions</th>
                 </tr>
               </thead>
          <tbody>
          <?php
          $id=$info['id'];
        $sql="SELECT r.trans_code,r.balance_due,r.date_created,t.journal_id,t.trans_date,j.journal_type_id,i.payment_status,r.created_by FROM receipts r, transactions t,journals j,invoices i WHERE (r.trans_code=t.trans_code AND t.journal_id=j.id) AND (i.details_grp_id=j.journal_type_id AND i.payment_status='partial') AND r.created_by='$id'";
        $query=mysqli_query($con,$sql);
        if (mysqli_num_rows($query)>0) {
          $i=1;
      
          while ($row=mysqli_fetch_array($query)) {
             $group_id=$row['journal_type_id'];
            


           echo '
             <tr>
                   <td>'.$i++.'</td>
                   <td>'.date("d/M/Y",strtotime($row['trans_date'])).'</td>
                   <td>'.$row['journal_type_id'].'</td>
                    <td>'.$row['trans_code'].'</td>
                   <td>'.$row['balance_due'].'</td>
                    <td>'.ucfirst($row['payment_status']).'</td>
                   <td>
                  <button type="button" class="btn btn-warning fa fa-edit" onclick="paybill(\''.$group_id.'\',\''.$row['trans_code'].'\')"> Clear Bill</button>
                    <button type="button" class="btn btn-success fa fa-list" onclick="editpodetail(\''.$group_id.'\','.$row['trans_code'].')"> Details</button>
                   </td>
                 </tr>

           ';
          }
              
            }    
           
                 ?>
          </tbody>     
          </table>
         
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
  <div class="modal fade" id="modal-default">
          <div class="modal-dialog" style="width: 1000px;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Clear Unpaid Bill</h4>
              </div>
              <div class="modal-body">
              <div class="row" id="q_results">
                 <form action="paybill.php" method="POST" id="frm1">
          <!--    <input type="hidden" class="form-control" name="_token" value="{{ csrf_token() }}"> -->
                  <div class="col-md-12">
                 <div class="form-group col-md-3" >
       <input type="text" class="form-control input-lg"  readonly=""  id="b">
        <input type="hidden" class="form-control input-lg" name="pending" id="pending"  >
        <input type="hidden" class="form-control input-lg" name="cust"  id="cust">
        <input type="hidden" name="user" value="<?php echo $info['id']; ?>">

 <input type="hidden" class="form-control input-lg" name="journal_id"  id="journal_id" >
  <input type="hidden" class="form-control input-lg" name="trans_code"  id="trans_code" >
   <input type="hidden" class="form-control input-lg" name="grp_id" id="grp_id" >

                 </div>

                <div class="form-group col-md-3" >
                   <input type="text" class="form-control input-lg" name="change" readonly="" placeholder="Change" id="x">
                    
                 </div>
                  <div class="form-group col-md-3" >
                   <input type="text" class="form-control input-lg" name="cash" placeholder="Cash Tendered" onkeyup="calc()" id="a">
                 </div>



                  <div class="form-group col-md-3" >
        <button class="btn btn-success">Clear Invoices</button>
                 </div>
                
                 <div class="form-group col-md-6" >

                  
                  
                 </div>

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
function paybill(grp_id,trans_code){
  $('#modal-default').modal('show');
   // document.getElementById("q_results").innerHTML=id;
 
 $.ajax({
            type: 'POST',
            url: 'getcredit.php',
            data: 'q='+trans_code,
            dataType: 'json',
            cache: false,
            success: function(result) {
                $('#b').val(result['balance_due']); 
                $('#pending').val(result['balance_due']);
                $('#journal_id').val(result['jid']);
                $('#cust').val(result['account_dr']);
                $('#trans_code').val(result['trans_code']);    
                $('#grp_id').val(result['journal_type_id']);       
             //document.getElementById("q_results").innerHTML=result;
               
            },
        });

//  $.post("getsrdetails.php", { 
//     q: grp_id,
//     dept:trans_code
// }, function(data) {
//    // document.getElementById("q_results").innerHTML=data;
// });

    
  
}



function calc(){

var change=(Number(document.getElementById("b").value)-Number(document.getElementById("a").value));

document.getElementById("x").value=String(change).replace(/(.)(?=(\d{3})+$)/g,'$1,');
document.getElementById("x1").value=change;


 }




function delsritem(grp_id,id){
 $.post("delsritem.php", { 
    id: id,
    grp_id:grp_id
}, function(data) {
  window.location.reload();
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

  
</script>
</body>
</html>
