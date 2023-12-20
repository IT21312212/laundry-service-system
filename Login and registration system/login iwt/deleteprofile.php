<?php
session_start();

// Check if the user is logged in and has an active session
if (isset($_SESSION['username'])) {
    // Assuming you have a database connection, replace the following with your own database connection code
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPass = '';
    $dbName = 'laundry';

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the username from the session
    $username = $_SESSION['username'];

    // Delete data from the database where the username matches
    $sql = "DELETE FROM register WHERE username = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $username);

        if ($stmt->execute()) {
            // Data deleted successfully
            echo "success";
        } else {
            // Failed to delete data, log the SQL error for debugging
            error_log("SQL Error: " . $stmt->error);
            echo "error";
        }

        $stmt->close();
    } else {
        // Error in the SQL statement
        echo "error";
    }

    $conn->close();
}
?>
