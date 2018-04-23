<?php require 'session.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel Power-Timisha  | Check Room</title>
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
        Booking
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Booking</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">
       <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Room Bookings</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
              <i class="fa fa-plus"></i> Make Booking</button>
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
          <table class="table table-bordered table-hover" id="example2">
               <thead>
                 <tr>
                   <th>#</th>
                   <th>Date</th>
                   <th>Guest Name</th>
                   <th>Address</th>
                   <th>Room</th>
                   <th>Date In</th>
                   <th>Date Out</th>
                   <th>Occupied</th>
                   <th>Paid</th>
                   <th>Action</th>
                 </tr>
               </thead>
          <tbody>
          <?php
          $user=$info['id'];
        $sql="SELECT b.id,b.created_at,g.name as gname,g.address,r.room_name,r.room_no,b.date_in,b.date_out,b.status as pay_status,r.occupation_status,r.book_status,b.checkin_status FROM bookings b,rooms r,guests g WHERE b.guest_id=g.id AND b.room_no=r.room_no ORDER BY b.created_at DESC";
        $query=mysqli_query($con,$sql);
        if (mysqli_num_rows($query)>0) {
          $i=1;
       $status="";   
          while ($row=mysqli_fetch_array($query)) {
          $pay="";
          $entered="";
          $pay_btn="";
          $check="";
          $Date='';
          if ($row['pay_status']==1) {
            $pay="Paid";
            $pay_btn='<button class="btn btn-success fa fa-money" disabled="">Bill Paid</button>';
            $Date='<button class="btn btn-success fa fa-calendar" disabled=""></button>';

          }else{
            $pay="Not Paid";
            $pay_btn='<button class="btn btn-warning fa fa-money" onclick="posttransaction('.$row['id'].')"> Pay Bill </button>';
            $Date='<button class="btn btn-success fa fa-calendar" ></button>';
          }
          if ($row['occupation_status']==1 && $row['pay_status']==0) {
            $entered="Occupied";
            $check='<button class="btn btn-danger fa  fa-sign-out" onclick="checkout('.$row['id'].')"> Check Out</button>';
             $Date='<button class="btn btn-success fa fa-calendar" onclick="extenddat('.$row['id'].',\''.$row['date_out'].'\')"></button>';
          }else if($row['occupation_status']==1 && $row['pay_status']==1){
              if($row['checkin_status']=='IN'){
            $entered="Occupied";
            $check='<button class="btn btn-danger fa  fa-sign-out" onclick="checkout('.$row['id'].')"> Check Out</button>';
             $Date='<button class="btn btn-success fa fa-calendar" disabled=""></button>';}
             else{
              $entered="OUT";
              $check='<button class="btn btn-primary fa  fa-sign-in" onclick="checkin('.$row['id'].')" disabled> Out </button>'
            ;
             }

          }



          else{
            if ($row['checkin_status']=='OUT' ) {
            $entered="OUT";
            $check='<button class="btn btn-primary fa  fa-sign-in" onclick="checkin('.$row['id'].')" disabled> Out </button>'
            ;
            $Date='<button class="btn btn-success fa fa-calendar" disabled=""></button>';
            }else{
            $entered="Not Yet In";
             $Date='<button class="btn btn-success fa fa-calendar" onclick="extenddat('.$row['id'].',\''.$row['date_out'].'\')"></button>';
            $check='<button class="btn btn-success fa  fa-sign-in" onclick="checkin('.$row['id'].')"> Check In</button>';}
          }






           echo '
             <tr>
                   <td>'.$i++.'</td>
                   <td>'.date("d/M/Y",strtotime($row['created_at'])).'</td>
                    <td>'.$row['gname'].'</td>
                      <td>'.$row['address'].'</td>
                      <td>'.$row['room_name'].' '.$row['room_no'].'</td>
                      <td>'.date("d/M/Y",strtotime($row['date_in'])).'</td>
                      <td>'.date("d/M/Y",strtotime($row['date_out'])).'</td>
                      <td>'.$entered.'</td>
                      <td>'.$pay.'</td>
                   <td>
                   '.$pay_btn.'
                    '.$check.'
                    '.$Date.'
                   </td>
                 </tr>

           ';
          }
              
            }    
           
                 ?>
          </tbody>     
          </table>
          <div class="col-md-12 form-group" style="text-align: center;">    
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
                <h4 class="modal-title">Book Room </h4>
              </div>
              <div class="modal-body">
              <div class="col-md-12">
                Select Room
                <SELECT class="form-control" name="rooms" onchange="populaterooms(this.value)">
                <?php 
                $room_sql="SELECT r.room_no,room_name,t.name,t.amount FROM rooms r,room_types t WHERE (t.id=r.room_type AND r.book_status=0) AND r.occupation_status=0 ";
                $getrooms=mysqli_query($con,$room_sql);
                if(mysqli_num_rows($getrooms)>0){
                  echo '<option disabled=""> Select Room </option>';
                while($rooms=mysqli_fetch_array($getrooms)){
                  echo '<option value="'.$rooms['room_no'].'">'.$rooms['room_no'].' '.$rooms['room_name'].':------------------------------: '.$rooms['name'].'</option>';
                }}else{
                  echo '<option disabled=No Free Rooms at at Moment </option>';
                }

                ?>
                </SELECT>
              </div>
<form action="make_booking.php" method="POST">              
             <div class="row">
            <strong>  Room Details</strong>
              <div class="col-md-12 form-group" >

                <div class="form-group col-md-3">
                  Room Number
                  <input type="text" name="room_no" class="form-control" id="room_no" readonly="" placeholder="Room Number" required="">
                </div>
                 <div class="form-group col-md-3">
                  Room Name
                  <input type="text" name="room_name" class="form-control" id="room_name" readonly="" placeholder="Room Name">
                </div>
                <div class="form-group col-md-3">
                  Room Type
                  <input type="text" name="type" class="form-control" id="type" readonly="" placeholder="Room Type">
                </div>
                 <div class="form-group col-md-3">
                  Room Rate
                  <input type="text" name="amount" class="form-control" id="amount" readonly="" placeholder="Room Rate">
                </div>
                
              </div>
            </div>
            <div class="row">
            <strong>  Guest Details</strong>
              <div class="col-md-12 form-group" >
                 <div class="form-group col-md-6">
                  Search Guest
                  <input type="text" id="guest" class="form-control"  placeholder="Guest Name" onkeyup="get_guest(this.value)" >
                </div>
                 <div class="form-group col-md-6">
                  Select Guest
                  <SELECT name="name" class="form-control" id="found_guest" onchange="populateguest(this.value)" >
                  <option>-- Select Guest --</option>
                  </SELECT>
                </div>
                <div class="form-group col-md-3">
                  Guest Name
                  <input type="text" name="name" class="form-control" id="name" placeholder="Guest Name" required="">
                </div>
                 <div class="form-group col-md-3">
                  ID No.
                  <input type="text" name="id_no" class="form-control" id="id_no" placeholder="ID Number">
                </div>
                <div class="form-group col-md-3">
                  Phone
                  <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" required="">
                </div>
                 <div class="form-group col-md-3">
                  Email
                  <input type="text" name="email" class="form-control" id="email" placeholder="Email" >
                </div>
                <div class="form-group col-md-3">
                  Address
                  <input type="text" name="address" class="form-control" id="address" placeholder="Address" required="">
                </div>
                <div class="form-group col-md-3">
                  Destination
                  <input type="text" name="destination" class="form-control" id="destiantion"  placeholder="Destination" required="">
                </div>
                <div class="form-group col-md-3">
                  Occupation
                  <input type="text" name="occupation" class="form-control" id="occupation" placeholder="Occupation">
                </div>
                <div class="form-group col-md-3">
                 Number Of Guests
                  <input type="number" name="no_of_guests" class="form-control" id="no_of_guests" placeholder="Number Of Guests" required="">
                </div>
                
              </div>
            </div> 


             <div class="row">
            <strong>  Duration Details</strong>
              <div class="col-md-12 form-group" >

                <div class="form-group col-md-4">
                  Booking Date 
                  <input type="text" name="booking_date" class="form-control" id="datepicker" placeholder="Booking Date" required="">
                </div>
                 <div class="form-group col-md-4">
                  From Date
                   <input type="text" class="form-control" id="datepicker1" placeholder="Reserved Dates" name="date1" >
                </div>
                 <div class="form-group col-md-4">
                  To Date
                   <input type="text" class="form-control" id="datepicker2" placeholder="Reserved Dates" name="date2">
                </div>
               
                 
                
              </div>
            </div> 
             <div class="row">

              <div class="col-md-12 form-group" style="text-align: center;" >
                <div class="form-group"><input type="checkbox" name="checkin" value="1"> Select this option if Guest is Checking In as Well</div>
                  <BUTTON class="btn-primary btn" type="submit">Submit</BUTTON>
                   <BUTTON class="btn-warning btn" type="reset">Clear</BUTTON>
              </div>
            </div>
       </form>                 
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
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
                  <form method="POST" action="room_transaction.php">
                  <input type="hidden" name="room_no" id="room">
                  <input type="hidden" name="booking" id="booking">
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
                <input type="text" name="trans_date" placeholder="Transaction date" id="datepicker3" class="form-control" >
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



            <div class="modal modal-primary fade" id="date" >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Extend Date </h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <form method="POST" action="update_bookingdate.php">
                  <div class="col-md-6">
                    New Date 
                   <input type="text" class="form-control" id="datepicker_new" placeholder="Reserved Dates" name="new_date" >
                   <input type="hidden" name="id" id="booking_id">
                  </div>
                  <div class="col-md-6">
                  <br>
                   <button class="btn btn-warning" type="submit">Update</button>
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

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>

function num_of_days(q){
var date1=document.getElementById("datepicker1").value;
var date2=document.getElementById("datepicker2").value
var firstDate= new Date(date1);
var secondDate= new Date(date2);
var oneDay=24*60*60*1000;
var diff=Math.round(Math.abs((firstDate.getTime()-secondDate.getTime())/(oneDay)));
//alert(diff);
document.getElementById("_days").value=diff;   
  
}

function populaterooms(q){
  
 $.ajax({
            type: 'POST',
            url: 'getroom_details.php',
            data: 'q='+q,
            dataType: 'json',
            cache: false,
            success: function(result) {
           $('#room_no').val(result['room_no']);
            $('#room_name').val(result['room_name']);
            $('#type').val(result['name']);
            $('#amount').val(result['amount']);
            },
        });
  
}

function populateguest(q){
  if (q=='') {
    alert("Select Guest Details Or Enter Fresh Record");
  }else{
  
 $.ajax({
            type: 'POST',
            url: 'getguest_details.php',
            data: 'q='+q,
            dataType: 'json',
            cache: false,
            success: function(result) {
           $('#name').val(result['name']);
            $('#id_no').val(result['id_no']);
            $('#phone').val(result['phone']);
            $('#email').val(result['email']);
            $('#address').val(result['address']);
            $('#destiantion').val(result['destination']);
            $('#occupation').val(result['occupation']);
            },
        });}
  
}

function get_guest(q){
  
 $.ajax({
            type: 'POST',
            url: 'get_guest.php',
            data: 'q='+q,
            dataType: 'html',
            cache: false,
            success: function(result) {
           $('#found_guest').html(result);
            // $('#room_name').val(result['room_name']);
            // $('#type').val(result['name']);
            // $('#amount').val(result['amount']);
            },
        });
  
}



function checkin(q){
  var r=confirm("Do you want to check in this booking?");
  if (r==true) {
 $.ajax({
            type: 'POST',
            url: 'checkin.php',
            data: 'q='+q,
            dataType: 'html',
            cache: false,
            success: function(result) {
           window.location.reload();
            },
        }); }
}
function checkout(q){
  var r=confirm("Do you want to check out this booking?");
  if (r==true) {
 $.ajax({
            type: 'POST',
            url: 'checkout.php',
            data: 'q='+q,
            dataType: 'html',
            cache: false,
            success: function(result) {
          window.location.reload();
            },
        }); }
}


function posttransaction(q,){
  var r=confirm("Are You Sure You Want to Post This Transaction?");

  if (r==true) {
      $('#modal-success').modal('show');

 $.ajax({
            type: 'POST',
            url: 'getbookingdetails.php',
            data: 'q='+q,
            dataType: 'json',
            cache: false,
            success: function(result) {
               $('#bill').val(result['amount']);
               $('#room').val(result['room']);
                $('#booking').val(result['book_id']); // window.location.reload();
                
        
            },
        });
}
    
  
}

function getbalance(bal){
  var bill=document.getElementById("bill").value;
  var balance=bal-bill;
  document.getElementById("balance").value=balance;

}

function extenddat(id,dateout){
$('#date').modal('show');
$('#datepicker_new').val(dateout);
$('#booking_id').val(id);


}



 $('#datepicker3').datepicker({
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

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    $('#datepicker1').datepicker({
      autoclose: true
    })
    $('#datepicker2').datepicker({
      autoclose: true
    })
     $('#datepicker_new').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>
