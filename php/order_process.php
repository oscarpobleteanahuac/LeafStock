<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "leafstock";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_purchase'])) {
    $userId = $_SESSION['user_id'];

    // Fetch user's details
    $sqlUserDetails = "SELECT name, email, card_number, postal_address FROM users WHERE user_id = ?";
    $stmtUserDetails = $conn->prepare($sqlUserDetails);
    $stmtUserDetails->bind_param("i", $userId);
    $stmtUserDetails->execute();
    $stmtUserDetails->bind_result($name, $email, $cardNumber, $postalAddress);
    $stmtUserDetails->fetch();
    $stmtUserDetails->close();

    // Check if user provided new card number
    $newCardNumber = isset($_POST['card_number']) ? trim($_POST['card_number']) : '';

    if ($newCardNumber) {
        // Update or insert card number
        $sqlUpdateCard = "UPDATE users SET card_number = ? WHERE user_id = ?";
        $stmtUpdateCard = $conn->prepare($sqlUpdateCard);
        $stmtUpdateCard->bind_param("si", $newCardNumber, $userId);
        $stmtUpdateCard->execute();
        $stmtUpdateCard->close();
    }

    // Check if user provided new postal address
    $newPostalAddress = isset($_POST['postal_address']) ? trim($_POST['postal_address']) : '';

    if ($newPostalAddress) {
        // Update or insert postal address
        $sqlUpdateAddress = "UPDATE users SET postal_address = ? WHERE user_id = ?";
        $stmtUpdateAddress = $conn->prepare($sqlUpdateAddress);
        $stmtUpdateAddress->bind_param("si", $newPostalAddress, $userId);
        $stmtUpdateAddress->execute();
        $stmtUpdateAddress->close();
    }

    // Insert purchase details into purchase history
    $sqlInsertPurchase = "INSERT INTO purchase_history (user_id, product_id, quantity, total_price)
                          SELECT ?, sc.product_id, COUNT(sc.product_id), SUM(p.price)
                          FROM shopping_cart sc
                          JOIN products p ON sc.product_id = p.product_id
                          WHERE sc.user_id = ?
                          GROUP BY sc.product_id";
    $stmtInsertPurchase = $conn->prepare($sqlInsertPurchase);
    $stmtInsertPurchase->bind_param("ii", $userId, $userId);
    $stmtInsertPurchase->execute();
    $stmtInsertPurchase->close();

    // Update product inventory (reduce quantity)
    $sqlUpdateInventory = "UPDATE products p
                           JOIN shopping_cart sc ON p.product_id = sc.product_id
                           SET p.quantity = p.quantity - COUNT(sc.product_id)
                           WHERE sc.user_id = ?";
    $stmtUpdateInventory = $conn->prepare($sqlUpdateInventory);
    $stmtUpdateInventory->bind_param("i", $userId);
    $stmtUpdateInventory->execute();
    $stmtUpdateInventory->close();

    // Clear shopping cart after purchase
    $sqlClearCart = "DELETE FROM shopping_cart WHERE user_id = ?";
    $stmtClearCart = $conn->prepare($sqlClearCart);
    $stmtClearCart->bind_param("i", $userId);
    $stmtClearCart->execute();
    $stmtClearCart->close();

    // Redirect to a confirmation page or wherever you need to go next
    header("Location: confirmation.php");
    exit();
}

$conn->close();

?>
