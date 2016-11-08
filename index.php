<?php

#Home page of the website

$pagetitle = "Products";

include_once('header.php');

	#Creating the query statement which is looking to grab all products from the database.

	$stmt = $conn->prepare("SELECT * FROM products");
	$stmt->execute();

	#Runs through the entire stmt variable and creates the proper amount of content for the number of rows stored in the statement
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		echo "<div class=' well col-sm-6 col-md-4 col-lg-3'><img src='./{$img}'/>";

		echo"<p><a href='product.php?id={$id}&name={$name}'>{$name}</a> &middot; $".$row['price']."</p></div>";


/*	$query = 'SELECT * FROM products';

	$result = $conn->query($query);

	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()) {
			echo 'id: ' . $row["id"];
		}
	} else {
		echo "No Results!";
	}*/

}

include_once('footer.php');
?>