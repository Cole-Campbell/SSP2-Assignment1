<?php
#Adds product id to $_SESSION['cart'] for use later.
session_start();
include_once('con/db.php');
	
	#Grabs variables from URL and assigns them to variables.
	$id = $_GET['id'];
	$name = $_GET['name'];

	#if statement declaring that if a session for cart is not set then it will create an empty array.
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	} else{

		#Adds the product id to the session variable cart.
		$_SESSION['cart'][$id] = $id;
		
		#Redirects back to the product page.
		header('Location:product.php?id='.$id.'&name='.$name);
	}

?>