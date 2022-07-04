<?php
include "components/db.php";

if(isset($_POST['delete_btn_set']))
	{
		$del_id = $_POST['delete_id'];
    echo $del_id;
		$sql= "DELETE FROM student WHERE id=$del_id ";
		$result=mysqli_query($con,$sql);
	}

?>