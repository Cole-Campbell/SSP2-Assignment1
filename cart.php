<?php
include_once('header.php');
	
	if(count($_SESSION['cart'])>0){
		$productIDs = "";
		foreach($_SESSION['cart'] as $id=>$value){
			$productIDs = $productIDs . $id . ",";
		}

		$productIDs = rtrim($productIDs, ',');

		$stmt = $conn->prepare("SELECT * FROM products WHERE id IN ({$productIDs}) ORDER BY id");
		$stmt->execute();

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		echo "<img src='./{$img}'/>";

		echo"<p>{$name}</p>";
		echo"<p>{$description}</p>";;

	#
	} 
	} else{
		echo "Sorry, your cart is empty";
	}

	
?>