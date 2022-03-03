<?php
// array of error is in server.php
//check if there is any error
if (count($errors) > 0):  ?>
<div class="error">
	<?php 
	//assigns every element in array errors to value error 
	foreach ($errors as $error): ?>
		<p><?php echo $error; ?></p>
	<?php endforeach ?>

</div>
<?php endif ?>