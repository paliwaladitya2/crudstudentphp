<?php

    include "components/db.php";
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

?>