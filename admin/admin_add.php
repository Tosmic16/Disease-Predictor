<?php
define('DB_NAME', 'shps');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');
$db = mysqli_connect(DB_HOST , DB_USER , DB_PASS , DB_NAME);

session_start();
			$disease="";
			if (isset($_POST['more'])) {
				$disease=$_POST['disease'];
				$symptom = $_POST['symptoms'];
				$saaty = $_POST['saaty'];


		if (isset($_SESSION['dis'])) {
			$count = count($_SESSION['dis']);
			$_SESSION['dis'][$count] =array(

				'disease' => $disease,
				'symptoms' => $symptom,
				'saaty'=> $saaty,
			);

		}
		else
		{
			$_SESSION['dis'][0]=array(

					'disease' => $disease,
					'symptoms'=> $symptom,
					'saaty'=> $saaty,
			);
		}
}
if (isset($_POST['done'])) {

		foreach ($_SESSION['dis'] as $key => $diseases) {
			$db_disease=$diseases['disease'];
			$db_symptom=$diseases['symptoms'];
			$db_saaty=$diseases['saaty'];

			$query = "INSERT INTO disease (disease, symptoms, saaty) 
							VALUES ('$db_disease', '$db_symptom', '$db_saaty')";

							mysqli_query($db,$query);

			session_unset($_SESSION['dis'][$key]);
		}
	# code...
}
//session_destroy();
	?>
	<!DOCTYPE html>
<html>
<head>
	<title>admin</title> 
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
	<h2>ADD DISEASE</h2>
</div>

	<form method="post" action="#">
		
		<div class="input-group">
			<select name="disease" style="width: 90%; height: 30px;">
  <option value="Malaria">Malaria</option>
  <option value="Fever">Fever</option>
  <option value="Typhiod">Typhiod</option>
</select>
		</div>
		<div class="input-group">
			<label>Symptoms</label>
			<input type="text" name="symptoms"  >
		</div>
		<div class="input-group">
			<label>Saaty Number(0-9)</label>
			<input type="Number" name="saaty"  >
		</div>
		
		<div class="input-group">
			<button type="submit" name="more" class="btn">Add More</button>
		</div>
		<div class="input-group"> 
			<button type="submit" name="done" class="btn">Done !</button>
		</div>
		
	</form>
<pre style="color: white;"> <?php //print_r($_SESSION['dis']); ?> </pre>";
<div style="color: chocolate; margin-left: 10%; background-color: white; padding: 20px; width: 30% ;">
	<?php
	if (!empty($_SESSION['dis'])) {
		
	foreach ($_SESSION['dis'] as $key => $diseases) {
		echo "Disease: ".$diseases['disease']."_______"."Symptom: ".$diseases['symptoms']."___________".$diseases['saaty']."<br>";
	}
}

	?>
</div>

</body>
</html>