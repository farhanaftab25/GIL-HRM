<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Admin Dashboard</title>

	<!-- Custom fonts for this template-->
	<link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	
	<!-- Custom styles for this template-->
	<link href="/css/main.min.css" rel="stylesheet">

	<!-- Custom styles for this page -->
	<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

	{{ $slot }}

	<!-- Bootstrap core JavaScript-->
	<script src="/vendor/jquery/jquery.min.js"></script>
	<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="/js/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  
	<!-- Page level custom scripts -->
	<script src="/js/demo/datatables-demo.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.1.0/echarts.min.js"></script>
	
	<script>
		$(document).ready(function() {
			$('#example').DataTable({
				"ordering": false
			});
			$('#total-Salary').click(function(){
				// AJAX request
				$.ajax({
				url: '/getSalary',
				type: 'get',
				success: function(response){ 
					// Add response in Modal body
					let tr = '';
					let totalSalary = 0;
					for (let index = 0; index < response.length; index++) {
						const element = response[index];
						tr = tr + `<tr>
									<th scope="row">${index + 1}</th>
									<td>${element.name}</td>
									<td>${element.designation.title}</td>
									<td>${element.salary}</td>
                        		</tr>`;
						totalSalary = totalSalary + element.salary;
					}
					$('#table-body').html(tr);
					$('#total-salary').html(totalSalary);
					// Display Modal
					$('#totalSalary').modal('show'); 
				}
				});
			});
			
		});
	</script>
</body>
</html>