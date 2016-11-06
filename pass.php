<?php
include_once('header.php');

if (isset($_SESSION['user'])) {
	
	include_once('con/db.php');

	$stmt = $conn->prepare("SELECT * FROM products");
	$stmt->execute();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		
		echo '<img src="./'.$row["img"].'"/>';

		echo'<p><a href="product.php?id='.$row['id'].'">'.$row['name'].'</a></p>';


	#
	}

/*	$query = 'SELECT * FROM products';

	$result = $conn->query($query);

	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()) {
			echo 'id: ' . $row["id"];
		}
	} else {
		echo "No Results!";
	}*/

	echo '<h1>SUCCESS!</h1>
		<p>'.$_SESSION['user'].'</p>
		<a href="logout.php">Log Out</a>';	



} else {
	include('header.html');
}
?>