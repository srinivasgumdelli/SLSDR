<?php
// Change this parameter with your connection's info.
$db_host = "http://localhost";
$db_name = "DBNAME";
$username = "USERNAME";
$password = "PASSWORD";
$con = mysqli_connect($db_host, $username, $password, $db_name) or die("database connection error" . mysqli_error($con));
// Connection
?>
