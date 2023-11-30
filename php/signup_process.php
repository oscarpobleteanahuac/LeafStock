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
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $birthdate = $_POST['birthdate'];
    $password = md5($_POST['password']); 
    $confirm_password = md5($_POST['confirm_password']); // MD5 hashing for demonstration purposes (not recommended)

    // Use real_escape_string to prevent SQL injection
    $full_name = $conn->real_escape_string($full_name);
    $email = $conn->real_escape_string($email);

    // Check if the email is already registered
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email already exists, set an error message and redirect to signup page
        $_SESSION["signup_error_status"] = true;
        $_SESSION["signup_error_message"] = "That email is already registered.";
        header("Location: signup.php");
        exit();
    }

    // Check if the password and confirm password match
    if ($password !== $confirm_password) {
        // Passwords don't match, set an error message and redirect to signup page
        $_SESSION["signup_error_status"] = true;
        $_SESSION["signup_error_message"] = "Passwords do not match.";
        header("Location: signup.php");
        exit();
    }

    // Perform the database insert
    $stmt = $conn->prepare("INSERT INTO users (name, email, birth_date, pwd) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $full_name, $email, $birthdate, $password);
    $stmt->execute();

    // Redirect to login page after successful signup
    header("Location: login.php");
    exit();
}

// Redirect to signup page if someone tries to access this script without submitting the form
header("Location: signup.php");
exit();
?>
