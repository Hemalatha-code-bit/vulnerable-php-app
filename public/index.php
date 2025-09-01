<?php
// Simple Vulnerable PHP App
// DO NOT USE IN PRODUCTION

// Database connection (hardcoded credentials)
$conn = mysqli_connect("localhost", "root", "", "testdb");
if (!$conn) {
    die("Database connection failed!");
}

// Get user input (no validation → XSS + SQL Injection risk)
$username = $_GET['username'] ?? '';
$password = $_GET['password'] ?? '';

// Vulnerable SQL query (SQL Injection)
$stmt = $mysqli->prepare("SELECT * FROM users WHERE username=? AND password=?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
echo "Welcome, " . htmlentities($username) . "!";
} else {
    echo "Invalid credentials.";
}
