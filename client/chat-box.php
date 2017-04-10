<?php
	$my_title = "Chat box";
	include 'header.php';
	include 'session.php';
	include 'send_message.php'
	?>
	
	<div id="container">
		<form id="submitchat" action="">
			<div class="col-lg-4 col-md-4 col-xs-4">
				<ul name="userTwo" id="otherUsers">
					<?php 
						$allusers = list_all_users($loggedinUserId);
						foreach($allusers as $user) {
							$value = $user['userId'];
					?>
						<li>
							<a href="#" class="inner">
								<div class="li-img">
									<img src="http://hidrusmx.com/wp-content/uploads/2016/06/photo.gif" alt="Image Alt Text" />
								</div>
								<div class="li-text">
									<h4 class="li-head">
										<?php 
											echo "<input name='hidden' type='hidden' value='". $value ."'/> {$user['username']}";
										?>									
									</h4>
									<p class="li-sub"><?php 
									$last_message = (show_message_of_two_users($loggedinUserId, $value, 1));
									if ($last_message) {
										echo $last_message[0]["chatMessage"];
									}
									?>
									</p>
								</div>
							</a>	
						</li>
					<?php
						}
					?>
				</ul>
			</div>

			<div class="col-lg-4 col-md-4 col-xs-4 chat-area">
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

<script type="text/javascript" src="js/showMess.js"></script>

<script type="text/javascript" src="js/sendMess.js"></script>

<script>
	setInterval(function() {
		if($('#otherUsers').attr("value")){
			loadMessage($('#otherUsers').attr("value"));
		}
	}, 5000);
</script>

</html>