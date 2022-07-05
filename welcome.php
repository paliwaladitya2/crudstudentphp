<?php
    session_start();
    if($_SESSION['loggedin']!="true" || ($_SESSION['loggedin']!=true)){
       header("location: login.php");
       exit;
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - <?php echo $_SESSION['email']; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
	<?php
        require_once "components/db.php";
        require 'components/navbar.php';
		echo '<h1 class=text-center>Welcome</h1>';
        	
        		echo '<div class="container-fluid">';	
				 	echo '<div class="row">';
                		echo '<div class="col-md-12">';
                    		echo '<div class="mt-5 mb-3 clearfix" margin: auto;>';	
								echo '<h2 class="text-center">Student Details</h2>';
                        		echo '<a href="create.php" class="btn btn-success"><i class="fa fa-plus"></i> Add New Student</a>';
                    			echo '</div>';
                    			echo '<br>';
                    			$sql = "SELECT * FROM student order by id ASC;";
                    			if($result = mysqli_query($con, $sql))
								{
                        			if(mysqli_num_rows($result) > 0)
									{
										echo '<table class="table table-bordered table-striped">';
												echo "<thead>";
													echo "<tr>";
														echo "<th>Roll. No</th>";
														echo "<th>Name</th>";
														echo "<th>Class</th>";
														echo "<th>Section</th>";
														echo "<th>Country</th>";
														echo "<th>State</th>";
														echo "<th>City</th>";
														echo "<th>Student Image</th>";
													echo "</tr>";
												echo "</thead>";
											echo "<tbody>";
												while($row = mysqli_fetch_array($result)){
												
												echo "<tr>";
													echo "<td>" . $row['id'] . "</td>";
													echo "<td>" . $row['name'] . "</td>";
													echo "<td>" . $row['class'] . "</td>";
													echo "<td>" . $row['section'] . "</td>";
													echo "<td>" . $row['country'] . "</td>";
													echo "<td>" . $row['state'] . "</td>";
													echo "<td>" . $row['city'] . "</td>";
													echo "<td>" . $row['image']."</td>";
													echo "<td>";
														
														echo '<a href="update.php?id='. $row['id'] .'" class="mr-3 btn btn-secondary" title="Update Details" data-toggle="tooltip"><span class="fa fa-pencil"></span></a></td>';
													
													echo "<td>";	
														echo '<a href="javascript:void(0)" title="Delete Student" class="delete_btn_ajax btn btn-danger" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
														echo '<input type="hidden" class="delete_id_value" value='.$row["id"].'></td>';	
												echo "</tr>";
												}
											echo "</tbody>";                            
                            			echo "</table>";
                            			mysqli_free_result($result);
                        		} 
								else
								{
                            		echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        		}
                    		} 
							else
							{
                        		echo "Oops! Something went wrong. Please try again later.";
                    		}
					echo '</div>';
					
					echo '</div>';
					echo '</div>';
        mysqli_close($con);
        ?>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style>
		.center {
  			margin: 0;
  			position: absolute;
  			top: 50%;
  			left: 50%;
  			-ms-transform: translate(-50%, -50%);
  			transform: translate(-50%, -50%);
		}
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>	
		<script>
			$(document).ready(function()
			{
				$('.delete_btn_ajax').click(function (e){
					e.preventDefault();
					var deleteid = $(this).closest("tr").find('.delete_id_value').val();
					Swal.fire
					({
    					title: 'Are you sure?',
    					text: "You won't be able to revert this!",
    					icon: 'warning',
    					showCancelButton: true,
    					confirmButtonColor: '#3085d6',
    					cancelButtonColor: '#d33',
    					confirmButtonText: 'Yes, delete it!'
  					}).then((result) => {
    					if (result.isConfirmed) {
      						$.ajax({
								type: "POST",
								url: "delete.php",
								data: {
									"delete_btn_set": 1,
									"delete_id" : deleteid,
								},
								success: function(response){
									console.log("here");
									Swal.fire(
									'Deleted!',
									'Your data has been deleted.',
									'success'
									).then((result)=>{
										window.location.reload();
									});
								}
							});
							}
  					})
				});
			});
		</script>
</body>
</html>