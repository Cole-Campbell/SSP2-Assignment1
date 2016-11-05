<?php
session_start();
include('con/db.php');
include('clean.php');

if (isset($_POST['register'])){

	$username = scrub($_POST['username']);
	$password = scrub($_POST['password']);
	$email = verify($_POST['email']);

	$stmt = $conn->prepare("INSERT INTO users (id, username, password, email) VALUES (NULL, :un, :pw, :em)");
	$stmt->execute(array(
		':un'=>$username,
		':pw'=>$password,
		':em'=>$email));

	echo 'Registered ' .$username;
}

?>