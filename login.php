<?php
session_start();
$_SESSION['$id'];

include('con/db.php');
include('clean.php');

if (isset($_POST['login'])){

	$username = scrub($_POST['username']);
	$password = scrub($_POST['password']);

	$stmt = $conn->prepare('SELECT * FROM users WHERE username = :un and password = :pw');
	$stmt->execute(array(
	':un'=> $username,
	':pw'=> $password));

	/*$stmt->bindParam(':un', $username);
	$stmt->bindParam(':pw', $password);
	$stmt->execute();*/

	if($stmt->rowCount() == 1) {
	header('Location: pass.php');
} else {
	echo 'Wrong-o';
}

}

?>