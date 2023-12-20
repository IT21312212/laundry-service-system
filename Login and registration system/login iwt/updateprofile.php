<?php
session_start(); // Start or resume the session

if (!isset($_SESSION['username'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.html");
    exit();
}

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission for updating the user profile

    // Retrieve updated data from the form
    $updatedFirstName = $_POST['firstname'];
    $updatedLastName = $_POST['lastname'];
    $updatedDob = $_POST['dob'];
    $updatedGender = $_POST['gender'];
    $updatedAddress = $_POST['address'];
    $updatedEmail = $_POST['email'];
    $updatedUsername = $_POST['username'];
    $updatedPassword = $_POST['password']; // Note: Handle password hashing securely

    // Implement the database update logic here without prepared statements
    $sql = "UPDATE register SET firstname='$updatedFirstName', lastname='$updatedLastName', dob='$updatedDob', gender='$updatedGender', address='$updatedAddress', email='$updatedEmail', password='$updatedPassword' WHERE username='$updatedUsername'";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the profile page after updating
        header("Location: profile.php");
        exit();
    } else {
        // Handle update errors
        echo "Update failed: " . $conn->error;
    }
} else {
    // Handle non-POST requests or direct access to this file
    // Redirect to an appropriate page or show an error message
}

$conn->close();
?>
