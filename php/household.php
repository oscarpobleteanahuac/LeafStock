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

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    // Fetch user's admin status
    $sqlAdmin = "SELECT admin FROM users WHERE user_id = ?";
    $stmtAdmin = $conn->prepare($sqlAdmin);
    $stmtAdmin->bind_param("i", $userId);
    $stmtAdmin->execute();
    $stmtAdmin->bind_result($admin);
    $stmtAdmin->fetch();
    $stmtAdmin->close();

    // Fetch item count
    $sqlItemCount = "SELECT COUNT(*) FROM shopping_cart WHERE user_id = ?";
    $stmtItemCount = $conn->prepare($sqlItemCount);
    $stmtItemCount->bind_param("i", $userId);
    $stmtItemCount->execute();
    $stmtItemCount->bind_result($item_count);
    $stmtItemCount->fetch();
    $stmtItemCount->close();
} 

// Fetch household products from the database
$sql = "SELECT * FROM products WHERE products.category_id = 1";
$result = $conn->query($sql);

if (!$result) {
   echo "Error executing query: " . $conn->error;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- site metas -->
    <title>Household</title>
    <meta name="keywords" content="Household Products">
    <meta name="description" content="">
    <meta name="author" content="Oscar Poblete">

    <!-- style css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
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

<body class="main-layout product_page">
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

    <!-- plant -->
    <div id="household" class="section product">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="titlepage">
                        <h2><strong class="black"> Household</strong> Products</h2>
                        <span class="featured-text">Elevate your living spaces effortlessly with our range of stylish and practical household essentials. 
                              From chic soap dispensers to elegant lamps, discover functional products designed with your home and the environment in mind</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shop_main section ">
    <div class="container">
        <div class="row">
            <?php
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">';
                echo '<div class="store_product" data-toggle="modal" data-target="#modal' . $row["product_id"] . '">';
                echo '<figure><img src="../' . $row["photo"] . '" alt="img"/></figure>';
                echo '<h3>$<strong class="price_text">' . $row["price"] . '</strong></h3>';
                echo '<h4>' . $row["name"] . '</h4>';
                echo '</div>';
                echo '</div>';

                // Modal HTML
                echo '<div class="modal fade" id="modal' . $row["product_id"] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                echo '<div class="modal-dialog" role="document">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="exampleModalLabel">' . $row["name"] . '</h5>';
                echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                echo '<span aria-hidden="true">&times;</span>';
                echo '</button>';
                echo '</div>';
                echo '<div class="modal-body">';
                echo '<div class="row">';
                echo '<div class="col-md-6">';
                echo '<img src="../' . $row["photo"] . '" alt="' . $row["name"] . '" class="img-fluid">';
                echo '</div>';
                echo '<div class="col-md-6">';
                echo '<p><strong style="color:#00631f;">Description:</strong> ' . $row["description"] . '</p>';
                echo '<p><strong style="color:#00631f;">Price:</strong> $' . $row["price"] . '</p>';
                if ($row["quantity"] == 0) {
                  echo '<p><strong style="color:red;">Out of stock</strong></p>';
               } else {
                  echo '<p><strong style="color:#00631f;">Quantity:</strong> ' . $row["quantity"] . '</p>';
                }
                echo '<p><strong style="color:#00631f;">Manufacturer:</strong> ' . $row["manufacturer"] . '</p>';
                echo '<p><strong style="color:#00631f;">Origin:</strong> ' . $row["origin"] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div class="modal-footer">';
                echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                if ($admin != 1 && $row["quantity"] > 0) {
                 echo '<a href="add_cart.php?id=' . $row["product_id"] . '" class="btn btn-primary">Add to Cart</a>';
                }
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
         </div>
       </div>
   </div>
    <!-- end plant -->

    <!-- footer start-->
    <div id="plant" class="footer layout_padding">
        <div class="container">
            <p>© 2023 LeafStock. All Rights Reserved.</p>
        </div>
    </div>

    <!-- Javascript files-->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.0.0.min.js"></script>
    <script src="../js/plugin.js"></script>
    
    <!-- sidebar -->
    <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../js/custom.js"></script>
    
</body>
</html>
