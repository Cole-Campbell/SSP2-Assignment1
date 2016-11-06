<!DOCTYPE html>
<html>
<head>
	<title>Shoppe</title>
</head>
<body>
	<div>
	
	<?php
	session_start();
	if(empty($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
	$cartItems = count($_SESSION['cart']);
	include_once('con/db.php');
	if(!isset($_SESSION['user'])){
	echo '<form method="post" action="userLog.php">
			<input type="text" name="username" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<button type="submit" name="login">Log In</button>
			<a href="register.html">Sign Up!</a>
			<a href="forgot.html">I Forgot!</a>
		</form>
	';
	} else{
		echo "<h1>Hello " . $_SESSION['user'].'</h1>
		<p><a href="cart.php">Cart: '.$cartItems.'</a></p>';
	}
	?>

	