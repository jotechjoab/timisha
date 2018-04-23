<!DOCTYPE html>
<?php include 'session.php';?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Invoice</title>
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

      <?php
      $grp_id='';
      if (isset($_GET['po'])) {
        $grp_id=$_GET['po'];
      }
      $sql_po="SELECT * FROM po WHERE details_grp_id='$grp_id'";
      $po_query=mysqli_query($con,$sql_po);
      $row_po=mysqli_fetch_array($po_query);
       ?>
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>Timisha Hotel Ltd Soroti</strong><br>
            Kyoga Avenue <br>
            P.O.Box 9494, Soroti<br>
            Phone: (804) 123-5432<br>
            Email: info@timishahotel.co.ug
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <?php 
            $s_id=$row_po['supplier_id'];
            $sql_supplier="SELECT * FROM suppliers WHERE id='$s_id'";
            $query_s=mysqli_query($con,$sql_supplier);
            $row_s=mysqli_fetch_array($query_s); 
             ?>
            <strong><?php echo $row_s['name']; ?></strong><br>
            <?php echo $row_s['address']; ?><br>
            Phone: <?php echo $row_s['phone']; ?><br>
            Email: <?php echo $row_s['email']; ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>PO #: <?php echo $grp_id; ?></b><br>
         <!--  <br>
          <b>Order ID:</b> 4F3S8J<br>
          <b>Payment Due:</b> 2/22/2014<br>
          <b>Account:</b> 968-34567 -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

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
              <th>Description</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
          <?php 
          $sql_detail="SELECT p.item_code,p.name,p.description,d.quantity,d.rate,d.unit_of_measure FROM products p , po_details d WHERE d.pdt_code=p.item_code AND d.details_grp_id='$grp_id'";
           $amount="";
          $detail_query=mysqli_query($con,$sql_detail);
          if (mysqli_num_rows($detail_query)>0) {
            $i=1;
               while ($row_d=mysqli_fetch_array($detail_query)) {
               echo '<tr>
              <td>'.$i++.'</td>
              <td>'.$row_d['name'].'</td>
              <td>'.$row_d['item_code'].'</td>
              <td>'.$row_d['quantity'].' '.$row_d['unit_of_measure'].'</td>
              <td>'.$row_d['description'].'</td>
              <td>UGX '.$row_d['rate']*$row_d['quantity'].'</td>
            </tr>';
              $amount+=$row_d['rate']*$row_d['quantity'];
               }
              }    

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
            <!-- s -->
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
      <!--     <p class="lead">Amount Due 2/22/2014</p> -->

    <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Tax (18%)</th>
                <td>UGX <?php echo number_format((18/118)*$amount);?></td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>UGX <?php echo number_format($amount);?></td>
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
