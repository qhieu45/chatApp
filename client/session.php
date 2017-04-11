<?php 
		include ('../inc/functions.php');
		include ('../inc/connection.php');
		session_start();
		// sessioncheck should be equal to the name of the user who logged in
		$sessioncheck = $_SESSION['loggedin'];
		if (empty($sessioncheck)) {
			header('location: ../login.php');
		}
		// getting user from the session
		$result = $db->query("SELECT * from users WHERE username = '$sessioncheck'");
		$row = $result->fetch(PDO::FETCH_ASSOC);
		// save the userId of the user who logged in, which can then be used as userOneId
		$loggedinUserId = $row['userId'];
		$userTwoId = '';
	?>