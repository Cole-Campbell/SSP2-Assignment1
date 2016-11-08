<?php

	$pagetitle="Place Order";
	include_once('header.php');

	#Checks to see if the cart has any variables.
	if(count($_SESSION['cart'])>0){
		$productIDs = "";

		#Runs theough the session variable and joins them together, seperated by commas.
		foreach($_SESSION['cart'] as $id=>$value){
			$productIDs = $productIDs . $id . ",";
		}

		#Removes final comma
		$productIDs = rtrim($productIDs, ',');

		#Prepares query statement for the database, selection all from the products table where the id is in the variable $productIDs
		$stmt = $conn->prepare("SELECT * FROM products WHERE id IN ({$productIDs}) ORDER BY id");
		$stmt->execute();

		#Echos from which passes content over to placed.php
		echo "
			<form method='post' action='placed.php'>
				<input type='text' name='name' placeholder='Full Name'/><br/>
				<input type='text' name='address' placeholder='Address For Delivery'/></br/>
				<input type='text' name='email' placeholder='Email Address'/><br/>
				<button type='submit' name='placeorder'>Place Order</button>
			</form>";

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);

		#Echos this content as many times as there is rows pulled from the database.
		echo "<div class='col-sm-12'><img src='./{$img}'/>";

		echo"<p>{$name}</p>";
		echo"<p>{$description}</p>";
		echo"<p>$".$row['price']."</p></div><hr/>";

		$totalPrice='';
		$totalPrice+=$price;
	#
	} 
		echo "<p class='col-sm-12'>Total: $".$totalPrice."</p>";
	} else{
		#if no variables are in the cart, then it will echo this statement.
		echo "Sorry, your cart is empty";
	}

?>