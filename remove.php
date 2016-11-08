<?php
#Removes an item from the cart by the id.
session_start();
include_once('con/db.php');
	
	#Sets the id variable from the url, as the id is sent by get.
	$id = $_GET['id'];

	#If the session cart variable is not set then it will be set now and given an empty array.
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	} else{
		#If the cart is not empty, then this will unset the specified id from the cart and redirect the user to the cart.
		unset($_SESSION['cart'][$id]);
		
		header('Location:cart.php');
	}

?>