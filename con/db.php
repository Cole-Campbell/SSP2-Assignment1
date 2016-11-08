<?php

#Database connection variables being created.


# Localhost variables set for connection to database
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'users');

$conn = new PDO('mysql:host=localhost; dbname='.DB_NAME.'', DB_USER, DB_PASSWORD);
?>