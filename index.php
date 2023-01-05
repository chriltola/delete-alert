

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>How to Delete Table Row using Sweetalert2 with PHP/MySQLi</title>
	<link rel="stylesheet" type="text/css" href="asset/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="asset/sweet_alert/sweetalert2.min.css">
	<!--Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css">
	<style type="text/css">
		.mt20{
			margin-top:20px;
		}
	</style>
</head>
<body>
	<div class="container">
		<h3 class="text-center mt20 mb5">How to delete Table Row using Sweetalert2</h3>
		<div class="card col-md-6 my-6 ">
			<form class="forms-sample" method="post" enctype="multipart/form-data" class="form-horizontal">

				<div class="row ">
					<div class="form-group col-md-12">
						<label >First Name</label>
						<input type="text" type="text" id="name" name="name" placeholder="First name"  class="form-control" required />
					</div>
				</div>
				<div class="row ">
					<div class="form-group col-md-12">
						<label >Last Name</label>
						<input type="text" id="lastname" name="lastname" placeholder="Enter Last name"  class="form-control" required />
					</div>
				</div>
				<div class="row ">
					<div class="form-group col-md-12">
						<label >Address</label>
						<input type="text" id="address" name="address" placeholder="Enter Address"  class="form-control" required />
					</div>
				</div>
				<button type="submit" name="submit" value="Submit"  class="btn btn-primary  mr-2 mb-4">Save</button>
			</form>
			
		</div>
		<div class="row col-md-12 ">
			<table class="table table-bordered mt20">
				<thead>
					<th>No.</th>
					<th>Firstname</th>
					<th>Lastname</th>
					<th>Address</th>
					<th>Action</th>
				</thead>
				<tbody id="tbody">

				</tbody>
			</table>
		</div>
	</div>

	<script src="asset/jquery.min.js"></script>
	<script src="asset/bootstrap/js/bootstrap.min.js"></script>
	<script src="asset/sweet_alert/sweetalert2.min.js"></script>
	<!-- <script src="asset/app.js"></script> -->
	<?php
	session_start();
	error_reporting(0);
	$conn = new mysqli('localhost', 'root', '', 'mydatabase');
	if(isset($_POST['submit']))
	{
		$name=$_POST['name'];
		$lastname=$_POST['lastname'];
		$address=$_POST['address'];
		$query=mysqli_query($conn,"insert into members(firstname,lastname,address) values('$name','$lastname', '$address')");
		if($query)
			{?>
				<script >
					swal.fire({
						'title': 'Thank you',
						'text': 'Saved successfuly',
						'icon': 'success',
						'type': 'success'
					})
				</script>
				<?php	  
			}
			else
			{
				$_SESSION['errmsg']="Data not inserted";
			}
		}
		?>
		<script type="text/javascript">
				// $(function(){
				// 	swal.fire({
				// 		'title': 'Hello world',
				// 		'text': 'This is from sweet alert2',
				// 		'icon': 'success',
				// 		'type': 'success'
				// 	})

				// });
			</script>
			<script type="text/javascript">
				$(document).ready(function(){
					fetch();

					$(document).on('click', '.delete_product', function(){
						var id = $(this).data('id');

						swal.fire({
							title: 'Are you sure?',
							text: "You won't be able to revert this!",
							icon: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Yes, delete it!',
						}).then((result) => {
							if (result.value){
								$.ajax({
									url: 'api.php?action=delete',
									type: 'POST',
									data: 'id='+id,
									dataType: 'json'
								})
								.done(function(response){
									swal.fire('Deleted!', response.message, response.status);
									fetch();
								})
								.fail(function(){
									swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
								});
							}

						})

					});
				});

				function fetch(){
					$.ajax({
						method: 'POST',
						url: 'api.php',
						dataType: 'json',
						success: function(response){
							$('#tbody').html(response);
						}
					});
				}
			</script>
		</body>
		</html>