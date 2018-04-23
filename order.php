<?php require 'session.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel Power-Timisha  | Make Order</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
 
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include 'header.php';?>
  <!-- Left side column. contains the logo and sidebar -->
<?php include 'aside.php';?>  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bar & Restaurant Menu
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Menu</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">
      <div class="col-md-12">
        <?php
            if (isset($_GET['err'])) {
              echo '<div class="alert alert-danger alert-dismissible" style="text-align:center;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                '.$_GET['err'].'
              </div>';
            }
             if (isset($_GET['msg'])) {
              echo '<div class="alert alert-success alert-dismissible" style="text-align:center;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Information!</h4>
                '.$_GET['msg'].'
              </div>';
            }


             ?>
</div>
 
    
  </div>
<div class="row">
  <div class="col-md-3">
  <div class="box">
            <div class="box-header">
              <h3 class="box-title">Make Order</h3>
              <i></i>
              <i class="btn-success fa fa-minus btn " onclick="minus_qty()"></i>
              <i class="btn-success fa fa-plus btn " onclick="add_qty()"></i>
              <i class="btn-danger fa fa-trash btn " onclick="remove_item()"></i>
          </div>
      <form method="POST" action="postorder.php" id="post_orders"> 
      <input type="hidden" name="user" value="<?php echo $info['id'];?>">   
            <div class="box-body"> 
              <table class="table  table-bordered table-hover">
                <thead>
                <tr>
                  <td>Name</td>
                  <td>Qty</td>
                  <td>Rate</td>
                  <td>Amount</td>
                </tr>
              </thead>
              <input type="hidden" name="active_item" id="active_item">
              <tbody id="orders">
                <?php
                $user=$info['id'];
                 $get="SELECT i.id,o.id as ido,i.name,i.price,o.qty FROM temp_order o, menu_items i WHERE o.session_id='$user' AND o.item=i.id";
  $my_order=mysqli_query($con,$get);
  $amoun='';
  if(mysqli_num_rows($my_order)>0){
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
  </tr>';}
                ?>
              </tbody>  
              </table>
            </div> 
  <div class="box-footer">
  <strong > Specify Paying Account </strong>
  <div class="form-group">
    <input type="radio" name="to_pay" value="Walkin"> Walkin  &nbsp
  <input type="radio" name="to_pay" value="Rooms"> Room &nbsp
  <input type="radio" name="to_pay" value="Clients"> Registered Client
  </div>
  <div class="form-group" id="acc">
   <input type="hidden" name="cust" value="1"> 
  </div>
   <div class="form-group ">
                Select Customer Location
                <SELECT class="form-control" name="places" id="places">
                <?php
                $p_sql="SELECT * FROM places";
                $p_query=mysqli_query($con,$p_sql);
                if (mysqli_num_rows($p_query)>0) {
                  $i=1;
                  while ($p_row=mysqli_fetch_array($p_query)) {
                echo '<option>'.$p_row['location'].'-'.$p_row['tbl'].'</option>';
                  }
                 }else{
                echo '<option disabled="">No Places Found</option>';
                 }
                
                ?>
              </SELECT>
</div>
  <div class="row">
    <button class="btn btn-app" type="submit">
   <i class="fa fa-send"></i> Make Order
  </button>
    <a class="btn btn-app" onclick="cancleorder(<?php echo $info['id'];?>)">
   <i class="fa fa-ban"></i> Cancel Order
  </a>
  
</div>
        </div> 
        </form>          
            </div>   


  </div>
  <div class="col-md-9">
    <div class="col-md-12">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Menu</h3>
             
          </div>
            <div class="box-body">    
<table class="table">
    <?php 
      $menu_sql="SELECT * FROM menu";
                $menu_query=mysqli_query($con,$menu_sql);

                if (mysqli_num_rows($menu_query)>0) {
                  $i=1;
                   $n='';

                  while ($m_row=mysqli_fetch_array($menu_query)) {
                    $n=$m_row['id'];
             $count=mysqli_num_rows(mysqli_query($con,"SELECT * FROM menu_items WHERE menu_id='$n'"));     
         echo '
      <div class="col-md-2">            
        <a class="btn btn-app" onclick="getmenuitems('.$m_row['id'].',\''.$m_row['name'].'\')">
        <span class="badge bg-green">'.$count.'</span>
          <!--<i class="fa fa-glass">--></i> '. ucwords(strtolower($m_row['name'])).'
          </a> 
  </div>
    ';
    
  }}
   ?>
</table>   

</div>
  </div>
</div>
    <div class="col-md-12">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title" id="title">Menu items</h3>
          </div>
            <div class="box-body" id="q_results">    

   

</div>
  </div>
</div>

</div>
</div>

 </section>
</div>
  <div class="modal fade" id="modal-default">
          <div class="modal-dialog" style="width: 1000px;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Menu </h4>
              </div>
              <div class="modal-body">
              <div class="col-md-12">
              <form method="POST" action="addmenu.php">  
                <div class="form-group col-md-6">
                <input type="text" name="name"  class="form-control" placeholder="Menu Name">
              </div>
               <div class="form-group col-md-6">
                <button class="btn btn-success"> Save Item</button>
              </div>
              </form>
              </div>
              
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  <div class="modal fade" id="additem">
          <div class="modal-dialog" style="width: 1000px;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Menu Item </h4>
              </div>
              <div class="modal-body">
              <div class="col-md-12">
              <form method="POST" action="addmenuitem.php">  
                <div class="form-group col-md-4">
                <input type="text" name="name"  class="form-control" placeholder="Item Name">
              </div>
              <div class="form-group col-md-4">
                <input type="text" name="description"  class="form-control" placeholder="Description">
              </div>
              <div class="form-group col-md-4">
                <input type="text" name="price"  class="form-control" placeholder="Price">
              </div>
              <div class="form-group col-md-4">
                Select Main Menu Category
                <SELECT class="form-control" name="menu_id">
                <?php
                $m_sql="SELECT * FROM menu";
                $m_query=mysqli_query($con,$m_sql);
                if (mysqli_num_rows($m_query)>0) {
                  $i=1;
                  while ($me_row=mysqli_fetch_array($m_query)) {
                echo '<option value="'.$me_row['id'].'">'.$me_row['name'].'</option>';
                  }
                 }else{
                echo '<option disabled="">No Menues Found</option>';
                 }
                
                ?>
              </SELECT>
              </div>
              <div class="form-group col-md-4">
                <br>
                <button class="btn btn-success">Save Menu Item</button>
              </div>
              </form>
              </div>
              
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>


  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2014-<?php echo date("Y");?> <a href="https://adminlte.io">Jotechnologies Uganda</a>.</strong> All rights
    reserved.
  </footer>

<?php  include 'control.php';?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="actions/users.js"></script>
<script>

$(document).ready(function(){
    
      $("input[name='to_pay']").on('click', function() {
         
            if($(this).val()=='Rooms'){
            var q=$(this).val();
               $.ajax({
            type: 'POST',
            url: 'gettopay.php',
            data: 'q='+q,
            dataType: 'html',
            cache: false,
            success: function(result) {
                //$('#content1').html(result[0]);
             
             document.getElementById("acc").innerHTML=result;
               
            },
        });
            }
            if($(this).val()=='Clients'){
       var q=$(this).val();
               $.ajax({
            type: 'POST',
            url: 'gettopay.php',
            data: 'q='+q,
            dataType: 'html',
            cache: false,
            success: function(result) {
                //$('#content1').html(result[0]);
             
             document.getElementById("acc").innerHTML=result;
               
            },
        });
            }
               if($(this).val()=='Walkin'){
            
             document.getElementById("acc").innerHTML='<input type="hidden" name="cust" value="1"> ';
         
            }   

        });
});


function getmenuitems(q,name){
  document.getElementById("title").innerHTML=name;
 $.ajax({
            type: 'POST',
            url: 'menuitems.php',
            data: 'q='+q,
            dataType: 'html',
            cache: false,
            success: function(result) {
                //$('#content1').html(result[0]);
             
             document.getElementById("q_results").innerHTML=result;
               
            },
        });

    
  
}
function makeorder(q,price){
//  document.getElementById("title").innerHTML=name;
  if (q=="") {
   
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
    document.getElementById("orders").innerHTML=this.responseText;
     //document.getElementById("msg").style.display="block";
  // window.location.reload();
    }
  }
  xmlhttp.open("GET","addorder.php?id="+q+"&price="+price,true);
 
  xmlhttp.send();

    
  
}

function activate(q){
  document.getElementById("active_item").value=q;
}
function add_qty(){
  var id=document.getElementById("active_item").value;
  if (id!='') {
  $.ajax({
            type: 'POST',
            url: 'addqty.php',
            data: 'q='+id,
            dataType: 'html',
            cache: false,
            success: function(result) {
                //$('#content1').html(result[0]);
             
             document.getElementById("orders").innerHTML=result;
               
            },
        });
}else{
  alert("Please Click The Item to Increase");
}

}
function minus_qty(){
  var id=document.getElementById("active_item").value;
    if (id!='') {
  $.ajax({
            type: 'POST',
            url: 'minusqty.php',
            data: 'q='+id,
            dataType: 'html',
            cache: false,
            success: function(result) {
                //$('#content1').html(result[0]);
             
             document.getElementById("orders").innerHTML=result;
               
            },
        });
}else{
  alert("Please Click The Item to Increase");
}  
}
function remove_item(){
  var id=document.getElementById("active_item").value;
   if(id!=''){
  var r =confirm("Are sure you want to remove this Item");

  if (r==true) {
$.ajax({
            type: 'POST',
            url: 'remove_item.php',
            data: 'q='+id,
            dataType: 'html',
            cache: false,
            success: function(result) {
                window.location.reload();
                
        
            },
        });


  }}else{
    alert("Please Select The Item to delete");
  }
}

function postorder(id,dept){
  

 $.post("postorder.php", { 
    q: id,
    dept:dept
}, function(data) {
   document.getElementById("orders").innerHTML=data;
});

    
  
}

function cancleorder(id){

  var r=confirm("Are you sure you want to cancle this order?");
  if (r==true) {
$.post("cancleorder.php", { 
    q: id
}, function(data) {
   document.getElementById("orders").innerHTML=data;
});

  } 
}


  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })

  $(document).ready(function(){
$('.carousel[data-type="multi"] .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));
  
  for (var i=0;i<4;i++) {
    next=next.next();
    if (!next.length) {
        next = $(this).siblings(':first');
    }
    
    next.children(':first-child').clone().appendTo($(this));
  }
});
});
</script>
</body>
</html>
