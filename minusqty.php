<?php
require 'config.php';
$id=$_POST['q'];
$get=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM temp_order WHERE id='$id'"));
$org=$get['qty'];
if ($org<=1) {
	$info=array();
session_start();
$info=$_SESSION['t_admin'];
if (count($info)==0) {
header("Location:index.php?err=please login Your Session Expired");
}
$user=$info['id'];
	$get="SELECT i.id,o.id as ido,i.name,i.price,o.qty FROM temp_order o, menu_items i WHERE o.session_id='$user' AND o.item=i.id";
	$my_order=mysqli_query($con,$get);
	$amoun='';
	while ($row=mysqli_fetch_array($my_order)) {
	echo '
	<tr  onclick="activate('.$row['ido'].')">
  <input type="hidden" name="ids[]" value="'.$row['id'].'">
  <td>'.$row['name'].'<input type="hidden" name="name_'.$row['id'].'" value="'.$row['name'].'"></td>
  <td>'.$row['qty'].'<input type="hidden" name="qty_'.$row['id'].'" value="'.$row['qty'].'"></td>
  <td>'.$row['price'].'<input type="hidden" name="price_'.$row['id'].'" value="'.$row['price'].'"></td>
  <td>'.$row['qty']*$row['price'].'<input type="hidden" name="amount_'.$row['id'].'" value="'.$row['qty']*$row['price'].'"></td>
  </tr>
	</tr>
	';	
		$unit=$row['qty']*$row['price'];
		$amoun+=$unit;
		
	}
	$vat=((18/118)*$amoun);
	echo'<tr>
	<td colspan="3">VAT:</td>
	<td>'.number_format($vat).'</td>
	</tr>';
	echo'<tr>
	<td colspan="3">Total:</td>
	<td>'.number_format($amoun).'</td>
	</tr>';
	echo '<tr><td colspan="3"><div class="alert alert-danger">Cant reduce anymore please Delete Item </div></td></tr>';
}else{
$new=$org-1;
$info=array();
session_start();
$info=$_SESSION['t_admin'];
$user=$info['id'];
$update=mysqli_query($con,"UPDATE temp_order set qty='$new' WHERE id='$id'");
if ($update) {
	$get="SELECT i.id,o.id as ido,i.name,i.price,o.qty FROM temp_order o, menu_items i WHERE o.session_id='$user' AND o.item=i.id";
	$my_order=mysqli_query($con,$get);
	$amoun='';
	while ($row=mysqli_fetch_array($my_order)) {
	echo '
	<tr  onclick="activate('.$row['ido'].')">
  <input type="hidden" name="ids[]" value="'.$row['id'].'">
  <td>'.$row['name'].'<input type="hidden" name="name_'.$row['id'].'" value="'.$row['name'].'"></td>
  <td>'.$row['qty'].'<input type="hidden" name="qty_'.$row['id'].'" value="'.$row['qty'].'"></td>
  <td>'.$row['price'].'<input type="hidden" name="price_'.$row['id'].'" value="'.$row['price'].'"></td>
  <td>'.$row['qty']*$row['price'].'<input type="hidden" name="amount_'.$row['id'].'" value="'.$row['qty']*$row['price'].'"></td>
  </tr>
	';	
		$unit=$row['qty']*$row['price'];
		$amoun+=$unit;
		
	}
	$vat=((18/118)*$amoun);
	echo'<tr>
	<td colspan="3">VAT:</td>
	<td>'.number_format($vat).'</td>
	</tr>';
	echo'<tr>
	<td colspan="3">Total:</td>
	<td>'.number_format($amoun).'</td>
	</tr>';
}else{
	$get="SELECT i.id,o.id as ido,i.name,i.price,o.qty FROM temp_order o, menu_items i WHERE o.session_id='$user' AND o.item=i.id";
	$my_order=mysqli_query($con,$get);
	$amoun='';
	while ($row=mysqli_fetch_array($my_order)) {
	echo '
	<tr  onclick="activate('.$row['ido'].')">
  <input type="hidden" name="ids[]" value="'.$row['id'].'">
  <td>'.$row['name'].'<input type="hidden" name="name_'.$row['id'].'" value="'.$row['name'].'"></td>
  <td>'.$row['qty'].'<input type="hidden" name="qty_'.$row['id'].'" value="'.$row['qty'].'"></td>
  <td>'.$row['price'].'<input type="hidden" name="price_'.$row['id'].'" value="'.$row['price'].'"></td>
  <td>'.$row['qty']*$row['price'].'<input type="hidden" name="amount_'.$row['id'].'" value="'.$row['qty']*$row['price'].'"></td>
  </tr>
	</tr>
	';	
		$unit=$row['qty']*$row['price'];
		$amoun+=$unit;
		
	}
	$vat=((18/118)*$amoun);
	echo'<tr>
	<td colspan="3">VAT:</td>
	<td>'.number_format($vat).'</td>
	</tr>';
	echo'<tr>
	<td colspan="3">Total:</td>
	<td>'.number_format($amoun).'</td>
	</tr>';
	echo '<tr><td colspan="3"><div class="alert alert-danger">Couldnt Increated Quantity </div></td></tr>';
}
}
