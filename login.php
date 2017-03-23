<?php
include ('inc/functions.php');
session_start();
$error = '';
try {
	if (isset($_POST['submit'])) {
		// if username/ password is empty, add error to $error
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Username or Password is invalid";
		} else {
		//Get username and password from POST to $user and $password variable
			$username = filter_var($_POST["username"],FILTER_SANITIZE_STRING);
			$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
			login($username, $password);
		}
	}
} catch (Exception $e) {
	echo $e->getMessage();
}
?>

<form action="" method="post">
		</br> <p>Please sign in: </p>
		<label>Username: </label>
			<input type="text" name="username" id="username" required="required" /> </br>
		<label>Password: </label>
			<input type="password" name="password" id="password" required="required" /> </br>
			<input type="submit" value="Sign In" name="submit" /> </br>
</form>
<a href="signup.php">SIGN UP NOW</a>

<span><?php echo $error?></span>