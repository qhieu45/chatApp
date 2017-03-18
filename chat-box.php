<!doctype html>
<html lang="en">

<head>
	<title>My App</title>
	<link href='main.css' rel='stylesheet' type="text/css">
	<script
	src="https://code.jquery.com/jquery-3.1.1.min.js"
	integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
	crossorigin="anonymous"></script>
</head>

<body>
	<p>
		Chat messages with <button id="user"></button>
	</p>
	<div id="chatarea" class="chatarea"></div><br>
	<input type="button" value="Send Message" id="send_message" onclick="" />
</body>
<script>
    var query = window.location.search.substring(1);
    var username = query.split("=");
    var user = document.getElementById("user");
    user.innerHTML = username[1];

	$.getJSON( "http://192.168.1.110/~tyler/data.json", function( data ) {
		console.log(data)
	});
	var chatarea = document.getElementById("chatarea");
	for(var i = 0; i < data.length; i++){
		var chatMessage = document.createElement("p");
		chatMessage.innerHTML = "User " + data[i].userOneId + " : " + data[i].chatMessage;
		chatarea.appendChild(chatMessage);
		

	}

</script>

</html>