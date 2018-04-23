function getuser(id){
 $.ajax({
            type: 'POST',
            url: 'populateuser.php',
            data: 'id='+id,
            dataType: 'json',
            cache: false,
            success: function(result) {
                //$('#content1').html(result[0]);
                $('#edituser').modal('show');
                $('#fname').val(result['fname']);
                $('#lname').val(result['lname']);
                $('#oname').val(result['other_name']);
                $('#username').val(result['username']);
                $('#password').val(result['password']);
                $('#email').val(result['email']);
                $('#phone').val(result['phone_no']);
                $('#oldimage').val(result['avater_path']);
                $('#uid').val(result['id']);
                // var output = document.getElementById('cphoto');
                // output.src=result['image_url'];
            },
        });

}
function deleteuser(id){
	var r=confirm("Are You Sure you want to delete This User");

	if (r==true) {
		$.ajax({
            type: 'POST',
            url: 'deleteuser.php',
            data: 'id='+id,
            dataType: 'json',
            cache: false,
            success: function(result) {
                //$('#content1').html(result[0]);
                if (result['status']==1) {
                	window.location.reload();
                }else{
                	window.location.reload();
                }
                // var output = document.getElementById('cphoto');
                // output.src=result['image_url'];
            },
        });

	}

}

function roles(id){
    $('#roles').modal('show');
document.getElementById("rid").value=id;
}