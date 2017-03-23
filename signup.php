<html lang="en">

<head>
	<title>Sign Up here</title>
	<!--  <link href='styles/main.css' rel='stylesheet' type="text/css"> -->
</head>

<body>
	<?php 
		include ('inc/functions.php');
		try {
		if (isset($_POST["submit"])) {
			$user = filter_var($_POST["username"],FILTER_SANITIZE_STRING);
			$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
			$passwordconfirm = filter_var($_POST["passwordconfirm"], FILTER_SANITIZE_STRING);
			if (strcmp($password, $passwordconfirm) == 0) {
				create_new_user($user, $password);
				header('location: login.php');
			} else {
				echo "<script type= 'text/javascript'>alert('Password do not match, please try again!');</script>";
			}
		}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		
	?>
	<form action="" method="post">
		</br> <p>Please enter your username and password below: </p>
		<label>Username: </label>
			<input type="text" name="username" id="username" required="required" /> </br>
		<label>Password: </label>
			<input type="password" name="password" id="password" required="required" /> </br>
		<label>Confirm Password: </label>
			<input type="password" name="passwordconfirm" id="passwordconfirm" required="required" /> </br>
			<input type="submit" value="Register" name="submit" /> </br>
	</form>
</body>


</html>