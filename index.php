<!doctype html>
<html lang="en">

<head>
	<title>My App</title>
	<link href='main.css' rel='stylesheet' type="text/css">

</head>

<body>
	<p>
		Send messages to 
		<ul id="userList"></ul>
	</p>
	<textarea cols="50" rows="5"></textarea><br>
	<input type="button" value="Send Message" id="send_message" onclick="" />
</body>
<script>
	var users = [
		{ id: '1', username: 'hoanglong1', password: '12345' },
		{ id: '2', username: 'hoanglong2', password: '12345' },
		{ id: '3', username: 'hoanglong3', password: '12345' },
		{ id: '4', username: 'hoanglong4', password: '12345' },
		{ id: '5', username: 'hoanglong5', password: '12345' },
	];
	var ul = document.getElementById("userList");
	var button;
	for(var i = 0; i < users.length; i++){

		button = document.createElement("button");
		button.innerHTML = users[i].username;
		ul.appendChild(button);
		button.onclick = function(e){
			window.location = "chat-box.php?username=" + e.target.innerHTML;
		}
	}


</script>

</html>