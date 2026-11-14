<?php
$host = 'localhost';
$username = 'root';
$password = ''; // XAMP default password
$database = 'food_ordering';
$port = 3306; // XAMP MySQL port

// Create connection
$conn = new mysqli($host, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    // Return JSON instead of dying with HTML
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'DB connection failed: ' . $conn->connect_error]);
    exit;
}
?>