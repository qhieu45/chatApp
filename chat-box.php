<!doctype html>
<html lang="en">

<head>
	<title>My ChatApp</title>
	<link href='main.css' rel='stylesheet' type="text/css">
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
	 crossorigin="anonymous"></script>
</head>

<body>
	<?php 
		include ('inc/functions.php');
		
	?>
	<p>
		Chat messages with <select id="otherUsers">
		<?php $allusers = list_all_users();
			foreach($allusers as $user) {
				echo "<option> {$user['username']}"."</option>";
			}
		?>
		</select>
	</p>
	<?php 
		try {
		if (isset($_POST["submit"])) {
			$message = $_POST["message"];
			send_message(3, 1, $message);
		}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	?>
	<div id="chatarea" class="chatarea">
		<form action="" method="post">
			<input type="text" name="message" id="message" required="required" /> <br>
			<input type="submit" value="Send message" name="submit" /> <br>
		</form>
		<?php
			$messages = get_messages();
			foreach($messages as $message) {
				echo "<p> {$message['username']}:" . htmlspecialchars($message['chatMessage']) ."</p>";
			}
		?>
	</div><br>
</body>

<script>
	$("#otherUsers").change(function(){
		console.log($("#otherUsers").val());
	})
</script>

</html>
