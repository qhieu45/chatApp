<?php
	$my_title = "Login";
	include 'header.php';
?>
<?php
include ('../inc/functions.php');
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
<div class="signInForm">
	<form action="" method="post">
			<input type="text" class="username" name="username" id="username" placeholder="Username" required="required" /> <br>
			<input type="password" class="password" name="password" id="password" placeholder="Password" required="required" /> <br>
			<input type="submit" class="button" value="Sign In" name="submit" /> 
			<input type="button" class="button" id="signup" value="Sign Up"/>
			<br>
			<label>
				<input type="checkbox" value="Remember me" class="checkbox"/> <span>Remember me</span>
			</label>
	</form>
</div>
<span><?php echo $error?></span>

</body>
<script>
	const signup = document.getElementById("signup");
	signup.addEventListener("click", function() {
		window.location.href = "signup.php";
		});
</script>
</html>

