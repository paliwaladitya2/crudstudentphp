<?php

	session_start();
    if($_SESSION['loggedin']="true" || ($_SESSION['loggedin']=true)){
       header("location: welcome.php");
       exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link herf="css/style.css">
</head>

<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="welcome.php">Student CRUD System </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
</nav>


	<div class="container">
        <h1 class="text-center">Welcome to the Student CRUD system</h1>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Already a Registered User?</th>
					<th>Register as a new user!</th>
				</tr>
			</thead>
			<tbody>
            <td>
            <br>
			<div class="vertical-center">
					<a href="login.php">
   						<input type="button" value="Login" class="btn btn-primary" />
					</a>
				</div>
			<br>
			</td>
			<td>
            <br>
				<div class="vertical-center">
					<a href="register.php">
   						<input type="button" value="Sign Up" class="btn btn-primary" />
					</a>
				</div>
			<br>
			</td>
			</tbody>
    </div>


    
</body>
</html>
