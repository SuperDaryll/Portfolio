<?php
$servername = "localhost"; // Usually localhost
$username = "root"; // Default username for MySQL
$password = ""; // Default password for MySQL (leave empty if using XAMPP/WAMP)
$dbname = "esports_tournament"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>