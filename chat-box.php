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
		if (empty($sessioncheck)) {
			header('location: login.php');
		}
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
		}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	?>
	<div id="chatarea" class="chatarea">
		<form id="submitchat" action="" method="post">
			<p>
			Chat messages with 	<select name="userTwo" id="otherUsers" onchange="showMess(this.value)">
			<?php 
			echo "<option value=''>"."Select a person:</option>";
				$allusers = list_all_users($loggedinUserId);
				foreach($allusers as $user) {
					// put the userId of userTwo into the value of <option> --> later used for POST
					echo "<option value=". $user['userId'] ;
					// keeping the selected option after submit form
					if(isset($_POST['userTwo']) && $_POST['userTwo'] == $user['userId'])
						echo ' selected="selected"';
					echo "> {$user['username']}"."</option>";
				}
			?>
			</select>
			</p>
			<input type="text" name="message" id="message" required="required" /> <br>
			<input type="submit" value="Send message" name="submit" /> <br>
		</form>
	</div>
	<div id="chatlog">
	</div>
	<a href="logout.php">Log Out</a>
</body>

<script>
	function showMess(str) {
    if (str.length == 0) { 
        document.getElementById("chatlog").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("chatlog").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "inc/chat_backend.php?q=" + str, true);
        xmlhttp.send();
    }
}	

	function refreshChat(str) {
		if (str.length == 0) { 
	        document.getElementById("chatlog").innerHTML = "";
	        return;
	    } else {
	        var xmlhttp = new XMLHttpRequest();
	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                document.getElementById("chatlog").innerHTML = this.responseText;
	            }
	        };
	        xmlhttp.open("GET", "inc/chat_backend.php?q=" + str, true);
	        xmlhttp.send();
	    }
	    console.log("Test Interval");
	}

	setInterval(function() {
		refreshChat($('#otherUsers').val());
		}, 1000);

</script>

</html>
