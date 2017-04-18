<?php
	$my_title = "Chat box";
	include 'header.php';
	include 'session.php';
?>
	
	<div id="container">
		<form id="submitchat" action="">
			<div class="col-lg-4 col-md-4 col-xs-4">
				<ul name="userTwo" id="otherUsers">
					
				</ul>
			</div>

			<div class="col-lg-4 col-md-4 col-xs-4 chat-area">
					<!--<button onClick="scrollToBottom('chatlog')"></button>-->
				<div id="chatlog" class="chatlog">
				</div>
				<input type="text" name="message" id="message" required="required" />
				<input type="submit" value="Send message" id="btnSubmit" name="btnsubmit" /> <br>
			</div>
			<h3 class="welcome">
				<?php
					echo "Hello {$row['username']}, welcome to chatbox"
				?>
			</h3>
			<a class="btn-log-out" href="logout.php">Log Out</a>
		</form>
	</div>
</body>

<script type="text/javascript" src="js/showUser.js"></script>

<script type="text/javascript" src="js/showMess.js"></script>

<script type="text/javascript" src="js/sendMess.js"></script>

<script>
	window.onload = loadUser();
	setInterval(function() {
		if($('#otherUsers').attr("value")){
			loadUser();
			loadMessage($('#otherUsers').attr("value"));
			function scrollToBottom (id) {
				var div = document.getElementById(id);
				div.scrollTop = div.scrollHeight;
			}
			scrollToBottom('chatlog')
		}
	}, 10000);
</script>

</html>