<?php

#Functions which clean text from input fields before proceeding to add them or using them to query the database

function scrub($data){
	if(isset($data)){
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = strip_tags($data);
		$data = trim($data);
		$data = htmlentities($data);
		return $data;
	}
}


#Function verifies that the email provided is valid.

function verify($data){

	if (!filter_var($data, FILTER_VALIDATE_EMAIL)){
		header('Location:register.php');
		$_SESSION['error'] = "Invalid Email";
	} else{
		$cleanEmail = filter_var($data, FILTER_SANITIZE_EMAIL);

		if (filter_var($cleanEmail, FILTER_VALIDATE_EMAIL)) {
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = strip_tags($data);
		$data = trim($data);
		$data = htmlentities($data);
		return $data;
	}
	}
}

?>