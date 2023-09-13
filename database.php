<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "db_exam";
$port = "4306";

$connection = mysqli_connect($host, $user, $password, $database, $port);

if (mysqli_connect_error()) {
    echo "Error: Unable to connect to MySQL <br>";
    echo "Message: " . mysqli_connect_error() . "<br>";
}
?>