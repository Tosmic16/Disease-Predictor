<?php 
//start a session for a unique user
session_start();

$username = "";
$email = "";
$errors =array();

//connect to the database
define('DB_NAME', 'shps');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');
$db = mysqli_connect(DB_HOST , DB_USER , DB_PASS , DB_NAME);

// if the rregister button is clicked
//CHECK IF THE VARAIBLES ARE SET FROM VALUES IN REGISTER FORM
if (isset($_POST['register'])){
	$username =($_POST['username']);
	$email =($_POST['email']);
	$password_1 = ($_POST['password_1']);
	$password_2 = ($_POST['password_2']);


// ensure form fields are filled properly
	if(empty($username)){
		array_push($errors, "Username is required");//add error to array errors
	}
	if(empty($email)){
		array_push($errors, "Email is required");//add error to array errors
	}
	if(empty($password_1)){
		array_push($errors, "password is required");//add error to array errors
	}
	// check if the two password match
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}
	// if there are no errors save user to database
	if (count($errors) == 0) {
				$password = md5($password_1) ;// it encrypts password before storing in database(Security)
		$sql = "INSERT INTO users (username, email, password)
					VALUES ('$username', '$email', '$password')";	
		mysqli_query($db, $sql);
			// SET USER USERNAME IN GLOBAL VARIABLE SESSION
			$_SESSION["username"] = $username;
			$_SESSION["success"] = "You are now logged in";
			//SEND A RAW HTTP HEADER TO THE CLIENT
			header('location: index.php');//redirect to homepage
	}
}
	//login user from login page
if (isset($_POST['login'])) {
	
	$username = ($_POST['username']);
	$password =($_POST['password']);

		if(empty($username)){
		array_push($errors, "Username is required");//add error to array errors
	}
	if(empty($password)){
		array_push($errors, "password is required");//add error to array errors
	}
		if (count($errors) == 0) {
			$password = md5($password); //encrypt password b4 comparing with that of database
			$query ="SELECT * FROM users WHERE  username='$username' AND password='$password'";
			$result = mysqli_query($db, $query);
			if (mysqli_num_rows($result) == 1) {
				//log user in
				$_SESSION["username"] = $username;
			$_SESSION["success"] = "You are now logged in";
			header('location: index.php');//redirect to homepage
			}
			else{
				array_push($errors, "wrong username/password combination");
			}
		}
}


//logout
if (isset($_GET['logout'])) {
		unset($_SESSION["username"]);

	session_destroy();
	header('location: login.php');
}
?>