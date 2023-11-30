<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "leafstock";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['increment']) || isset($_POST['decrement'])) {
        $productId = $_POST['product_id'];

        if (isset($_POST['increment'])) {
            // Increment quantity
            $sql = "INSERT INTO shopping_cart (user_id, product_id) VALUES (?, ?)";
        } elseif (isset($_POST['decrement'])) {
            // Decrement quantity
            $sql = "DELETE FROM shopping_cart WHERE user_id = ? AND product_id = ? LIMIT 1";
        }

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error in query preparation: " . $conn->error);
        }

        $stmt->bind_param("ii", $userId, $productId);

        if (!$stmt->execute()) {
            die("Error executing query: " . $stmt->error);
        }

        $stmt->close();
    }
}
$conn->close();

// Redirect back to shopping cart page
header("Location: shopping_cart.php");
exit();


?>
