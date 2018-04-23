<?php
require 'config.php';
$q=$_POST['q'];
$sql="SELECT * FROM products WHERE name lIKE '%$q%'";
$query=mysqli_query($con,$sql);
if (mysqli_num_rows($query)>0) {
	while ($row=mysqli_fetch_array($query)) {
		echo '
		 <div class="box box-solid">
            <div class="box-header with-border">
          <p class="timeline-header no-border"><a href="addpo.php?code='.$row['item_code'].'">'.$row['name'].'</a> '.$row['description'].'</p>
            </div>
            <!-- /.box-header -->
         
          </div>
          <!-- /.box -->
        </div>
		
		'	;
	}
}