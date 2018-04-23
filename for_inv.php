 <form action="add_inventory.php" method="POST">
  <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Product</th>
              <th>Item Code</th>
              <th>Qty</th>
              <th>Description</th>
              <th>Rate</th>
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
              
              <td>'.$row_d['name'].'</td>
              <td>'.$row_d['item_code'].' <input type="hidden" name="codes[]" value="'.$row_d['item_code'].'"></td>
              <td><input type="text"  class="form-control"name="qty_'.$row_d['item_code'].'" value="'.$row_d['quantity'].'"></td>
              <td>'.$row_d['description'].'</td>
              <td>'.$row_d['rate'].'<input type="hidden" name="rate_'.$row_d['item_code'].'" value="'.$row_d['rate'].'"></td>
            </tr>';
               }
              }    
            

            ?>
            </tbody>
          </table>
          <div class="col-md-12">
            <div class="form-group col-md-4">
                <label>Date Purchased:</label>
                  <input type="hidden" name="po" value="<?php echo $id;?>">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker" onclick="showdatep()" name="date_purchased" placeholder="Date Purchased">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

             <div class="form-group col-md-4">
                <label>Purchased by:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="purchased_by" placeholder="Purchased By">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
            <div class="col-md-4">
              <br>
              <button class="btn btn-primary" type="Submit"> Add To Inventory</button>
            </div>
          </div>
        
        </form>