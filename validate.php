<?php
require 'conn.php';

// Retrieve form data
$user = isset($_POST['username']) ? trim($_POST['username']) : '';
$firstName = isset($_POST['FirstName']) ? trim($_POST['FirstName']) : '';
$lastName = isset($_POST['LastName']) ? trim($_POST['LastName']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phno']) ? trim($_POST['phno']) : '';
$pass = isset($_POST['pass']) ? trim($_POST['pass']) : '';

// Check for empty fields
if (empty($user) || empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($pass)) {
    echo "PLEASE ENTER ALL FIELDS";
    exit;
}

// Regular expressions for validation
$user_pattern = "/^[a-zA-Z0-9_.]+$/"; // Username can contain letters, numbers, underscores, and dots
$name_pattern = "/^[a-zA-Z]+$/"; // First and last name should contain only letters
$email_pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/"; // Valid email format
$phone_pattern = "/^[0-9]{10,15}$/"; // Phone number should contain 10-15 digits
$pass_pattern = "/^[a-zA-Z0-9_.@#$%,]{8,30}$/"; // Password constraints

if (!preg_match($user_pattern, $user)) {
    echo "Error: Invalid username format.";
} elseif (!preg_match($name_pattern, $firstName)) {
    echo "Error: First name should contain only letters.";
} elseif (!preg_match($name_pattern, $lastName)) {
    echo "Error: Last name should contain only letters.";
} elseif (!preg_match($email_pattern, $email)) {
    echo "Error: Invalid email format.";
} elseif (!preg_match($phone_pattern, $phone)) {
    echo "Error: Invalid phone number format.";
} elseif (!preg_match($pass_pattern, $pass)) {
    echo "Error: Password must be 8-30 characters long and contain only allowed special characters.";
} else {
    require 'insert.php'; // Proceed with data insertion
}
