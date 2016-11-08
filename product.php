<?php

	#Grabs the product id and name from the url and stores them for later use.
	$product_id = $_GET['id'];
	$product_name = $_GET['name'];

	$pagetitle=$product_name;

	include_once('header.php');

	#Prepares statement to query database where the id and the name from the variable is found.
	$stmt = $conn->prepare("SELECT * FROM products WHERE id = :id AND name = :name");
		$stmt->execute(array(
			':id'=> $product_id,
			':name'=> $product_name));

	#Checks to see if a single row is found, if it is then it will display the content.
	if ($stmt->rowCount() == 1){

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		echo "<div class='col-sm-12'><img src='./{$img}'/>";

		echo"<p>{$name}</p>";
		echo"<p>{$description}</p>";
		echo"<p>$".$row['price']."</p>";

		# If the user session variable is active then it will allow the user to display a cart.
		if (isset($_SESSION['user'])) {
			echo"<a href='add_product.php?id={$id}&name={$name}'>Add to Cart</a></div>";
	} else {
		#IF the user us not logged in then it will ask the user to log in to add to cart.
		echo "Please log in to add to cart.";
	}

	#
	} 
	} else {
		#If no content is found then it will echo this statement
		echo "Sorry, this item does not seem to be available!";
	}

include_once('footer.php');
?>