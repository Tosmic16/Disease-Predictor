<?php include('server.php');
#if the user is logged in, they cannot access this page
if (empty($_SESSION["username"])) {
	header('location: login.php');
	}
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to tosmic</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
	<h2>Home page</h2>
</div>

		<div class="content">
	<?php if (isset($_SESSION["sucess"])):  ?>	
		<div class="success">
			<h3>
				<?php 
				echo $_SESSION["success"];
				unset($_SESSION["success"]);
				 ?>
			</h3>
		</div>
<?php endif ?>
	<?php if(isset($_SESSION["username"])): ?>
		<p>Welcome <strong><?php echo $_SESSION["username"];  ?></strong></p>
			<p><a href="index.php?logout='1'" style="color: red;">logout</a></p>
			<?php endif ?>

</div>
</body>
</html>