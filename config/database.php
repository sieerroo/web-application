<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "music";

$connection = mysqli_connect($host, $username, $password, $database);

if(!$connection) {
    die("Connection to database failed :" . mysqli_connect_error());
}
?>
