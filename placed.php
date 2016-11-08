<?php

	#Page for placing order.

	#Including clean file which will be used later to call functions.
	$pagetitle="Order Placed";
	include_once('clean.php');
	include_once('header.php');

	#Grabs the content from the form of the previous page and saves it to variables.
	$orderName = scrub($_POST['name']);
	$address = scrub($_POST['address']);
	$email = scrub($_POST['email']);

	#Start of the email message to the user
	$msg = "<html>
				<head>
				  <title>Order for ".$orderName."</title>
				</head>
				<body>
				  <p>Thank you for placing your order ".$orderName."</p>
				  <table>
				    <tr>
				      <th>Item</th><th>Description</th><th>Price</th>
				    </tr>";

	#If the number of variables in the cart is more than 0 then it will run through this statement
	if(count($_SESSION['cart'])>0){
		$productIDs = "";
		#Takes each variable in the array and joins them together, seperated by commas
		foreach($_SESSION['cart'] as $id=>$value){
			$productIDs = $productIDs . $id . ",";
		}

		#Removes final dangling comma
		$productIDs = rtrim($productIDs, ',');

		#Statement for querying the database. Selecting all prooducts where the id is in the product ID variable.
		$stmt = $conn->prepare("SELECT * FROM products WHERE id IN ({$productIDs}) ORDER BY id");
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			#Remainder of msg variable. Will be run through and add the items the users gets.
			$msg .= "<tr>
					      <td><a href='http://dev.colecampbell.design/Assignment1/product.php?id={$id}&name=".$row['name']."'>{$name}</a></td><td>{$description}</td><td>$".$row['price']."</td>
					    </tr>
				";
		}
	}

	#Finishes off message
	$msg .= "</table>
			</body>
			</html>";
	#

	#Formats message and given headers are properties of the email such as format, from, to, bcc.
	$msg = wordwrap($msg,70);

	$headers = 'MIME-Version: 1.0'."\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: cole@colecampbell.design'."\r\n";
	$headers .= 'Bcc: cole.william.campbell@gmail.com'."\r\n";
	
	#Sends email to the user
	mail($email, 'Order Placed', $msg, $headers);

	#Unsets the session.
	unset($_SESSION['cart']);

	echo "<p>Your order has been placed!</p>";

?>