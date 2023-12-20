<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laundry";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $newPassword = $_POST['newPassword']; // Changed field name
    $confirmPassword = $_POST['confirmPassword']; // Changed field name

    // Validate the email and password fields as needed

    // Check if the email exists in your database using a regular SQL query
    $sql = "SELECT * FROM register WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user's data
        $row = $result->fetch_assoc();

        // Check if the new password and confirm password match
        if ($newPassword == $confirmPassword) {
            // Update the user's password
            $updateSql = "UPDATE register SET password = '$newPassword' WHERE email = '$email'";

            if ($conn->query($updateSql) === TRUE) {
                // Password reset successful
                header("Location: login.html"); // Redirect to the login page
                exit();
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo "New password and confirm password do not match.";
        }
    } else {
        echo "No user found with that email address.";
    }

    $conn->close();
}
?>
