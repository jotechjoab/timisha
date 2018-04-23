 <form action="approve_po.php" method="POST">
  <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Product</th>
              <th>Item Code</th>
              <th>Qty</th>
              <th>Description</th>
              <th>Rate`</th>
              <th>Action`</th>
            </tr>
            </thead>
            <tbody>
          <?php 
          require 'config.php';
          $id=$_POST['q'];
          $sql_detail="SELECT d.id,p.item_code,p.name,p.description,d.quantity,d.rate,d.unit_of_measure FROM products p , po_details d WHERE d.pdt_code=p.item_code AND d.details_grp_id='$id'";
          $detail_query=mysqli_query($con,$sql_detail);
          if (mysqli_num_rows($detail_query)>0) {
            $i=1;
               while ($row_d=mysqli_fetch_array($detail_query)) {
               echo '<tr>
              <td>'.$i++.'</td>
              <input type="hidden" name="id[]" value="'.$row_d['id'].'"> 
              <td>'.$row_d['name'].'</td>
              <td>'.$row_d['item_code'].'</td>
              <td>'.$row_d['quantity'].'</td>
              <td>'.$row_d['description'].'</td>
              <td>'.$row_d['rate'].'</td>
              <td><button type="button" class="btn btn-danger fa fa-trash"></button></td>
            </tr>';
               }
              }    
            

            ?>
            </tbody>
          </table>
          <div class="col-md-12">
            <div class="col-md-4">
              Select Payment Status
              <input type="hidden" name="code" id="code" value="<?php echo $id;?>">
              <SELECT class="form-control" name="payment_status" id="payment_status">
                <option>None</option>
                <option>Partial</option>
                <option>Full</option>
              </SELECT>
            </div>
             <div class="col-md-4">
              Select Approval Status
              <SELECT class="form-control" name="approval_status" id="approval_status">
                <option>Pending</option>
                <option>Rejected</option>
                <option>Approved</option>
              </SELECT>
            </div>
            <div class="col-md-4">
              <br>
              <button class="btn btn-primary" type="Submit"> Submit Request</button>
            </div>
          </div>
        
        </form>