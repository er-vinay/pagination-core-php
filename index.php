<?php
	$conn = mysqli_connect('localhost', "root", "", "tbl_chat");
	if(mysqli_connect_errno()){
		print_r("connection Failed : \n", mysqli_connect_errno());
		exit;
	}
	$limit = 10;  
	if (isset($_GET["page"])) {
		$page  = $_GET["page"];
	} else { 
		$page=1; 
	};  
	$start_from = ($page-1) * $limit;
	$query = mysqli_query($conn, "SELECT * from users order by id desc limit $start_from, $limit");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Pagination</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
		<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/pagination.css" />
		<script src="js/pagination.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3>Pagination</h3>
					<table class="table table-responsive table-hover table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Address</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; while($row = mysqli_fetch_array($query)){ ?>
							<tr>
								<td><?= $i; ?></td>
								<td><?= $row['name']; ?></td>
								<td><?= $row['email']; ?></td>
								<td><?= $row['phone']; ?></td>
								<td><?= $row['address']; ?></td>
								<td><a href="">Edit</a></td>
							</tr>
							<?php $i++; } ?>
						</tbody>
					</table>
					<?php   
						$rs_result = mysqli_query($conn, "SELECT COUNT(id) FROM users"); 
						$row = mysqli_fetch_row($rs_result);  
						$total_records = $row[0]; 
						$total_pages = ceil($total_records / $limit);  
						$pagLink = "<nav><ul class='pagination'>";  
						for ($i = 1; $i <= $total_pages; $i++) { 
						    $pagLink .= "<li><a class='btn btn-primary' href='index.php?page=". $i ."'>".$i."</a></li>";  
						};
						echo $pagLink . "</ul></nav>";
					?>

			        <script type="text/javascript">
			            $(document).ready(function(){
			            	$('.pagination').pagination({
			                    items: <?php echo $total_records;?>,
			                    itemsOnPage: <?php echo $limit;?>,
			                    cssStyle: 'light-theme',
			                    currentPage : <?php echo $page;?>,
			                    hrefTextPrefix : 'index.php?page='
			                });
		                });
		            </script>
				</div>
			</div>
		</div>
	</body>
</html>