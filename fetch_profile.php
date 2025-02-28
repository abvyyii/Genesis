<?php
session_start();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    echo "<table>
            <tr><th>Username:</th><td>{$user['username']}</td></tr>
            <tr><th>First Name:</th><td>{$user['firstname']}</td></tr>
            <tr><th>Last Name:</th><td>{$user['lastname']}</td></tr>
            <tr><th>Phone Number:</th><td>{$user['phno']}</td></tr>
            <tr><th>Email:</th><td>{$user['email']}</td></tr>
          </table>";
} else {
    echo "<p>Not logged in</p>";
}
?>