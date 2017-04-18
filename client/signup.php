<?php
	$my_title = "Sign Up";
	include 'header.php';
?>
	<?php 
		include ('../inc/functions.php');
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
	<div class="signUpForm">
		<form action="" method="post">
			<input type="text" class="username" name="username" id="username" placeholder="Username" required="required" /> <br>
			<input type="password" class="password" name="password" id="password" placeholder="Password" required="required" /> <br>
			<input type="password" class="password" name="passwordconfirm" id="passwordconfirm" placeholder="Confirm Password" required="required" /> </br>
			<input type="submit" class="button" value="Sign Up" name="submit" /> 
		</form>
	</div>
</body>


</html>