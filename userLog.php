<?php
session_start();
#$_SESSION['user_id'] = $data[$id];
#$_SESSION['username'] = $data[$username];

if (isset($_POST['login'])){

	include('con/db.php');
	include('clean.php');

	$username = scrub($_POST['username']);
	$password = scrub($_POST['password']);

	$stmt = $conn->prepare('SELECT * FROM users WHERE username = :un and password = :pw');
	$stmt->execute(array(
	':un'=> $username,
	':pw'=> sha1($password)));

	/*$stmt->bindParam(':un', $username);
	$stmt->bindParam(':pw', $password);
	$stmt->execute();*/

	if($stmt->rowCount() == 1) {
		$_SESSION['user'] = $username;

		header('Location: pass.php');


		return array(true, $stmt);
	} else {
		echo "The username/password you entered is invalid. Try again.";
	}

}

#####

if (isset($_POST['register'])){

	include('con/db.php');
	include('clean.php');

	$username = scrub($_POST['username']);
	$password = scrub($_POST['password']);
	$email = verify($_POST['email']);

	$stmt = $conn->prepare('SELECT * FROM users WHERE username = :un or email = :em');
	$stmt->execute(array(
	':un'=> $username,
	':em'=> $email));

	if ($stmt->rowCount() == 0){

		$stmt = $conn->prepare("INSERT INTO users (id, username, password, email) VALUES (NULL, :un, :pw, :em)");
		$stmt->execute(array(
			':un'=>$username,
			':pw'=>sha1($password),
			':em'=>$email));

		echo 'Registered ' .$username;
	} else{
		echo "Username Already Registered";
}
}


########
if (isset($_POST['fix'])){

	include('con/db.php');
	include('clean.php');

	$username = scrub($_POST['username']);
	$password = scrub($_POST['password']);
	$email = verify($_POST['email']);

	$stmt = $conn->prepare('SELECT * FROM users WHERE username = :un or email = :em');
	$stmt->execute(array(
	':un'=> $username,
	':em'=> $email));

	if ($stmt->rowCount() == 1){

		$stmt = $conn->prepare("UPDATE users SET password = :pw WHERE username = :un and email = :em");
		$stmt->execute(array(
			':un'=>$username,
			':pw'=>sha1($password),
			':em'=>$email));

		echo 'Password Changed ' .$username;
	} else{
		echo "Sorry, incorrect details provided. Please try again.";
}
}

?>