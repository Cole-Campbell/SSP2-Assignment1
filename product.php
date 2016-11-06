<?php
include_once('header.php');

	$product_id = $_GET['id'];

	$stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
		$stmt->execute(array(
			':id'=> $product_id));

	if ($stmt->rowCount() == 1){

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		echo "<img src='./{$img}'/>";

		echo"<p>{$name}</p>";
		echo"<p>{$description}</p>";
		echo"<a href='add_product.php?id={$id}'>Add to Cart</a>";

	#
	} 
	} else {
		echo "Sorry, this item does not seem to be available!";
	}


?>