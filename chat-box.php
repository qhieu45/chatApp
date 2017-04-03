<!doctype html>
<html lang="en">

<head>
	<title>My ChatApp</title>
	<link href='main.css' rel='stylesheet' type="text/css">
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
	 crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
		if (isset($_POST["btnsubmit"])) {
			$message = $_POST["message"];
			$userTwoId = $_POST['userTwo'];
			send_message($loggedinUserId, $userTwoId, $message);
		}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	?>
	<div id="container">
		<!--<div id="chatarea" class="chatarea">-->
		<div class="col-lg-3 col-md-3 col-xs-3">
			<form id="submitchat" action="" method="post">
			<ul name="userTwo" id="otherUsers" onchange="showMess(this.value)">
				<?php 
					$allusers = list_all_users($loggedinUserId);
					foreach($allusers as $user) {
						// put the userId of userTwo into the value of <option> --> later used for POST
						echo "<li class='oneUser'>" ;
						// keeping the selected option after submit form
						// if(isset($_POST['userTwo']) && $_POST['userTwo'] == $user['userId'])
						// 	echo ' selected="selected"';
						echo "<input type='hidden' value='". $user['username'] ."'/> {$user['username']}"."</li>";
					}
				?>
			<input type="text" name="message" id="message" required="required" /> <br>
			<input type="submit" value="Send message" name="btnsubmit" /> <br>
			 <?php
            if( $_SERVER['REQUEST_METHOD']=='POST' && isset( $_POST['userTwo'] ) ){
                echo 'Test: '.$_POST['userTwo'];
            }
        ?>
		</form>

				


		</div>
		<div class="col-lg-6 col-md-6 col-xs-6">
				
			<form id="submitchat" action="" method="post">
				<p>
				Select user to chat with : 	<select name="userTwo" id="otherUsers" onchange="loadMessage(this.value)">
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
				<div id="chatlog" class="chatlog">
				</div>
				<input type="text" name="message" id="message" required="required" />
				<input type="submit" value="Send message" name="btnsubmit" /> <br>
			</form>
			<!--</div>-->
		<a href="logout.php">Log Out</a>
		</div>
	</div>
</body>

<script>
	function searchMessage(str){
		return new Promise( (resolve, reject) => {
			if (str.length == 0) { 
				document.getElementById("chatlog").innerHTML = "";
				resolve();
			}
			var xmlhttp, url;
			url = "inc/chat_backend.php?q=" + str;
			xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", url, true);
			xmlhttp.onload = function() {
				if (this.readyState == 4 && this.status == 200) {
					resolve(JSON.parse(xmlhttp.response));
				}else{
					reject(Error('Image didn\'t load successfully; error code:' + request.statusText));
				}
			};
			xmlhttp.onerror = function(e){
				reject({
					status: this.status,
					statusText: xmlhttp.statusText
				});
			}; 
			xmlhttp.send();
		})
	}

	function loadMessage(str){
		var container = document.getElementById("chatlog");
		while(container.firstChild){
			container.removeChild(container.firstChild);
		}
		searchMessage(str).then(function (data){
			if (!data) return;
			data.forEach(message => {
				var el = document.createElement("p");
				el.innerText = `${message.username}: ${message.chatMessage}` ;
				container.appendChild(el);
			});
		}).catch(function (err){
			console.error('Augh, there was an error!', err);
		});
	}
</script>

<script>
	setInterval(function() {
			loadMessage($('#otherUsers').val());
		}, 5000);
</script>

</html>