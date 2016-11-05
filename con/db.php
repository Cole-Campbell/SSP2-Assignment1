<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'users');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

$conn = new PDO('mysql:host=localhost; dbname=users', DB_USER, DB_PASSWORD);
?>