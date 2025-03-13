<?php
// Database configuration
$host = "localhost";        // usichange hapa
$username = "root";         // usichange hapa
$password = "";             // ibaki ivo empty
$database = "healthyscreening";  // Database yako

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";


?>