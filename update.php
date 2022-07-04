<?php

    include "components/db.php";
    include "components/navbar.php"; 
    $id = $name = $class = $section = $country = $state = $city = '';
    $sql1 = "select * from student where id='$id'";

    $result = mysqli_query($con, $sql1);

if ($result){

    $row = mysqli_fetch_array($result);

        $id= $row["id"];
        $name= $row["name"];
        $class= $row["class"];
        $section= $row["section"];
        $country= $row["country"];
        $state= $row["state"];
        $city= $row["city"];

}
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id=$_POST['id'];
        $name= $_POST["name"];
        $class= $_POST["class"];
        $section= $_POST["section"];
        $country= $_POST["country"];
        $state= $_POST["state"];
        $city= $_POST["city"];
        $sql=" update student set name='$name',class='$class',section='$section',country='$country',state='$state',city='$city' where id='$id'";
        if (mysqli_query($con, $sql)) {
        echo "Record updated successfully";
        header("location: welcome.php");
        } else {
        echo "Error updating record: " . mysqli_error($con);
        }
}


mysqli_close($con);

echo '
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" herf="css/style.css">
    <link rel="stylesheet" herf="css/bootstrap.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Student Record</h2>
                    <p>Please fill this form and submit to update this student record in the database.</p>
                    <form action="'. htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">
                        <div class="form-group">
                            <label>Roll. No.</label>
                            <input type="number" name="id" class="form-control" value="'.$id.' " required>
                            <span class="invalid-feedback">Error</span>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="'.$name.'" required>
                            <span class="invalid-feedback">Error</span>
                        </div>
                        <div class="form-group">
                            <label>Class</label>
                            <input type="number" name="class" class="form-control" value="'.$class.'" required>
                            <span class="invalid-feedback">Error</span>
                        </div>
                        <div class="form-group">
                            <label>Section</label>
                            <input type="text" name="section" class="form-control" value="'.$section.'" required>
                            <span class="invalid-feedback">Error</span>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" name="country" class="form-control" value="'.$country.'" required>
                            <span class="invalid-feedback">Error</span>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" name="state" class="form-control" value="'.$state.'" required>
                            <span class="invalid-feedback">Error</span>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" class="form-control" value="'.$city.'" required>
                            <span class="invalid-feedback">Error</span>
                        </div>
                        <button type="submit" class="btn btn-primary" id="btnadd">Submit</button>
                        <a href="welcome.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>


</body>
</html>';

?>