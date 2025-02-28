<?php
require "conn.php";
$dbname = "login";
$tbname = "login_info";

// Create Database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database has been created/exists <br>";
} else {
    echo "Database couldn't be created: " . $conn->error;
}

// Select Database
$conn->select_db($dbname);

// Create Table with correct columns
$sql2 = "CREATE TABLE IF NOT EXISTS $tbname (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phno VARCHAR(15) NOT NULL,
    pass VARCHAR(255) NOT NULL
)";

if ($conn->query($sql2) === TRUE) {
    echo "Table '$tbname' checked/created successfully.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}
?>
