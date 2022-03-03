<!DOCTYPE html>
<html>
<head>
	<title>

	</title>

</head>
<body>

<?php

include("server.php");

$query = "SELECT DISTINCT symptoms FROM disease";
$res = mysqli_query($db , $query);
while ($row = mysqli_fetch_assoc($res)):
?>

<form method="POST">
	

<div class="input-group">
<input type="checkbox" name="symp[]" value="<?php echo $row['symptoms'] ?>"><?php echo $row['symptoms'] ?></input>
		</div>

<?php

endwhile;

?>
<br><br><br><br>
<input type="submit" name="sub">

		</form>

</body>
</html>
<?php 
if (isset($_POST['sub'])) {

foreach ($_POST['symp'] as $key => $value) {
	echo $value."<br><br>";
}
}


?>