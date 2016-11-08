<?php
	#Register form which will post the contents of the form over to the userlog.php which will process the content appropriatly.
	session_start();
?>
	<form method="post" action="userLog.php">
	<input type="text" name="username" placeholder="Username">
	<input type="password" name="password" placeholder="Password">
	<input type="text" name="email" placeholder="Email">
	<button type="submit" name="register">Register</button>
</form>

<?php

?>

