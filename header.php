<!--Header file which starts sessions, checks to see if the cart session is empty, and if so it adds an array to it.-->

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $pagetitle;?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<div>
	
	<?php
	session_start();
	
	#If the session variable cart is empty then it will add in an array.
	if(empty($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}

	#Counts how many variables are within the cart. Displays a number back to the user
	$cartItems = count($_SESSION['cart']);
	include_once('con/db.php');

	echo "<a href='index.php'>Products</a>";
	
	#If the user has not logged in, then the header will display a login form with options to register or reset your password.
	if(!isset($_SESSION['user'])){
	echo '<form method="post" action="userLog.php">
			<input type="text" name="username" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<button class="btn btn-default"type="submit" name="login">Log In</button>
			<a href="register.php">Sign Up!</a>
			<a href="forgot.php">I Forgot!</a>
		</form>

	';

	} else{

		#If the user is logged in then the cart is shown and the logout button is made available for them.
		echo "<h1>Hello " . $_SESSION['user'].'</h1>
		<p><a href="cart.php">Cart: '.$cartItems.'</a></p>
		<p><a href="logout.php">Log Out</a></p>';	
	}
	?>

	