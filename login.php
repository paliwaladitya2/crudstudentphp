<?php
    $login=false;
    $showError=false;
    $_SESSION['loggedin']=false;
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        include 'components/db.php';
        $email= $_POST["email"];
        $password= $_POST["password"];
            
            $sql="select * from users where email='$email' && password='$password'";
            $result=mysqli_query($con,$sql);
            $num = mysqli_num_rows($result);
            if ($num ==1)
            {
                $login = true;
                session_start();
                $_SESSION['loggedin']= "true";
                $_SESSION['email']= $email;
                header("location: welcome.php");
            }
            else
            {
                $showError = true;
            }
        
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <?php  
        require 'components/navbar.php';
        if($login){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong>You are logged in.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';}
        if($showError){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error! </strong>Credentials are entered wrong.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';}
    ?>
    <div class="container">
        <h1 class="text-center">Login into your account</h1>
        <form method="post" action="login.php">
            <div class="form-group col-mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
            <div class="form-group col-mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>