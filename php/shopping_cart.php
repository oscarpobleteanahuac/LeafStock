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

    if ($admin == 1) {
        header("Location: manage_store.php");
        exit();
    }

    // Fetch item count
    $sqlItemCount = "SELECT COUNT(*) FROM shopping_cart WHERE user_id = ?";
    $stmtItemCount = $conn->prepare($sqlItemCount);
    $stmtItemCount->bind_param("i", $userId);
    $stmtItemCount->execute();
    $stmtItemCount->bind_result($item_count);
    $stmtItemCount->fetch();
    $stmtItemCount->close();

    // Fetch user's cart items
    $sqlCart = "SELECT shopping_cart.product_id, products.name, products.photo, products.price, COUNT(shopping_cart.product_id) AS quantity
    FROM shopping_cart
    INNER JOIN products ON shopping_cart.product_id = products.product_id
    WHERE shopping_cart.user_id = ?
    GROUP BY shopping_cart.product_id";
    $stmtCart = $conn->prepare($sqlCart);
    $stmtCart->bind_param("i", $userId);
    $stmtCart->execute();
    $resultCart = $stmtCart->get_result();
    $stmtCart->close();

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
      <title>Shopping Cart</title>
      <meta name="keywords" content="Shopping Cart">
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
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout about_page">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="../images/assets/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header class="section">
         <!-- header inner -->
        <div class="header_main">
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
        </div>
         <!-- end header inner -->
      </header>
      <!-- end header -->
      
   <div id="cart" class="section product">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="titlepage">
                        <h2><strong class="black"> Shopping</strong> Cart</h2><br><br>
                              <?php
    if ($resultCart->num_rows > 0) {
        while ($cartItem = $resultCart->fetch_assoc()) {
            echo '<div class="card mt-3">';
            echo '<div class="card-body d-flex align-items-center">';
            echo '<img src="../' . $cartItem["photo"] . '" alt="' . $cartItem["name"] . '" class="mr-3" style="max-width: 120px;">'; // Add photo
            echo '<h3 class="card-title">' . $cartItem["name"] . '</h5>';
            echo '<p class="card-text">Price: $' . $cartItem["price"] . '</p>';

            // Add quantity control buttons
            echo '<form action="update_cart.php" method="post" class="ml-auto">';
            echo '<input type="hidden" name="product_id" value="' . $cartItem["product_id"] . '">';
            echo '<button type="submit" name="increment" class="btn btn-sm btn-secondary"> + </button>';
            echo '<span style="color: white; margin-right: 2px; text-align: center;">' . $cartItem["quantity"] . '</span>';
            echo '<button type="submit" name="decrement" class="btn btn-sm btn-secondary"> - </button>';
            echo '</form>';
           
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>Your shopping cart is empty.</p>';
    }
    ?>
<div class="col-md-13">
<?php if ($resultCart->num_rows > 0) : ?>
    <form action="empty_cart.php" method="post" class="d-flex justify-content-between">
        <button type="submit" class="btn btn-danger">Empty Cart</button>
            <a href="checkout.php" class="btn btn-success ml-2">Checkout</a>
    </form>
    <?php endif; ?>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

            <!-- footer start-->
      <div class="copyright_text">
      <div id="plant" class="footer layout_padding">
         <div class="container">
         <p>© 2023 LeafStock. All Rights Reserved.</a></p>
         </div>
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