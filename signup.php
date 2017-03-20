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
			$user = $_POST["username"];
			$password = $_POST["password"];
			create_new_user($user, $password);
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
			<input type="submit" value="Register" name="submit" /> </br>
	</form>
</body>


</html>