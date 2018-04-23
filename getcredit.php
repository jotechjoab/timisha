<?php
require 'config.php';
$id=$_POST['q'];
 $sql="SELECT j.id as jid,r.trans_code,j.account_dr,j.account_cr,r.balance_due,r.date_created,t.journal_id,t.trans_date,j.journal_type_id,r.created_by FROM receipts r, transactions t,journals j WHERE (r.trans_code=t.trans_code AND t.journal_id=j.id) AND r.trans_code='$id'";
        $query=mysqli_query($con,$sql);
        if (mysqli_num_rows($query)>0) {
          $i=1;
      
          $row=mysqli_fetch_array($query);
          echo json_encode($row);
          echo mysqli_error($con);
      }