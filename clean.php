<?php

function scrub($data){
	if(isset($data)){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = strip_tags($data);
		$data = htmlentities($data);
		return $data;
	}
}

function verify($data){

	if (!filter_var($data, FILTER_VALIDATE_EMAIL)){
		echo 'Invalid Email';
	} else{
		$cleanEmail = filter_var($data, FILTER_SANITIZE_EMAIL);

		if (filter_var($cleanEmail, FILTER_VALIDATE_EMAIL)) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = strip_tags($data);
		$data = htmlentities($data);
		return $data;
	}
	}
}

?>