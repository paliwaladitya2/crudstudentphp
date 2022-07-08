<?php
require_once "components/db.php";
$country_id = $_POST["country_id"];
$result = mysqli_query($con,"SELECT * FROM states where country_id = $country_id");
?>
<option value="">Select State</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
<?php
}
?>