<?php
session_start(); // Start the session
require "conn.php";
require "filech.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['pass'];
    $firstname = $_POST['FirstName']; // Match the form's field name
    $lastname = $_POST['LastName'];  // Match the form's field name
    $phno = $_POST['phno']; // Corrected from 'phone' to 'phno'
    $email = $_POST['email'];

    $INSERT = "INSERT INTO $tbname (username, pass, firstname, lastname, phno, email) 
               VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($INSERT);
    $stmt->bind_param("ssssss", $user, $pass, $firstname, $lastname, $phno, $email);
    
    if ($stmt->execute()) {
        $_SESSION['user'] = [
            'username' => $user,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phno' => $phno, // Corrected session key to match DB column
            'email' => $email
        ];
        header("Location: products.html"); // Redirect after successful registration
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
