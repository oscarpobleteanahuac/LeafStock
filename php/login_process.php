<?php
session_start();

// Database credentials 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "leafstock";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Use real_escape_string to prevent SQL injection
    $email = $conn->real_escape_string($email);

    // Query the database using prepared statements
    $stmt = $conn->prepare("SELECT user_id, pwd FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Verify the password using MD5 (not recommended for security)
    if ($hashed_password !== null && md5($password) === $hashed_password) {
        // Login successful, set session variables 
        $_SESSION["user_id"] = $user_id;
        // Redirect to index
        header("Location: ../index.php");
        exit();
    } else {
        // Login failed, set an error indicator
        $_SESSION["login_error"] = true;
        // Redirect back to the login page
        header("Location: login.php");
        exit();
    }
}

// Redirect to login page if someone tries to access this script without submitting the form
header("Location: login.php");
exit();
?>
