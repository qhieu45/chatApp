<!doctype html>
<html lang="en">

<head>
	<title>My App</title>
	<!--  <link href='styles/main.css' rel='stylesheet' type="text/css"> -->

</head>

<body>
	<form id="login_form" method="post" name="login_form">
		<fieldset> Sign Up
			<p> Username :
				<input type="text" name="username" id="username"/>
			</p>
			<p> Password :
				<input type="password" name="password" id="password" />
			</p>
			<input type="button" value="Sign Up" id="submit" onclick="handleSignUp()" />
		</fieldset>
	</form>
</body>
<script>
	function handleSignUp(){
        return false
	}

</script>

</html>