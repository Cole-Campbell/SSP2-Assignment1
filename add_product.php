<?php
include_once('header.php');
	
	$id = $_GET['id'];

	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	} else{
		echo "test";
		$_SESSION['cart'][$id] = $id;
		header('Location:product.php?id='.$id);
	}
?>