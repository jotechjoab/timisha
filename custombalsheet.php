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
<body class="hold-transition skin-blue sidebar-mini" onload="PrintDiv('<?php echo 'Balance Sheet '.date("Y-m-d"); ?>')">
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
          <h3 style="text-align: center;"> Income And Expenditure Statement From  <?php echo date("d  F, Y",strtotime($_POST['from']))." To ".date("d  F, Y",strtotime($_POST['to'])); ?></h3>
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
?>
<table class="table table-bordered table-hover " id="example1">
               <thead>
                 <tr>
                   <th>#</th>
                   <th>Date</th>
                   <th>Total Expenditure </th>
                   <th>Accumulative Total</th>
                   <th>Imprest Amount</th>
                   <th>Gross Profit</th>
                  
                 </tr>
               </thead>
          <tbody>
          <?php
         $receipts=mysqli_query($con,"SELECT SUM(amount_paid) AS daySum,date_created FROM receipts WHERE date_created BETWEEN '$datefrom' AND '$dateto' GROUP BY YEAR(date_created), MONTH(date_created), DAY(date_created)"); 
         if (mysqli_num_rows($receipts)>0) {
          $main=0;
           $total=0; 
          $imp_t=0;
          $gross=0;
          while($exp=mysqli_fetch_array($receipts)){
$date=date("Y-m-d",strtotime($exp['date_created']));
 $sql="SELECT * FROM expenditures WHERE exp_date='$date'";
        $query=mysqli_query($con,$sql);
        // if (mysqli_num_rows($query)>0) {
          $i=1;
        
       
          while ($row=mysqli_fetch_array($query)) {
            $total=$row['bank_pay']+$row['salaries']+$row['kitchen']+$row['bevarage']+$row['staff_food']+$row['charcoal']+$row['gas']+$row['electricity']+$row['security']+$row['house_keeping']+$row['front_office']+$row['transport']+$row['repairs']+$row['f_b_restaurant']+$row['compound']+$row['water']+$row['newspaper']+$row['stationary']+$row['liquid_soap'];
         //$main=$total;
        
           
          }
              
       $main+=$total;        
            // } else{
            //     echo mysqli_error($con);
            // } 
       $imp_t+=$exp['daySum'];
       $gross+=$exp['daySum']-$total;
 
            echo '
             <tr>
                   <td>'.$i++.'</td>
                   <td>'.date("d/M/Y",strtotime($exp['date_created'])).'</td>
                   <td>'.number_format($total).'</td>
                   <td>'.number_format($main).'</td>
                   <td>'.number_format($exp['daySum']).'</td>
                   <td>'.number_format($exp['daySum']-$total).'</td>
                  
                 </tr>

           ';  
          }

     echo '
     <tr>
     <td>Total</td>
     <td></td>
     <td></td>
     <td></td>
     <td>'.number_format($imp_t).'</td>
     <td>'.number_format($gross).'</td>
     </tr>

     ';     
         }
       
  echo mysqli_error($con);         
                 ?>
          </tbody>     
          </table>

        



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
