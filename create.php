<?php
    $id = $name = $class = $section = $country = $state = $city = $image='';
    $rowError=false;  
    $successAlert=false;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        include "components/db.php";
        $id= $_POST["id"];
        $name= $_POST["name"];
        $class= $_POST["class"];
        $section= $_POST["section"];
        $country= $_POST["country"];
        $state= $_POST["state"];
        $city= $_POST["city"];
        $image= $_FILES["image"];
        $filename = $image['name'];
        $fileerror = $image['error'];
        $filetmp = $image['tmp_name'];

        $fileext = explode('.',$filename);
        $filecheck = strtolower(end($fileext));
        $fileextstored = array('png','jpg','jpeg');
        

        $existsql="select * from student where id='$id'";
        $result=mysqli_query($con,$existsql);
        $numexistrows= mysqli_num_rows($result); 
        if($numexistrows>0)
        {   
            $rowError=true;
        }
        else
        {   
            if(in_array($filecheck,$fileextstored))
            {
                $destfile="images/".$filename;
                move_uploaded_file($filetmp,$destfile);
                
            
            $sql = "INSERT INTO `student` (`id`, `name`, `class`, `section`, `country`, `state`, `city`, `image`) VALUES ('$id', '$name', '$class', '$section', '$country', '$state', '$city', '$destfile');";
            $result=mysqli_query($con,$sql);
            $successAlert = true;
            }
        }
    mysqli_close($con);
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Student Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="jqajax.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <?php  
        if($successAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong>Student record has been created.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';}
        if($rowError){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error! </strong>Student with this Roll.No. already exists.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';}
    ?>
    <?php include "components/navbar.php"; ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Student Record</h2>
                    <p>Please fill this form and submit to add student record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Roll. No.</label>
                            <input type="number" name="id" class="form-control" value="<?php echo $id; ?> " required>
                            <span class="invalid-feedback">Error</span>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>
                            <span class="invalid-feedback">Error</span>
                        </div>
                        <div class="form-group">
                            <label>Class</label>
                            <input type="number" name="class" class="form-control" value="<?php echo $class; ?>" required>
                            <span class="invalid-feedback">Error</span>
                        </div>
                        <div class="form-group">
                            <label>Section</label>
                            <input type="text" name="section" class="form-control" value="<?php echo $section; ?>" required>
                            <span class="invalid-feedback">Error</span>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" name="country" class="form-control" value="<?php echo $country; ?>" required>
                            <span class="invalid-feedback">Error</span>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" name="state" class="form-control" value="<?php echo $state; ?>" required>
                            <span class="invalid-feedback">Error</span>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" class="form-control" value="<?php echo $city; ?>" required>
                            <span class="invalid-feedback">Error</span>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control" value="<?php echo $image; ?>" required>
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
</html>