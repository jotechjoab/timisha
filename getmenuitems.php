 <?php
 
 require 'config.php';
 $id=$_POST['q'];
                $menu_sql="SELECT * FROM menu_items WHERE menu_id='$id'";
                $menu_query=mysqli_query($con,$menu_sql);
                if (mysqli_num_rows($menu_query)>0) {
                  $i=1;
                  while ($m_row=mysqli_fetch_array($menu_query)) {
                    echo '<tr>
                  <td>'.$i++.'.</td>
                  <td>'.$m_row['name'].'</td>
                  <td>
                   '.$m_row['description'].'
                  </td>
                  <td>'.$m_row['price'].'</td>
                  <td>
                  <button class="btn btn-success fa fa-edit" onclick="edititem('.$m_row['id'].')"></button>
                  <button class="btn btn-danger fa fa-trash"onclick="deleteItem('.$m_row['id'].')"></button>
                  </td>
                </tr>';
                  }
                 }else{
                  echo '<tr><td colspan="4">No results Found '.mysqli_error($con).'</td></tr>';
                 } 
                
                ?>