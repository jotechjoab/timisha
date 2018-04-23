<?php require 'session.php';
  require 'print.php';
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel Power-Timisha  | Till Receipt</title>
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
<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'receipt Div', 'height=auto,width=auto');
        mywindow.document.write('<html><head><title></title>');
        /*optional stylesheet*/mywindow.document.write('<link rel="stylesheet" href="dist/css/AdminLTE.min.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="dist/css/span.css" type="text/css" />');
        mywindow.document.write('</head><body >');
       
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

       mywindow.print();
        //mywindow.close();

        return true;
    }

</script>
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
       <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">View Sales</h3>

          <div class="box-tools pull-right">
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
              <i class="fa fa-plus"></i> Add Products to PO</button> -->
              <form method="POST" action="print.php">
              <input type="hidden" name="trans_code" value="<?php echo $_POST['trans_code'];?>">
       <input type="hidden" name="group_id" value="<?php echo $_POST['group_id'];?>">
            <!-- <button type="submit" class="btn btn-success"> -->
              <i class="fa fa-print"></i> Print</button>
              </form>
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
             
         <div class="row">

                    <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title ion-ios-cart">  Receipts</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
            
                <div class="col-md-12">


                  <div class="col-md-4">
     
    </div><!-- /.col -->

            <div class="col-md-4">
      <!-- DIRECT CHAT PRIMARY -->
      <div class="box box-primary direct-chat direct-chat-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Receipt</h3>
          
        </div><!-- /.box-header -->
        <div class="box-body" style="padding:5px;" id="receiptDiv">
          <!-- Conversations are loaded here -->

          <p style=" text-align: center; font-size: 22px; ">Timisha Hotel  </p>
          <p style=" text-align: center; font-size: 15px; "> P.O.BOX 10255</p>
          <p style=" text-align: center; font-size: 15px; "> Soroti Uganda</p>
           <div class="direct-chat-info clearfix">
          <span class="direct-chat-timestamp pull-left">Tin:  </span>
          <span class="direct-chat-timestamp pull-right">Vat Reg:  </span>
         </div>
         <div class="direct-chat-info clearfix">
          <span class="direct-chat-timestamp pull-left">Tel:+256 414505596/ +256 414505595  </span>
          <span class="direct-chat-timestamp pull-right">Fax:  </span>
         </div>

<i class="direct-chat-timestamp" style=" text-align: center; ">----------------------------------------------------------------------------------  </i>
         <div class="direct-chat-info clearfix">
          <span class="direct-chat-timestamp pull-left">Till No:  </span>
          <span class="direct-chat-timestamp pull-right">Tax INVOICE:  </span>
         </div>

         <div class="direct-chat-info clearfix">
          <span class="direct-chat-timestamp pull-left">Date:<?php echo date("y-m-d ");?></span>
          <span class="direct-chat-timestamp pull-right">Branch:  </span>
         </div>

         <i class="direct-chat-timestamp" style=" text-align: center; ">----------------------------------------------------------------------------------------------------------------- - </i>
          <table class="table table-condensed direct-chat-timestamp">
            <thead>
              <tr>
                <th>Item</th>
                <th>QTY</th>
                <th>Price</th>
                <th>AMOUNT</th>
              </tr>

            </thead>
<?php $total=0;
      $cash=0;
      $change=0;
       $trans_code=$_POST['trans_code'];
       $details_grp_id=$_POST['group_id'];
       $place=$_POST['place'];

      $receipts=mysqli_query($con,"SELECT a.name as aname, p.name,p.id as item_code,i.quantity,i.rate,r.trans_code,i.details_grp_id,r.received_by,r.cash_tendered,r.amount_paid,r.change_returned from invoice_details i,receipts r,menu_items p,accounts a where (i.details_grp_id='$details_grp_id' AND r.trans_code='$trans_code') AND ((p.id=i.pdt_code) AND (a.id=r.received_by)) ");
      $rm=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM invoice_details WHERE details_grp_id='$details_grp_id'"));
      $num=substr($rm['pdt_code'], 2);
      $rooms=mysqli_query($con,"SELECT a.name as aname, p.room_no as name,i.pdt_code as item_code,i.quantity,i.rate,r.trans_code,i.details_grp_id,r.received_by,r.cash_tendered,r.amount_paid,r.change_returned from invoice_details i,receipts r,bookings p,accounts a where (i.details_grp_id='$details_grp_id' AND r.trans_code='$trans_code') AND ((p.id='$num') AND (a.id=r.received_by)) ");


?>
            <tbody>
<?php
if(mysqli_num_rows($receipts)>0) {
while($item=mysqli_fetch_array($receipts)){
  echo'
               <tr>
                <td>'.$item['name'].'</td>
                <td>'.$item['quantity'].' </td>
                <td>'.number_format($item['rate']).'</td>
                <td>'.number_format((($item['quantity'])*($item['rate']))).'</td>
              </tr>';
                $total=$item['amount_paid'];
                        $cash=$item['cash_tendered'];
                        $change=$item['change_returned'];
                        $trans_code=$item['trans_code'];
                        $details_grp_id=$item['details_grp_id'];
                                }

     }else{

while($item=mysqli_fetch_array($rooms)){
  echo'
               <tr>
                <td>Room '.$item['name'].'</td>
                <td>'.$item['quantity'].' </td>
                <td>'.number_format($item['rate']).'</td>
                <td>'.number_format((($item['quantity'])*($item['rate']))).'</td>
              </tr>';
                $total=$item['amount_paid'];
                        $cash=$item['cash_tendered'];
                        $change=$item['change_returned'];
                        $trans_code=$item['trans_code'];
                        $details_grp_id=$item['details_grp_id'];
                                }



     }                           
echo mysqli_error($con);
                ?>

     
              

            </tbody>

          </table>
          <i class="direct-chat-timestamp" style=" text-align: center; ">-------------------------------------------------------------------------------------------------------------------   </i>
          <p style=" font-weight: bold; ">TOTAL:  <span class="pull-right">  <?php echo number_format($total);?> UGX</span></p>
          <p style=" font-weight: bold; ">CASH:     <span class="pull-right">  <?php echo number_format($cash);?>  UGX </span></p>
          <p style=" font-weight: bold; ">CHANGE:   <span class="pull-right">  <?php echo number_format($change);;?> UGX </span></p>

            <i class="direct-chat-timestamp" style=" text-align: center; ">------------------------------------------------------------------------------------------------------------------   </i>
          <table class="table table-condensed direct-chat-timestamp">
            <thead>
              <tr>
                <th>CODE</th>
                <th>RATE %</th>
                <th>VATABLE AMT</th>
                <th>VAT AMT</th>
              </tr>

            </thead>
            
            <tbody>
               <tr>
                <td>U</td>
                <td>18%</td>
                <td> <?php echo number_format($total);?></td>
                <td> <?php echo number_format(((18/118)*$total));?></td>
              </tr>
            </tbody>

          </table>
            <i class="direct-chat-timestamp" style=" text-align: center; ">
            ==================================================================================<br/>
            </i>

             <i class="direct-chat-timestamp" style=" text-align: center; ">
            YOU WHERE SERVED BY  <?php echo $info['fname'].' '.$info['lname']; ?><br/>
            <i>This Receipt Was Generated By &copy hotelpower  <?php echo date('Y');?></i>
            </i>

        </div><!-- /.box-body -->
        <div class="box-footer">
       <!--  <form method="post" action="print_receipt" >
<input type="hidden" class="form-control" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="trans_code" value="{{$trans_code}}">
        <input type="hidden" name="details_grp_id" value="{{$details_grp_id}}"> -->
          <!-- <button class="btn fa fa-print btn-success">Print</button>

        </form> -->
          <!-- <button class="btn fa fa-print btn-success" onclick="PrintElem('#receiptDiv')">Print2</button> -->

        </div><!-- /.box-footer-->
      </div><!--/.direct-chat -->
    </div><!-- /.col -->

    </div>
    <!-- Second Line Of input--> 
    </div>
    
    <!-- /.col -->
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>


        </div>

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
