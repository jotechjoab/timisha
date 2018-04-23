 <?php 

 require 'config.php';
 $q=$_POST['q'];
      $menu_sql="SELECT i.id,i.name,i.price,sum(s.qty_in_stock) as stock,i.item_code FROM menu_items i LEFT JOIN stocks s ON i.item_code=s.item_code WHERE i.menu_id='$q' GROUP BY i.id";
                $menu_query=mysqli_query($con,$menu_sql);

                if (mysqli_num_rows($menu_query)>0) {
                  $i=1;
                   $n='';

                  while ($m_row=mysqli_fetch_array($menu_query)) {
                      if ($m_row['item_code']!='') {
                
                        if ($m_row['stock']<=0) {
                        echo '
      <div class="col-md-2" >            
        <a class="btn btn-app">
        <span class="badge bg-orange">Out Of Stock <span class="badge bg-green">'.$m_row['stock'].'</span></span>
        
          <!--<i class="fa fa-glass">--></i> '. ucwords(strtolower($m_row['name'])).'

          </a> 
          
  </div>
    ';   
                        }else{
       echo '
      <div class="col-md-2" onclick="makeorder('.$m_row['id'].','.$m_row['price'].')">            
        <a class="btn btn-app">
        <span class="badge bg-orange">UGX: '.number_format($m_row['price']).'  <span class="badge bg-green">'.$m_row['stock'].'</span></span>
        
          <!--<i class="fa fa-glass">--></i> '. ucwords(strtolower($m_row['name'])).'
         
          </a>
            
  </div>
    ';                     

                        }

                      }else{
         echo '
      <div class="col-md-2" onclick="makeorder('.$m_row['id'].','.$m_row['price'].')">            
        <a class="btn btn-app">
        <span class="badge bg-orange">UGX: '.number_format($m_row['price']).'</span>
          <!--<i class="fa fa-glass">--></i> '. ucwords(strtolower($m_row['name'])).'
          </a> 
  </div>
    ';}
    
  }}else{
    echo '<div class="alert alert-danger " style="text-align:center;">No Items Found</div>';
  }
   ?>  
