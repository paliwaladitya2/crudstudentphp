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
        $userimage=$_FILES["userimage"];
        $filename = $userimage['name'];
        $fileerror = $userimage['error'];
        $filetmp = $userimage['tmp_name'];
        $fileext = explode('.',$filename);
        $filecheck = strtolower(end($fileext));
        $fileextstored = array('png','jpg','jpeg');
        $existsql="select * from users where email='$email'";
        $result=mysqli_query($con,$existsql);
        $numexistrows= mysqli_num_rows($result); 
        if($numexistrows>0)
        {   
            $rowError=true;
        }
        else
        {
            if(($email!='' || $email!=NULL) &&  $password==$cpassword && in_array($filecheck,$fileextstored))
            {    
                $destfile="images/users/".$filename;
                move_uploaded_file($filetmp,$destfile);
                $sql="INSERT INTO `users` (`email`, `password`, `userimage`) VALUES ('$email', '$password', '$destfile');";
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
    <link rel="stylesheet" herf="css/bootstrap.css">
    <link rel="stylesheet" herf="css/style.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/jqajax.js"></script>
    <script src="js/popper.js"></script>
    <script>
        const form = document.getElementById('form');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const cpassword = document.getElementById('cpassword');
        const image = document.getElementById('userimage');

        form.addEventListener('submit',e=> {
            e.preventDefault();
            validateInputs();
        });
        const setSuccess = element=>{
            const inputControl = element.parentElement;
            const errorDisplay = inputControl.querySelector('.error');

            errorDisplay.innerText='';
            inputControl.classList.add('success');
            inputControl.classList.remove('error');
        }
        const isValidEmail = email => {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
         return re.test(String(email).toLowerCase());
        }
  
        const setError = (element,message) => {
            const inputControl = element.parentElement;
            const errorDisplay = inputControl.querySelector('.error');
            errorDisplay.innerText = message;
            inputControl.classList.add('error');
            inputControl.classList.remove('success');
        }
        const validateInputs = () => {
            const emailValue= email.value.trim();
            const passwordValue= password.value.trim();
            const cpasswordValue= cpassword.value.trim();

            if(emailValue === '') {
                setError(email, 'Email is required');
            } else if (!isValidEmail(emailValue)) {
                setError(email, 'Provide a valid email address');
            } else {
                setSuccess(email);
            }
            
            if(passwordValue === '') {
                setError(password, 'Password is required');
            } else if (passwordValue.length < 8 ) {
                setError(password, 'Password must be at least 8 character.')
            } else {
                setSuccess(password);
            }

            if(password2Value === '') {
                setError(password2, 'Please confirm your password');
            } else if (password2Value !== passwordValue) {
                setError(password2, "Passwords doesn't match");
            } else {
                setSuccess(password2);
            }
            }   
        </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        .vertical-center {
                margin: 0;
                position: absolute;
                top: 50%;
                -ms-transform: translateY(-50%);
                transform: translateY(-50%);
              }
              .center {
                margin: 0;
                position: absolute;
                top: 50%;
                left: 50%;
                -ms-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
              }
              .preview{
                display: block;
                width: 100px;
                height: 100px;
                border: 1px solid black;
                margin-top: 10px;
                background: white;
            }
            .image-preview{
                width:300px;
                min-height:100px;
                border: 2px solid #dddddd;
                margin-top: 15px;
    
                display: flex;
                align-items: center;
                justify-content:center;
                font-weight:bold;
                color:#cccccc;
            }
            .image-preview__image{
                display:none;
                width:100%;
            }
            .form-control input:focus{
                outline:0;
            }
            .form-control.success input{
                border-color: #09c372;
            }
            .form-control.error input{
                border-color: #ff3860;
            }
            .form-control .error{
                color:red;
                font-size: 9px;
                height: 13px;
            }
    </style>
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
        <form method="post" action="register.php" id="form" enctype="multipart/form-data">
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
            <div class="form-group">
                <label for="userimage">User Image</label>
                <input class="form-control" type="file" name="userimage" id="userimage">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>