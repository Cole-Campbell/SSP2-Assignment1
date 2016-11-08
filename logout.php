<?php

#Logout which will unset the session, destroy it and return the user back to the page they logged out on.
session_start();

unset($_SESSION['username']);
session_destroy();
echo $_SESSION['lasturl'];
header('Location:index.php');
?>