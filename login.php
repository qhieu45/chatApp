<!doctype html>
<html lang="en">

<head>
	<title>My App</title>
	<!--  <link href='styles/main.css' rel='stylesheet' type="text/css"> -->

</head>

<body>
	<form id="login_form" method="post" name="login_form">
		<fieldset> Login
			<p> Username :
				<input type="text" name="username" id="username"/>
			</p>
			<p> Password :
				<input type="password" name="password" id="password" />
			</p>
			<input type="button" value="Login" id="submit" onclick="handleSubmit()" />
            <a href="sign-up.html"> <input type="button" value="Sign Up" /></a>
		</fieldset>
	</form>
</body>
<script>
	var users = [
		{ id: '1', username: 'hoanglong1', password: '12345' },
		{ id: '2', username: 'hoanglong2', password: '12345' },
		{ id: '3', username: 'hoanglong3', password: '12345' },
		{ id: '4', username: 'hoanglong4', password: '12345' },
		{ id: '5', username: 'hoanglong5', password: '12345' },
	];
	function handleSubmit(){
        var user = document.getElementById("username").value;
		var password = document.getElementById("password").value;
        for(var i = 0; i < users.length; i++){
            if(users[i].username === user && users[i].password === password){
                alert('login success');
                window.location = "index.php";
                return false
            }
        }
        alert('wrong username or password');
        return false
	}

</script>

</html>