<!DOCTYPE html>
<?php include 'session.php';?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Timisha  | Custom Report</title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="PrintDiv('Receipt Report')">
<div class="wrapper">
  <!-- Main content -->
   <section class="invoice" id="pdf">
        <div class="row">
        <?php 
        $datefrom=date("Y-m-d",strtotime($_POST['from']))." 00:00:00";
        $dateto=date("Y-m-d",strtotime($_POST['to']))." 23:59:59";  
        ?>
        <div class="col-xs-12">
          <h2 class="page-header">
            <img src="dist/img/timisha.png" style="width: 100px;">
            <small class="pull-right">Date: <?php  echo date("d/m/Y"); ?></small>
          </h2>
          <h3 style="text-align: center;"> Receipts Report From <?php echo date("d  F, Y",strtotime($_POST['from']))." To ".date("d  F, Y",strtotime($_POST['to'])); ?></h3>
        </div>
        <!-- /.col -->
      </div>
     <div class="row">
       <div class="col-md-12">
         <?php 
         require 'config.php';
        if (!$con) {echo 
  'connection error';
  }
  else{
$datefrom=date("Y-m-d",strtotime($_POST['from']))." 00:00:00";
$dateto=date("Y-m-d",strtotime($_POST['to']))." 23:59:59";     
$i=1;
$totaltender=0;
$totalpaid=0;
$totalbaldue=0;
$sql="SELECT r.id,t.trans_date,r.trans_code,a.name,r.paymt_mode,r.cash_tendered,r.amount_paid,r.change_returned,r.balance_due,u.fname,u.lname FROM users u,accounts a,receipts r,transactions t WHERE (u.id=r.created_by AND a.id=r.received_by) AND (r.trans_code=t.trans_code AND t.trans_date BETWEEN '$datefrom' AND '$dateto') AND t.description LIKE '%Booking%'";
$results=mysqli_query($con,$sql);
if($results){
$color='#000';
  echo  "<h3 style='text-align:center'>Timisha Hotel Room Receipts Report </h3>";
  echo '<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>#</th>
                  <th>Date Created</th>
                  <th>Receipt No.</th>
                  <th>Received FROM</th>
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
<td>Total Amount: ".number_format($totalpaid)."</td><td>Total Cash Tendered: ".number_format($totaltender)."</td><td></td><td>Total Balance: ".number_format($totalbaldue)."</td></tr>

  </tbody></table";
}
}else
{
  echo mysqli_error($con);
}
}

?>


        



       </div>
     </div>
    </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<script src="dist/html2pdf.bundle.min.js"></script>
     <script> 
      function PrintDiv(name)
{
var element = document.getElementById('pdf');
html2pdf(element, {
  margin:       0.3,
  filename:     name+'.pdf',
  image:        { type: 'jpeg', quality: 0.98 },
  html2canvas:  { dpi: 192, letterRendering: true },
  jsPDF:        { unit: 'in', format: 'A4', orientation: 'landscape' }
});
}



    </script>
</body>
</html>
