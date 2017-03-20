<?php
try {
	$username='hieu';
	$password='8954509a!';
	$database = 'chatapp';
	$db = new PDO("mysql:host=localhost;dbname=$database",$username,$password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	echo "Unable to connect to the database </br>";
	echo $e->getMessage();
	exit;
}