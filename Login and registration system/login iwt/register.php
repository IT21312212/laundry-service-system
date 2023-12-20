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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["first-name"];
    $lastName = $_POST["last-name"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Insert data into the database
    $sql = "INSERT INTO register (firstname, lastname, dob, gender, address, email, username, password)
     VALUES ('$firstName','$lastName','$dob','$gender','$address','$email','$username','$password')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful, create a session with the username
        $_SESSION['username'] = $username;
        
        // Redirect to the login page
        header("Location: login.html");
        exit(); // Make sure to exit to prevent further execution
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
