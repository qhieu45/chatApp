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
		include ('inc/connection.php');
		session_start();
		// sessioncheck should be equal to the name of the user who logged in
		$sessioncheck = $_SESSION['loggedin'];
		// getting username from the session
		$result = $db->query("SELECT * from users WHERE username = '$sessioncheck'");
		$row = $result->fetch(PDO::FETCH_ASSOC);
		// save the userId of the user who logged in, which can then be used as userOneId
		$loggedinUserId = $row['userId'];
		$userTwoId = '';
		echo "Hello {$row['username']}, welcome to chatbox";
	?>
	<?php 
		try {
		if (isset($_POST["submit"])) {
			$message = $_POST["message"];
			$userTwoId = $_POST['userTwo'];
			send_message($loggedinUserId, $userTwoId, $message);
			
			$messages = get_messages($loggedinUserId, $userTwoId);
			foreach($messages as $message) {
				echo "<p> {$message['username']}:" . htmlspecialchars($message['chatMessage']) ."</p>";
			}
		}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	?>
	<div id="chatarea" class="chatarea">
		<form action="" method="post">
			<p>
			Chat messages with <select name="userTwo" id="otherUsers">
			<?php $allusers = list_all_users();
				foreach($allusers as $user) {
					// put the userId of userTwo into the value of <option> --> later used for POST
					echo "<option value=". $user['userId']. "> {$user['username']}"."</option>";
				}
			?>
			</select>
			</p>
			<input type="text" name="message" id="message" required="required" /> <br>
			<input type="submit" value="Send message" name="submit" /> <br>
		</form>
		<?php
/* 			$messages = get_messages($loggedinUserId, $userTwoId);
			foreach($messages as $message) {
				echo "<p> {$message['username']}:" . htmlspecialchars($message['chatMessage']) ."</p>";
			} */
		?>
	</div>
	
	<a href="logout.php">Log Out</a>
</body>

<script>
	$("#otherUsers").change(function(){
		console.log($("#otherUsers").val());
	})
</script>

</html>
