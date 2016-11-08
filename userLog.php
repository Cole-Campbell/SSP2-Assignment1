<?php
#This page goes through the form, ie. register, login, forgot.
session_start();

include('con/db.php');
include('clean.php');

#If the form sent is submitted with the name login, then this if statement will run.
if (isset($_POST['login'])){

	#Sets the variables from the post method after "scrubbing" them.
	$username = scrub($_POST['username']);
	$password = scrub($_POST['password']);

	#Creating the query statement which will check to see if the user and password are within the database.
	$stmt = $conn->prepare('SELECT * FROM users WHERE username = :un and password = :pw');
	$stmt->execute(array(
	':un'=> $username,
	':pw'=> sha1($password)));

	/*$stmt->bindParam(':un', $username);
	$stmt->bindParam(':pw', $password);
	$stmt->execute();*/

	#IF a single row comes back then the user session will be created and the user will be logged in. Redirected to their last url.
	if($stmt->rowCount() == 1) {
		
		$_SESSION['user'] = $username;

		header('Location:'.$_SESSION['lasturl']);

		return array(true, $stmt);
	} else {
		#If zero or more than one row is found then they will be redirected.
		header('Location:index.php');
	}

}

##### REGISTER

#If the form sent is submitted with the name registered, then this if statement will run.
if (isset($_POST['register'])){

	#Sets the variables from the post method after "scrubbing" them, as well as verifying them.
	$username = scrub($_POST['username']);
	$password = scrub($_POST['password']);
	$email = verify($_POST['email']);

	#Creating the query statement which will check to see if the user and email are within the database.
	$stmt = $conn->prepare('SELECT * FROM users WHERE username = :un or email = :em');
	$stmt->execute(array(
	':un'=> $username,
	':em'=> $email));

	#if no row is returned then the data provided will be inserted into the database. The user will then be told that they are registered.
	if ($stmt->rowCount() == 0){

		$stmt = $conn->prepare("INSERT INTO users (id, username, password, email) VALUES (NULL, :un, :pw, :em)");
		$stmt->execute(array(
			':un'=>$username,
			':pw'=>sha1($password),
			':em'=>$email));

		echo 'Registered ' .$username;
		echo '<p><a href="index.php">Back to Products</a></p>';
	} else{
		#if a row is returned then the user is redirected to the registration page.
		echo '<p>Username or email is already in use</p>
		<p><a href="register.php">Back to Registration</a></p>';
	
}
}


######## FORGOT PASSWORD

#If the form sent is submitted with the name fix, then this if statement will run.
if (isset($_POST['fix'])){

	#Sets the variables from the post method after "scrubbing" them, as well as verifying them.
	$username = scrub($_POST['username']);
	$password = scrub($_POST['password']);
	$email = verify($_POST['email']);

	#Creating the query statement which will check to see if the user and email are within the database.
	$stmt = $conn->prepare('SELECT * FROM users WHERE username = :un or email = :em');
	$stmt->execute(array(
	':un'=> $username,
	':em'=> $email));

	#if a single row is returned, then the password will be updated on the database.
	if ($stmt->rowCount() == 1){

		$stmt = $conn->prepare("UPDATE users SET password = :pw WHERE username = :un and email = :em");
		$stmt->execute(array(
			':un'=>$username,
			':pw'=>sha1($password),
			':em'=>$email));

		echo 'Password Changed ' .$username;
		echo '<p><a href="index.php">Home</a></p>';
	} else{
		#if zero or more than one row is returned then the user is redirected.
		header('Location:forgot.php');
}
}


?>