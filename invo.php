<!DOCTYPE html>
<?php include 'session.php';?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TIMISHA | Invoice</title>
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
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <img src="dist/img/timisha.png" style="width: 100px;"></i>
            <small class="pull-right">Date: <?php  echo date("d/m/Y"); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->

   
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>TIMISHA HOTEL SOROTI LTD</strong><br>
            <i>Soak In Comfort</i> <br>
            P.O.Box 9494, Soroti<br>
            Phone: +256(0)773557719<br>
            Email: timishahotel@gmail.com
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <?php 
           $total=0;
           $amount=0;
      $cash=0;
      $change=0;
       $trans_code=$_POST['trans_code'];
       $details_grp_id=$_POST['group_id'];
             ?>
            <strong>Guest</strong><br>
            <br>
            Phone: <?php// echo $row_s['phone']; ?><br>
            Email: <?php //echo $row_s['email']; ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>ID: <?php echo $trans_code; ?></b><br>
         <!--  <br>
          <b>Order ID:</b> 4F3S8J<br>
          <b>Payment Due:</b> 2/22/2014<br>
          <b>Account:</b> 968-34567 -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
        <div class="col-md-12" style="text-align: center;"> CASH INVOICE</div>
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Product</th>
              <th>Item Code</th>
              <th>Qty</th>
              <th>Rate</th>
              <th>Amount</th>
            </tr>
            </thead>
            <tbody>
          <?php 
      

      $receipts=mysqli_query($con,"SELECT a.name as aname, p.name,p.id as item_code,i.quantity,i.rate,r.trans_code,i.details_grp_id,r.received_by,r.cash_tendered,r.amount_paid,r.change_returned from invoice_details i,receipts r,menu_items p,accounts a where (i.details_grp_id='$details_grp_id' AND r.trans_code='$trans_code') AND ((p.id=i.pdt_code) AND (a.id=r.received_by)) ");
      $rm=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM invoice_details WHERE details_grp_id='$details_grp_id'"));
      $num=substr($rm['pdt_code'], 2);
      $rooms=mysqli_query($con,"SELECT a.name as aname, p.room_no as name,i.pdt_code as item_code,i.quantity,i.rate,r.trans_code,i.details_grp_id,r.received_by,r.cash_tendered,r.amount_paid,r.change_returned from invoice_details i,receipts r,bookings p,accounts a where (i.details_grp_id='$details_grp_id' AND r.trans_code='$trans_code') AND ((p.id='$num') AND (a.id=r.received_by)) ");

          //$detail_query=mysqli_query($con,$sql_detail);
          if (mysqli_num_rows($receipts)>0) {
            $i=1;
               while ($row_d=mysqli_fetch_array($receipts)) {
               echo '<tr>
              <td>'.$i++.'</td>
              <td>'.$row_d['name'].'</td>
              <td>'.$row_d['item_code'].'</td>
              <td>'.$row_d['quantity'].'</td>
               <td>'.$row_d['rate'].'</td>
              <td>UGX '.$row_d['rate']*$row_d['quantity'].'</td>
            </tr>';
              $amount+=$row_d['rate']*$row_d['quantity'];
               }
              }else{
                 $i=1;
               while ($row_d=mysqli_fetch_array($rooms)) {
               echo '<tr>
              <td>'.$i++.'</td>
              <td>Room '.$row_d['name'].'</td>
              <td>'.$row_d['item_code'].'</td>
              <td>'.$row_d['quantity'].' Days</td>
               <td>'.$row_d['rate'].'</td>
              <td>UGX '.$row_d['rate']*$row_d['quantity'].'</td>
            </tr>';
              $amount+=$row_d['rate']*$row_d['quantity'];
              }}    

            ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <img src="dist/img/credit/visa.png" alt="Visa">
          <img src="dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="dist/img/credit/american-express.png" alt="American Express">
          <img src="dist/img/credit/paypal2.png" alt="Paypal">

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Thank You For Coming at Timisha Hotel . 
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
      <!--     <p class="lead">Amount Due 2/22/2014</p> -->

    <div class="table-responsive">
            <table class="table">
            <!--   <tr>
                <th>Tax (18%)</th>
 -->                <!-- <td>UGX <?php //echo number_format((18/118)*$amount);?></td> -->
              <!-- </tr> -->
              <tr>
                <th>Total:</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>UGX <?php echo number_format($amount);?></th>
              </tr>
              <tr>
                <th colspan="6" style="text-align: right;">
                  Signed By
                </th>
                
              </tr>
              <tr>
                <th colspan="6" style="text-align: right;">
               
                </th>
                
              </tr>
                <tr>
                <th colspan="6" style="text-align: right;">
               .................................................................
                </th>
                
              </tr>
                <tr>
                <th colspan="6" style="text-align: right;">
                 For Timisha Hotel
                </th>
                
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
