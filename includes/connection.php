<?php

//TODO: convert database connection to PDO
$server = "localhost";
$username = "root";
$password = "2455";
$db = "db_clientaddressbook";

$conn = mysqli_connect($server, $username, $password, $db);

if (!$conn) {
    die("Sorry connection failed: " . mysqli_connect_error());
}
?>
