<?php
session_start(); // Start a new or resume the existing session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laundry";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle user input
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Connect to your laundary database (Replace with your database credentials)
    $conn = new mysqli("localhost", "root", "", "laundry");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query the database to check if the user exists
    $query = "SELECT * FROM register WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Valid user, set session and redirect
        $_SESSION["username"] = $username;
        $successMessage = "Login successful! Redirecting to registration page...";
        header("Refresh: 1; URL=profile.php"); // Redirect after 1 seconds
    } else {
        $errorMessage = "Invalid username or password.";
    }

    $conn->close();
}

?>
