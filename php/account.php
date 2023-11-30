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
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Get user data from the database
$userId = $_SESSION['user_id'];
$sql = "SELECT name, email, birth_date, card_number, postal_address, admin FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($name, $email, $birthDate, $cardNumber, $postalAddress, $admin);
$stmt->fetch();
$stmt->close();

// Fetch item count
$sqlItemCount = "SELECT COUNT(*) FROM shopping_cart WHERE user_id = ?";
$stmtItemCount = $conn->prepare($sqlItemCount);
$stmtItemCount->bind_param("i", $userId);
$stmtItemCount->execute();
$stmtItemCount->bind_result($item_count);
$stmtItemCount->fetch();
$stmtItemCount->close();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update the user's info
    $newCardNumber = $_POST['new_card_number'];
    $newPostalAddress = $_POST['new_postal_address'];
    
    // Check if a new password is provided
    $newPassword = $_POST['new_password'];
    if (!empty($newPassword)) {
        $hashedPassword = md5($newPassword);
        $updateSql = "UPDATE users SET card_number = ?, postal_address = ?, pwd = ? WHERE user_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("sssi", $newCardNumber, $newPostalAddress, $hashedPassword, $userId);
    } else {
        // If no new password, update without changing the password
        $updateSql = "UPDATE users SET card_number = ?, postal_address = ? WHERE user_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ssi", $newCardNumber, $newPostalAddress, $userId);
    }

    $updateStmt->execute();

    // Refresh page after updating
    header("Location: account.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Account</title>
    <meta name="keywords" content="Login">
    <meta name="description" content="">
    <meta name="author" content="Oscar Poblete Sáenz">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- favicon -->
    <link rel="icon" href="../images/assets/favicon.ico" type="image/ico">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="main-layout form_body info_page">
    <!-- loader -->
    <div class="loader_bg">
        <div class="loader"><img src="../images/assets/loading.gif" alt="#" /></div>
    </div>
    <!-- end loader -->
    <!-- header -->
    <header class="section">
        <!-- header inner -->
        <div class="header_main">
            <div class="container">
                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo"> <a href="../index.php"><img src="../images/assets/leaf_logo.png" alt="#"></a> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <div class="menu-area">
                            <div class="limit-box">
                                <nav class="main-menu">
                                    <ul class="menu-area-main">
                                        <li> <a href="../index.php">Home</a> </li>
                                        <li> <a href="about.php">About</a> </li>
                                        <li><a href="household.php">Household</a></li>
                                        <li><a href="garden.php">Garden</a></li>
                                        <?php
                                    if (isset($_SESSION['user_id'])) {
                                        echo '<li class="last"><a href="account.php"><img src="../images/assets/account_icon.png" alt="icon"/></li>';

                                        if ($admin == 1) {
                                            echo '<li class="last"><a href="manage_store.php"><img src="../images/assets/store_icon.png" alt="icon"/></li>';
                                        } else {
                                          echo '<li class="last"><a href="shopping_cart.php"><img src="../images/assets/cart_icon.png" alt="icon"/><span class="badge badge-pill badge-danger">' . $item_count . '</span></li>';
                                        }

                                        echo '<li class="last"><a href="logout.php"><img src="../images/assets/exit_icon.png" alt="icon" /></a></li>';
                                    } else {
                                        echo '<li class= "last"><a href="login.php"><img src="../images/assets/account_icon.png" alt="icon"/></a></li>';
                                    }
                                    ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end header inner -->
    </header>
    <!-- end header -->
    <body class="main-layout form_body info_page">
        <br><br>
        <main class="form_main">
            <div class="user-info">
                <div class="container">
                    <div class="titlepage">
                        <br>
                        <h2><strong class="black"> Account</strong> Info</h2>
                    </div>
                </div>
                <?php
                // Display the "View Order History" link in Account section only for regular users
                if ($admin == 0) {
                    echo '<div style="text-align: right; padding-right: 20px;">';
                    echo '<a href="order_history.php" class="featured-text-2">View Order History</a>';
                    echo '</div>';
                }
                ?>
                <form method="post" action="" class="form-2">
                    <br>
                    <table class="user-info-table">
                        <tr>
                            <td>User ID:</td>
                            <td><?php echo $userId; ?></td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td><?php echo $name; ?></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><?php echo $email; ?></td>
                        </tr>
                        <tr>
                            <td>Birth Date:</td>
                            <td><?php echo $birthDate; ?></td>
                        </tr>
                        <tr>
                            <td>Card Number:</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-pencil"></i></span>
                                    </div>
                                    <input type="text" name="new_card_number" pattern="\d{16}" title="Enter the 16 digits of your card." class="form-control" value="<?php echo $cardNumber; ?>" required readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Postal Address:</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-pencil"></i></span>
                                    </div>
                                    <input type="text" name="new_postal_address" class="form-control" value="<?php echo $postalAddress; ?>" required readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Change Password:</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-pencil"></i></span>
                                    </div>
                                    <input type="password" name="new_password" class="form-control" placeholder="Enter new password" required readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text show-hide-password">
                                            <i class="fa fa-eye" onclick="togglePasswordVisibility(this)"></i>
                                        </span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="user-info-button">Save Changes</button>
                </form>

                <div class="copyright_text">
                    <div id="plant" class="footer layout_padding">
                        <div class="container">
                            <p>© 2023 LeafStock. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>

                <script src="../js/form-interaction.js"></script>
                <script src="../js/jquery.min.js"></script>
                <script src="../js/popper.min.js"></script>
                <script src="../js/bootstrap.bundle.min.js"></script>
                <script src="../js/jquery-3.0.0.min.js"></script>
                <script src="../js/plugin.js"></script>
                <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
                <script src="../js/custom.js"></script>
</body>
</html>
