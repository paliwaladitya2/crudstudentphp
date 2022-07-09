<?php
    $id = $name = $class = $section = $countryID = $stateID = $cityID = $image='';
    $id=$_GET['id'];
    include "components/db.php";
    $sql="select * from student where id='$id';";
    $result= mysqli_query($con,$sql);
    $data=mysqli_fetch_array($result);
        $name=$data['name'];
        $class=$data['class'];
        $section=$data['section'];
        $country=$data['country'];
        $state=$data['state'];
        $city=$data['city'];
        $image=$data['image'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<style>
        .wrapper{
            width: 1000px;
            margin: 0 auto;
        }
    </style>
    <?php include "components/navbar.php" ?>
    <div class="mt-5 mb-3 clearfix" margin: auto;>
        <h1>Student Details</h1>
        <div class="wrapper"><div class="container-fluid"><div class="row"><div class="col-md-12">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td><b>Roll Number</b></td>
                    <td><b>Name</b></td>
                    <td><b>Class</b></td>
                    <td><b>Section</b></td>
                    <td><b>Country</b></td>
                    <td><b>State</b></td>
                    <td><b>City</b></td>
                    <td><b>Student Image</b></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $class; ?></td>
                    <td><?php echo $section; ?></td>
                    <td><?php echo $country; ?></td>
                    <td><?php echo $state; ?></td>
                    <td><?php echo $city; ?></td>
                    <td><img src="<?php echo $image; ?>" width='100' height='100'></td>
                </tr>
            </tbody>
        </table>
        <a href="generate_pdf.php?id='<?php echo $id; ?>'" class="btn btn-success" title="Generate PDF" data-toggle="tooltip">Download PDF</a>
        <!--form class="form-inline" meathod="POST" action="generate_pdf.php">
		<button type="submit" id="pdf" name="generate_pdf" class="btn btn-success"><i class="fa fa-pdf" aria-hidden="true"></i>Generate PDF</button></form-->
    </div></div></div></div></div>
</body>
<style>
    .center{
        margin: auto;
        width: 50%;
        padding: 10px;
    }
    h1{
        text-align:center;
    }
</style>
</html>