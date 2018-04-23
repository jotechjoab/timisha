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
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
   <section class="invoice">
        <div class="row">
        <?php 
        $datefrom=date("Y-m-d",strtotime($_POST['from']))." 00:00:00";
        $dateto=date("Y-m-d",strtotime($_POST['to']))." 23:59:59";  
        ?>
        <div class="col-xs-12">
          <h2 class="page-header">
            <img src="dist/img/timisha.png" style="width: 100px;"></i>
            <small class="pull-right">Date: <?php  echo date("d/m/Y"); ?></small>
          </h2>
          <h3 style="text-align: center;"> Sold Items  Report From <?php echo date("d  F, Y",strtotime($_POST['from']))." To ".date("d  F, Y",strtotime($_POST['to'])); ?></h3>
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
?>

 <table class="table table-bordered table-hover" id="example1">
               <thead>
                 <tr>
                   <th>#</th>
                   <th>Item code</th>
                   <th>Name</th>
                   <th>Qty Sold</th>
                   <th>Price</th>
                    <th>Amount</th>
                 </tr>
               </thead>
          <tbody>
          <?php
        $sql="SELECT m.name,m.id,m.item_code,sum(i.quantity) as sold, m.price FROM invoice_details i,menu_items m WHERE (m.id=i.pdt_code AND i.created_at BETWEEN '$datefrom' AND '$dateto') AND m.id IN (SELECT id FROM `menu_items` WHERE item_code!='' ) GROUP BY m.item_code  ";
        $query=mysqli_query($con,$sql);
        if (mysqli_num_rows($query)>0) {
          $i=1;
     
          while ($row=mysqli_fetch_array($query)) {
           echo '
             <tr>
                   <td>'.$i++.'</td>
                   <td>'.$row['item_code'].'</td>
                   <td>'.$row['name'].'</td>
                   <td>'.$row['sold'].'</td>
                    <td>'.number_format($row['price']).'</td>
                   <td>'.number_format($row['price']*$row['sold']).'</td>
                 </tr>

           ';
          }
              
            }    
           
                 ?>
          </tbody>     
          </table>


<?php


}

?>


        



       </div>
     </div>
    </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
