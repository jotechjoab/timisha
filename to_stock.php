<?php
require 'config.php';
$items="";
$sr="";
$qty="";
$in_store="";
$dept="";
	# code...

$items=$_GET['item_code'];
$sr=$_GET['sr'];
$qty=$_GET['qty'];
$in_store=$_GET['in_store'];
$dept=$_GET['dept'];

if (!empty($items)) {
	
$success=0;

	$units_required=$qty;
	$InStore=$in_store;

	if ($units_required>$InStore) {
		$data="Amount entered is more than amount available".mysqli_error($con);
  header("Location:process_sr.php?sr=".$sr."&dept=".$dept."&err=".$data."");
	}else{
$get_inv="SELECT item_code,batch_no,qty_in_store FROM inventories WHERE (status='Ready' AND deleted=0)AND (qty_in_store>0 AND item_code='$items') Order by qty_in_store ASC";
$units_required;
$storeM=mysqli_query($con,$get_inv);
$moved=0;
$counter=mysqli_num_rows($storeM);
$numrows=mysqli_num_rows($storeM);
$newVal=0;
// echo $counter;
$num=mysqli_num_rows($storeM);
// echo $num.'<br/>';

while($stm=mysqli_fetch_array($storeM)){
 $itm=$stm['qty_in_store'];
 $batchm=$stm['batch_no'];
//echo $units_required.'<br/>';
//echo $stm['qty_in_store']."<br>";
//echo $itm;



do {

	if($units_required>=$itm){
		$moved=$moved+$itm;
		$subtruct = $itm;
		$newVal=$itm-$subtruct;
		// echo 'Moved1:'. $moved.'  :: Subtructed1: '.$subtruct.':: new value: '.$newVal.' btz'. $batchm.'<br/>';

   $updateInv=mysqli_query($con,"UPDATE inventories set qty_in_store='$newVal' WHERE batch_no='$batchm'");

    if ($updateInv) {
    	$chek_sql=mysqli_query($con,"SELECT * FROM stocks where batch_no='$batchm'");
    	// echo 'Inventory Updated '.$batchm.'<br/>';
     	if (mysqli_num_rows($chek_sql)>0) {
  
while($ch=mysqli_fetch_array($chek_sql)){
$instoke=$ch['qty_in_stock'];
$computedStock=$instoke+$moved;
  $UpdateStock=mysqli_query($con,"UPDATE stocks set qty_in_stock='$computedStock' where batch_no='$batchm'");
            
           if ($UpdateStock) {
 //echo 'Stock updated 2'.$batchm.'<br/>';
 //return redirect('stocks');
           	mysqli_query($con,"UPDATE sr_details SET status=1 WHERE pdt_code='$items' AND details_grp_id='$sr'" );

            }

    		}
     	}else{
    	

 	$no = $dept;
    	$createStock=mysqli_query($con,"INSERT INTO stocks (item_code,batch_no,qty_in_stock,dept) VALUES('$items','$batchm','$moved','$no')");
     	if ($createStock) {
    	//return redirect('stocks');
     		// echo 'Stock created 1'.$batchm.'<br/>';
     		mysqli_query($con,"UPDATE sr_details SET status=1 WHERE pdt_code='$items' AND details_grp_id='$sr'" );

      	}else{
    		$data="Unable to Update Stock".mysqli_error($con);
  header("Location:process_sr.php?sr=".$sr."&dept=".$dept."&err=".$data."");
    	}

    	}
    }


	}else{
		$moved=$moved+$units_required;
		$subtruct = $units_required;
	      $newVal=$itm-$subtruct;

  $updateInv=mysqli_query($con,"UPDATE inventories set qty_in_store='$newVal' WHERE batch_no='$batchm'");

    if ($updateInv) {

    	$chek_sql=mysqli_query($con,"SELECT * FROM stocks where batch_no='$batchm'");
    	// $check=;
    	 //echo 'Inventory Updated2 '.$batchm.'<br/>';
    	if (mysqli_num_rows($chek_sql)>0) {
    		//$ch=array();
while($ch=mysqli_fetch_array($chek_sql)){
$instoke=$ch['qty_in_stock'];
$computedStock=$instoke+$moved;
 $UpdateStock=mysqli_query($con,"UPDATE stocks set qty_in_stock='$computedStock' where batch_no='$batchm '");
            
            if ($UpdateStock) {
            	// echo 'Stock updated 2'.$batchm.'<br/>';
            	mysqli_query($con,"UPDATE sr_details SET status =1 WHERE pdt_code='$items' AND details_grp_id='$sr'" );

// return redirect('stocks');

            }

    		}
    	}
    	else{
    	

    
	$no = $dept;
    	$createStock=mysqli_query($con,"INSERT INTO stocks (item_code,batch_no,qty_in_stock,dept) VALUES('$items','$batchm','$moved','$no')");
    	if ($createStock) {
	mysqli_query($con,"UPDATE sr_details SET status =1 WHERE pdt_code='$items' AND details_grp_id='$sr'" );
   
    	}else{
    		$data="Unable To create Stock".mysqli_error($con);
  header("Location:process_sr.php?sr=".$sr."&dept=".$dept."&err=".$data."");
    	}

    	}
    }

	//	 echo 'Moved3:'. $moved.'  :: Subtructed3: '.$subtruct.' :: new value: '.$newVal.' '.$batchm.'<br/>';
	}
	
	$units_required=$units_required-$itm;

	if($subtruct>=0 && $units_required<=0){
		$success=1;
		break 2;
	}else{

		$counter++;


	}
	

} while ($counter<=$numrows);
	
}

	}
	




if($success==1){
	$success=0;
$data="Stock Moved Successifully";
$update_sr=mysqli_query($con,"UPDATE sr_details SET status=1 WHERE pdt_code='$items' AND details_grp_id='$sr'" );

if($update_sr){
 header("Location:approve_sr.php?sr=".$sr."&dept=".$dept."&msg=".$data."");}else{
	echo mysqli_error($con);
}
 } 
else{
	$data="Couldn't Move Items ".mysqli_error($con);
header("Location:approve_sr.php?sr=".$sr."&dept=".$dept."&err=".$data."");
}

}


