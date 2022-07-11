<?php
    session_start();
    if($_SESSION['loggedin']!="true" || ($_SESSION['loggedin']!=true)){
        header("location: login.php");
        exit;
     }
    $email=$password=$userid=$userimage='';
    $email=$_SESSION['email'];
    include "components/db.php";
    $sql="select * from users where email='$email';";
    $result= mysqli_query($con,$sql);
    $data=mysqli_fetch_array($result);
        $password=$data['password'];
        $userid=$data['id'];
        $userimage=$data['userimage'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <?php include "components/navbar.php" ?>
    <div class="center">
        <h1>User Details</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Email</td>
                    <td>Password</td>
                    <td>User Image</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $userid;?></td>
                    <td><?php echo $email;?></td>
                    <td><?php echo $password;?></td>
                    <td><img src="<?php echo $userimage; ?>" width='100' height='100'></td>
                </tr>
            </tbody>
        </table>
    </div>
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