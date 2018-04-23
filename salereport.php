<?php

if (isset($_GET['from'])) {
require 'config.php';
	//$con=mysqli_connect('localhost','root','','suspro');
	if (!$con) {echo 
	'connection error';
	}
	else{
$datefrom=date("Y-m-d",strtotime($_GET['from']))." 00:00:00";
$dateto=date("Y-m-d",strtotime($_GET['to']))." 23:59:59";		
$i=1;
$totalsum=0;
// $sql="SELECT i.details_grp_id,t.trans_date,p.item_code,p.name,d.quantity,p.unit_of_measure,d.rate,u.fname,u.lname,(d.quantity*d.rate) as totalprice,i.payment_status FROM users u,products p,invoice_details d, invoices i,transactions t WHERE (t.trans_date BETWEEN '".$datefrom."' AND '".$dateto."') AND (u.id=d.created_by AND p.item_code=d.pdt_code) AND (d.details_grp_id=i.details_grp_id) AND (t.created_at=i.created_at)";
$sql="SELECT i.details_grp_id,t.trans_date,t.trans_code,p.id as item_code,p.name,d.quantity,d.rate,u.fname,u.lname,(d.quantity*d.rate) as totalprice,i.payment_status FROM users u,menu_items p,invoice_details d, invoices i,transactions t WHERE  (t.trans_date BETWEEN '".$datefrom."' AND '".$dateto."') AND (u.id=d.created_by AND p.id=d.pdt_code) AND (d.details_grp_id=i.details_grp_id) AND (t.created_at=i.created_at)";
$results=mysqli_query($con,$sql);
if($results){
$color='#000';
echo "<h3 style='text-align:center'>TIMISHA HOTEL Sales Report from ".date("d/M/Y",strtotime($datefrom))." to ".date("d/M/Y",strtotime($dateto))."</h3>";
	echo '<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>#</th>
                  <th>Date Sold</th>
                  <th>Item Code</th>
                  <th>Name</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>Total Cost</th>
                  <th>Payment Status</th>
                  <th >Sold By</th>

                </tr>
                </thead>
                <tbody>';
if (mysqli_num_rows($results)>0) {

	while ($row=mysqli_fetch_array($results)) {

if ($row['payment_status']=='partial') {
	$color="red";
	
}else{
	$color="#000";
	
}



		echo "<tr style='color:".$color.";'>";
		echo '<td>'.$i++.'</td>
			 <td>'.$row['trans_date'].'</td>
			 <td>'.$row['item_code'].'</td>
			 <td>'.$row['name'].'</td>
			 <td>'.$row['quantity'].'</td>
			 <td>'.number_format($row['rate']).'</td>
			 <td>'.number_format($row['totalprice']).'</td>
			 <td>'.$row['payment_status'].'</td>
			 <td>'.$row['fname'].' '. $row['lname'].'</td>
			 <td><a href="#" onclick="reprint(\''.$row['details_grp_id'].'\',\''.$row['trans_code'].'\')"><i class="fa fa-print" style="color:green;"></i></a></td>

</tr>


		';

		$totalsum+=$row['totalprice'];
	}
	echo "
<tr style=' font-weight: bold; '><td colspan='7'>Total</td><td>".number_format($totalsum)."</td></tr>

	</tbody></table";
}
}else
{
	echo mysqli_error($con);
}
}
}
?>
