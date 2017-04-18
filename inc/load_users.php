<?php
/* include('functions.php');
write_chat_to_file(1, 6);
$chatlogfile="../data/chatlog16.txt";
check_update($chatlogfile);
 */
include('connection.php');
include('functions.php');

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

$users = list_all_users($loggedinUserId);
foreach($users as &$user){
	$last_message = show_message_of_two_users($loggedinUserId, $user["userId"], 1);
	if ($last_message){
		$user["lastMessage"] = $last_message[0]["chatMessage"];
	} else {
		$user["lastMessage"] = "";
	}
}
echo json_encode($users);
// lookup all hints from array if $q is different from ""


// Output "no suggestion" if no hint was found or output correct values