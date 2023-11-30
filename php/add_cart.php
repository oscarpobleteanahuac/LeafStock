<?php
session_start();

// Database credentials 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "leafstock";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Get the product_id from the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

    // Assuming having the user_id in the session
    $user_id = $_SESSION['user_id'];

     // Insert the product into the shopping cart
     $sql = "INSERT INTO shopping_cart (user_id, product_id) VALUES (?, ?)";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("ii", $user_id, $product_id);
 
     if ($stmt->execute()) {
         // Get the referring page URL
         $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
 
         // Redirect back to the referring page
         header("Location: $referrer");
         exit();
     } else {
         echo "Error adding product to the cart: " . $stmt->error;
     }
 
     $stmt->close();
     $conn->close();
 } else {
     echo "Invalid product ID";
 }
 // Redirect to home page if someone tries to access this script without adding a product to the cart
 header("Location: ../index.php");
 exit();
 ?>
