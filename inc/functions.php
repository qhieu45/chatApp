<?php
function get_messages($userOneId = null, $userTwoId = null) {
	include("connection.php");
	try {
		$sql = "SELECT username, chatMessage 
				FROM users
				JOIN messages ON messages.userOneId = users.userId
				ORDER BY messageId
				LIMIT 20;";
		$results = $db->prepare($sql);
		$results->execute();
	} catch (Exception $e) {
		echo "Problems occured. Please contact admin";
	}
	$messages = $results->fetchAll();
	return $messages;
}

function create_new_user($user, $password) {
	include("connection.php");
	try {
		$sql = "INSERT INTO users(username, password) VALUES ('$user', '$password');";
		if ($db->query($sql)) {
			echo "<script type= 'text/javascript'>alert('User Registration Successfully');</script>";
		} else{
			echo "<script type= 'text/javascript'>alert('Problems Occured. Please contact admin!');</script>";
		}
	} catch (Exception $e) {
		echo $e->getMessage();
		echo "Bad query";
	}
}

function send_message($userOneId, $userTwoId, $message) {
	include("connection.php");
	$message = addslashes($message);
	try {
		$sql = "INSERT INTO messages(userOneId, userTwoId, chatMessage) 
				VALUES ('$userOneId', '$userTwoId', '$message');";
		if ($db->query($sql)) {
			echo "<script type= 'text/javascript'>alert('Message sent!');</script>";
		} else{
			echo "<script type= 'text/javascript'>alert('Problems Occured. Please contact admin!');</script>";
		}
	} catch (Exception $e) {
		echo $e->getMessage();
		echo "Bad query";
	}
}

function list_all_users() {
	include("connection.php");
	try {
		$sql = "SELECT username FROM users";
		$results = $db->prepare($sql);
		$results->execute();
	} catch (Exception $e) {
		echo $e->getMessage();
	}
	$allusers = $results->fetchAll();
	return $allusers;
}