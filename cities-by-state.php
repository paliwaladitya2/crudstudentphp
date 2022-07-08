<?php
require_once "components/db.php";
$state_id = $_POST["state_id"];
$result = mysqli_query($con,"SELECT * FROM cities where state_id = $state_id");
?>
<option value="">Select City</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
<?php
}
?>