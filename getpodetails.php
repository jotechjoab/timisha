 <form action="updatepo.php" method="POST">
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
            echo '<input type="hidden" name="code" value="'.$id.'">';
               while ($row_d=mysqli_fetch_array($detail_query)) {
               echo '<tr>
              <td>'.$i++.'</td>
              <input type="hidden" name="id[]" value="'.$row_d['id'].'"> 
              <td>'.$row_d['name'].'</td>
              <td>'.$row_d['item_code'].'</td>
              <td><input type="text" class="form-control" value="'.$row_d['quantity'].'" name="qty_'.$row_d['id'].'"></td>
              <td>'.$row_d['description'].'</td>
              <td><input type="text" class="form-control" value="'.$row_d['rate'].'" name="rate_'.$row_d['id'].'"></td>
              <td><button type="button" class="btn btn-danger fa fa-trash"></button></td>
            </tr>';
               }
              }    
            

            ?>
            </tbody>
          </table>
          <button class="btn btn-primary" type="submit"> Update</button>
        </form>