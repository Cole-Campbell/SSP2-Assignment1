<?php

	#Cart page which will display all of the content within the session variable 'cart'
	$pagetitle="Cart";
	include_once('header.php');

	#Running if statement to see if there are any ids within the cart session variable.
	if(count($_SESSION['cart'])>0){
		
		#declaring productIDs variable for later use.
		$productIDs = "";

		#For each statement runs through the cart and obtains each id, adding it to the productIDs variable and adding commas after every entry
		foreach($_SESSION['cart'] as $id=>$value){
			$productIDs = $productIDs . $id . ",";
		}

		#Removes last dangling comma at the end
		$productIDs = rtrim($productIDs, ',');

		#Querying the products database for all products within the productIDs variable, and ordering them by id.
		$stmt = $conn->prepare("SELECT * FROM products WHERE id IN ({$productIDs}) ORDER BY id");
		$stmt->execute();

		#Loops through each entry produced and stored into stmt variable and adds the content into the html echo below. Total price is calculated.
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);

		echo "<div class='well col-sm-6 col-md-4 col-lg-3'><img src='./{$img}'/>";
		echo "<p>{$name}</p>";
		echo "<p>{$description}</p>";
		echo "<p>$".$row['price']."</p>";
		echo "<p><a href='remove.php?id={$id}'>Remove</a></p></div>";

		$totalPrice='';
		$totalPrice+=$price;

	} 

	#Echo of total price and link to place the order.
	echo"<p class='col-sm-12'>Total: $".$totalPrice."</p><p class='col-sm-12'> <a href='placeorder.php'>Place Order</a></p>";
	} 

	#Else statement which echos message if the cart is empty.

	else{
		echo "Sorry, your cart is empty";
	}


	include_once('footer.php');
?>