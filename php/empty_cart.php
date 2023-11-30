<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "leafstock";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Delete all items in the shopping cart for the current user
    $sqlDeleteCart = "DELETE FROM shopping_cart WHERE user_id = ?";
    $stmtDeleteCart = $conn->prepare($sqlDeleteCart);
    $stmtDeleteCart->bind_param("i", $userId);
    $stmtDeleteCart->execute();
    $stmtDeleteCart->close();

    // Redirect to shopping cart page
    header("Location: shopping_cart.php");
    exit();
}
?>
