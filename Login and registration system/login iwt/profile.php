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

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html"); // Redirect to the login page if not logged in
    exit();
}

$username = $_SESSION['username'];

// Fetch user details from the database (sanitize input to prevent SQL injection)
$stmt = $conn->prepare("SELECT firstname, lastname, dob, gender, address, email, password FROM register WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Store user details in variables
    $firstName = $row['firstname'];
    $lastName = $row['lastname'];
    $dob = $row['dob'];
    $gender = $row['gender'];
    $address = $row['address'];
    $email = $row['email'];
    $password = $row['password']; // Store the hashed password
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="profile1.css">
        <!-- Link to your CSS file for styling -->
        <title>Profile</title>
    </head>
    <body>
    <img src ="acc.avif" class="img1">
        <div class="profile-container">
            <div class="profile-photo">
                <img
                    src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNSvcz8OHDlh3YOCYm58kJ5D3c_s6oWhQdGg&usqp=CAU'
                    alt="Profile Photo">
            </div>
            <h1>Welcome to Your Profile</h1>
            <div class="profile-details">
                <form id="profile-form" method="post" action="updateprofile.php" >
                    <!-- Add the action for updating the profile -->
                    <!-- Editable fields -->
                    <div class="form-group">
                        <label for="edit-first-name">First Name:</label>
                        <input
                            type="text"
                            id="edit-first-name"
                            name="firstname"
                            value="<?php echo $firstName; ?>"
                            readonly="readonly"
                            class="editable">
                    </div>
                    <div class="form-group">
                        <label for="edit-last-name">Last Name:</label>
                        <input
                            type="text"
                            id="edit-last-name"
                            name="lastname"
                            value="<?php echo $lastName; ?>"
                            readonly="readonly"
                            class="editable">
                    </div>
                    <div class="form-group">
                        <label for="edit-dob">Date of Birth:</label>
                        <input
                            type="date"
                            id="edit-dob"
                            name="dob"
                            value="<?php echo $dob; ?>"
                            readonly="readonly"
                            class="editable">
                    </div>
                    <div class="form-group">
                        <label>Gender:</label>
                        <input
                            type="radio"
                            id="edit-male"
                            name="gender"
                            value="male"
                            <?php if ($gender === 'male') echo 'checked'; ?>
                            readonly="readonly"
                            class="editable">
                        <label for="edit-male">Male</label>
                        <input
                            type="radio"
                            id="edit-female"
                            name="gender"
                            value="female"
                            <?php if ($gender === 'female') echo 'checked'; ?>
                            readonly="readonly"
                            class="editable">
                        <label for="edit-female">Female</label>
                        <input
                            type="radio"
                            id="edit-other"
                            name="gender"
                            value="other"
                            <?php if ($gender === 'other') echo 'checked'; ?>
                            readonly="readonly"
                            class="editable">
                        <label for="edit-other">Other</label>
                    </div>

                    <div class="form-group">
                        <label for="edit-address">Address:</label>
                        <input
                            type="text"
                            id="edit-address"
                            name="address"
                            value="<?php echo $address; ?>"
                            readonly="readonly"
                            class="editable">
                    </div>
                    <div class="form-group">
                        <label for="edit-email">Email:</label>
                        <input
                            type="email"
                            id="edit-email"
                            name="email"
                            value="<?php echo $email; ?>"
                            readonly="readonly"
                            class="editable">
                    </div>
                    <div class="form-group">
                        <label for="edit-username">Username:</label>
                        <input
                            type="text"
                            id="edit-username"
                            name="username"
                            value="<?php echo $username; ?>"
                            readonly="readonly"
                            class="editable">
                    </div>
                    <div class="form-group">
                        <label for="edit-password">Password:</label>
                        <input
                            type="text"
                            id="edit-password"
                            name="password"
                            value="<?php echo $password; ?>"
                            readonly="readonly"
                            class="editable">
                    </div>

                    <!-- Buttons for editing and updating -->
                    <button type="button" id="edit-button">Edit</button>
                    <button type="submit" id="update-button" style="display:none;">Update</button>
                    <!-- Change type to "submit" for updating -->
                    <button type="button" id="delete-button" onclick='deleteData()'>Delete</button>
                    
                </form>
                
            </div>
            <a href="logout.php">Logout</a>
            <!-- Link to a logout script -->
        </div>
        <script src="profile.js"></script>
        <!-- Link to your JavaScript file for interaction -->
            
    </body>
</html>