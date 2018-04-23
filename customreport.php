<!DOCTYPE html>
<?php
require __DIR__ . '/vendor/autoload.php';
//use Dompdf\Dompdf;
use Dompdf\Dompdf;
use Dompdf\Options;
//require 'vendor/autoload.php';
ob_start();
 include 'session.php';



?>
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
<body class="hold-transition skin-blue sidebar-mini" onload="PrintDiv('<?php echo 'Sales Report '.date("Y-m-d"); ?>')">
<div class="wrapper">
  <!-- Main content -->
   <section class="content" id="pdf">
        <div class="row" >
        <?php 
        $datefrom=date("Y-m-d",strtotime($_POST['from']))." 00:00:00";
        $dateto=date("Y-m-d",strtotime($_POST['to']))." 23:59:59";  
        ?>
        <div class="col-xs-12">
          <h2 class="page-header">
            <img src="dist/img/timisha.png" style="width: 100px;"></i>
            <small class="pull-right">Date: <?php  echo date("d/m/Y"); ?></small>
          </h2>
          <h3 style="text-align: center;"> Sales Report From <?php echo date("d  F, Y",strtotime($_POST['from']))." To ".date("d  F, Y",strtotime($_POST['to'])); ?></h3>
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
    $id=$_POST['user'];
    $type=$_POST['type'];

$id=$info['id']; 
$i=1;
$totalsum=0;
$food=0;
$bar=0;
$total_bar=0;
$total_food=0;
$paid=0;
$unpaid=0;
$total_paid=0;
$total_upaid=0;
if ($type=='ind_sales') {
$sql="SELECT i.details_grp_id,t.trans_date,p.id as item_code,p.name,d.quantity,d.rate,u.fname,u.lname,(d.quantity*d.rate) as totalprice,i.payment_status,p.dept FROM users u,menu_items p,invoice_details d, invoices i,transactions t WHERE  ((u.id=d.created_by AND p.id=d.pdt_code) AND (d.details_grp_id=i.details_grp_id)) AND((t.created_at=i.created_at))AND ( d.created_at BETWEEN '$datefrom' AND '$dateto') AND u.id='$id'   GROUP BY d.id ORDER BY `t`.`trans_date`  DESC";

}else{
 $sql="SELECT i.details_grp_id,t.trans_date,p.id as item_code,p.name,d.quantity,d.rate,u.fname,u.lname,(d.quantity*d.rate) as totalprice,i.payment_status,p.dept FROM users u,menu_items p,invoice_details d, invoices i,transactions t WHERE  ((u.id=d.created_by AND p.id=d.pdt_code) AND (d.details_grp_id=i.details_grp_id)) AND((t.created_at=i.created_at))AND ( d.created_at BETWEEN '$datefrom' AND '$dateto')  GROUP BY d.id
ORDER BY `t`.`trans_date`  DESC";
}

  






$results=mysqli_query($con,$sql);
if($results){
$color='#000';
?>
 <table  class="table table-bordered table-hover">
                <thead>
                <tr>
                <th>#</th>
                  <th>Date Sold</th>
                  <th>Item Code</th>
                  <th>Name</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>Paid</th>
                  <th>Unpaid</th>
                  <th>Food</th>
                  <th>Bar</th>
                  <th>Payment Status</th>
                  <th >Sold By</th>

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


if ($row['dept']==3) {
    $food=$row['totalprice'];
    $total_food+=$food;
    $bar=0;
  }else if($row['dept']==1){
    $bar=$row['totalprice'];
    $total_bar+=$bar;
    $food=0;
  }
if ($row['payment_status']=='Full') {
  $paid=$row['totalprice'];
  $unpaid=0;
  $total_paid+=$paid;
}else if($row['payment_status']=="partial"){
  $unpaid=$row['totalprice'];
  $paid=0;
  $total_upaid+=$unpaid;
}


    echo "<tr style='color:".$color.";'>";
    echo '<td>'.$i++.'</td>
       <td>'.date("d/M/Y",strtotime($row['trans_date'])).'</td>
       <td>'.$row['item_code'].'</td>
       <td>'.$row['name'].'</td>
       <td>'.$row['quantity'].'</td>
       <td>'.number_format($row['rate']).'</td>
       <td>'.number_format($paid).'</td>
       <td>'.number_format($unpaid).'</td>
       <td>'.number_format($food).'</td>
       <td>'.number_format($bar).'</td>
       <td>'.$row['payment_status'].'</td>
       <td>'.$row['fname'].' '. $row['lname'].'</td>

</tr>


    ';

    $totalsum+=$row['totalprice'];
  }
  echo "
<tr style=' font-weight: bold; '><td colspan='5'></td><td>Total: ".number_format($totalsum)."</td>
<td>Paid Amount: ".number_format($total_paid)."</td>
<td>Unpaid Amount: ".number_format($total_upaid)."</td>
<td>Food: ".number_format($total_food)."</td>
<td>Bar: ".number_format($total_bar)."</td>

</tr>";
 
}
}else
{
  echo "
<tr style=' font-weight: bold; '><td colspan='6'>". mysqli_error($con)."</td><td></td></tr>";
}
}
?>

 </tbody></table>

        



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
