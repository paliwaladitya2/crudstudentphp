<?php
    $alert=false;
    $showError=false;
    $rowError=false;
    if($_SERVER["REQUEST_METHOD"]== "POST")
    {
        include 'components/db.php';
        $email= $_POST["email"];
        $password= $_POST["password"];
        $cpassword=$_POST["cpassword"];
        $existsql="select * from users where email='$email'";
        $result=mysqli_query($con,$existsql);
        $numexistrows= mysqli_num_rows($result); 
        if($numexistrows>0)
        {   
            $rowError=true;
        }
        else
        {
            if(($email!='' || $email!=NULL) &&  $password==$cpassword)
            {    

                $sql="INSERT INTO `users` (`email`, `password`) VALUES ('$email','$password');";
                $result=mysqli_query($con,$sql);
                $alert=true;
            }
            else
            {
                $showError=true;
            }
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <?php  
        require 'components/navbar.php';
        if($alert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong>Your account has been created.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';}
        if($rowError){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error! </strong>User with this email already exists.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';}
        if($showError){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error! </strong>Passwords do not match
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';}
    ?>
    <div class="container">
        <h1 class="text-center">Register a New user</h1>
        <form method="post" action="register.php">
            <div class="form-group col-mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="form-group col-mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group col-mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <div id="emailHelp" class="form-text">Make sure you enter the same password.</div>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>