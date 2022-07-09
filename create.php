<?php
    $id = $name = $class = $section = $countryID = $stateID = $cityID = $image='';
    $response=0;
    $rowError=false;  
    $successAlert=false;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        include "components/db.php";
        $id= $_POST["id"];
        $name= $_POST["name"];
        $class= $_POST["class"];
        $section= $_POST["section"];
        $countryID= $_POST["country"];
        $stateID= $_POST["state"];
        $cityID= $_POST["city"];
        $image= $_FILES["image"];

        $cresult=mysqli_query($con,"select name from countries where id='$countryID'");
        $row1 = mysqli_fetch_array($cresult);
        $countryname=$row1['name'];

        $sresult=mysqli_query($con,"select name from states where id='$stateID'");
        $row2=mysqli_fetch_array($sresult);
        $statename=$row2['name'];

        $ctresult=mysqli_query($con,"select name from cities where id='$cityID'");
        $row3=mysqli_fetch_array($ctresult);
        $cityname=$row3['name'];

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
                $response = $destfile;
            
            $sql = "INSERT INTO `student` (`id`, `name`, `class`, `section`, `country`, `state`, `city`, `image`) VALUES ('$id', '$name', '$class', '$section', '$countryname', '$statename', '$cityname', '$destfile');";
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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/jqajax.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
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
            width:200px;
            min-height:200px;
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
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" id="createform">
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
                            <select class="form-control" id="country-dropdown" name="country">
                                <option value="">Select Country</option>
                                <?php
                                require_once "components/db.php";
                                $result = mysqli_query($con,"SELECT * FROM countries");
                                while($row = mysqli_fetch_array($result)) {
                                ?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row["name"];?></option>
                                <?php
                                }
                                ?>
                                </select>
                            <span class="invalid-feedback">Error</span>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <select class="form-control" id="state-dropdown" name="state"></select>   
                            <span class="invalid-feedback">Error</span>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <select class="form-control" id="city-dropdown" name="city"></select>                            
                            <span class="invalid-feedback">Error</span>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input class="form-control" type="file" name="image" id="image">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary" id="btnadd">Submit</button>
                        <a href="welcome.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script>
        function filePreview(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#createform + img').remove();
                    $('#image').after('<br><img src="'+e.target.result+'" margin-top:"10px" width="200" height="150"/>');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function(){
            filePreview(this); 
        });
    </script>
    <script>

        $(document).ready(function() {
        $('#country-dropdown').on('change', function() {
        var country_id = this.value;
        $.ajax({
            url: "states-by-country.php",
            type: "POST",
            data: {
                country_id: country_id
            },
            cache: false,
            success: function(result){
                $("#state-dropdown").html(result);
                $('#city-dropdown').html('<option value="">Select State First</option>'); 
            }
        });
        });    
        $('#state-dropdown').on('change', function() {
        var state_id = this.value;
        $.ajax({
            url: "cities-by-state.php",
            type: "POST",
            data: {
                state_id: state_id
            },
            cache: false,
            success: function(result){
        $("#city-dropdown").html(result);
        }
        });
        });
        });
    </script>
</body>
</html>