<?php

	#Forgot password page which allows the user to submit their details to update their password.

	session_start();
?>

<form action="userLog.php" method="post">
	<input type="text" name="username" placeholder="Username" />
	<input type="text" name="email" placeholder="Email" />
	<input type="text" name="password" placeholder="Password" />
	<button type="submit" name="fix" >Change Password</button>
</form>