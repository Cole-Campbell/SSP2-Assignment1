<?php
session_start();
?>
<h1>SUCCESS!</h1>

<a href="logout.php">Log Out</a>
<?php

echo $_SESSION['$id'];

?>