<?php
$servername="localhost";
$username="root";
$password="";

$conn= mysqli_connect("$servername", $username, $password);

if (!$conn ) {
    echo "connection error" . mysqli_connect_error(). "<br>";
}
?>