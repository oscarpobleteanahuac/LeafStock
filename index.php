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

    // Fetch item count
    $sqlItemCount = "SELECT COUNT(*) FROM shopping_cart WHERE user_id = ?";
    $stmtItemCount = $conn->prepare($sqlItemCount);
    $stmtItemCount->bind_param("i", $userId);
    $stmtItemCount->execute();
    $stmtItemCount->bind_result($item_count);
    $stmtItemCount->fetch();
    $stmtItemCount->close();
} 

$sql = "SELECT * FROM products ORDER BY RAND() LIMIT 6";
$result = $conn->query($sql);

if (!$result) {
   echo "Error executing query: " . $conn->error;
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- site metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>LeafStock</title>
    <meta name="keywords" content="Home">
    <meta name="description" content="">
    <meta name="author" content="Oscar Poblete Sáenz">

    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- favicon -->
    <link rel="icon" href="images/assets/favicon.ico" type="image/ico">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- Owl carousel-->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
     <!-- bootstrap css -->
     <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="main-layout">

<div class="loader_bg">
    <div class="loader"><img src="images/assets/loading.gif" alt="#"/></div>
</div>

<header class="section">
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col logo_section">
                    <div class="full">
                        <div class="center-desk">
                            <div class="logo"> <a href="index.php"><img src="images/assets/leaf_logo.png" alt="#"></a> </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                    <div class="menu-area">
                        <div class="limit-box">
                            <nav class="main-menu">
                                <ul class="menu-area-main">
                                    <li> <a href="index.php">Home</a> </li>
                                    <li> <a href="php/about.php">About</a> </li>
                                    <li><a href="php/household.php">Household</a></li>
                                    <li><a href="php/garden.php">Garden</a></li>
                                    <?php
                                    if (isset($_SESSION['user_id'])) {
                                        echo '<li class="last"><a href="php/account.php"><img src="images/assets/account_icon.png" alt="icon"/></li>';

                                        if ($admin == 1) {
                                            echo '<li class="last"><a href="php/manage_store.php"><img src="images/assets/store_icon.png" alt="icon"/> </li>';
                                        } else {
                                          echo '<li class="last"><a href="php/shopping_cart.php"><img src="images/assets/cart_icon.png" alt="icon"/><span class="badge badge-pill badge-danger">' . $item_count . '</span></li>';
                                        }

                                        echo '<li class="last"><a href="php/logout.php"><img src="images/assets/exit_icon.png" alt="icon" /></a></li>';
                                    } else {
                                        echo '<li class= "last"><a href="php/login.php"><img src="images/assets/account_icon.png" alt="icon"/></a></li>';
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
</header>
      <!-- end header -->
      <section >
         <div id="main_slider" class="section carousel slide banner-main" data-ride="carousel">
            <ol class="carousel-indicators">
               <li data-target="#main_slider" data-slide-to="0" class="active"></li>
               <li data-target="#main_slider" data-slide-to="1"></li>
               <li data-target="#main_slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container">
                     <div class="row marginii">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="carousel-caption ">
                              <h1>Welcome to <strong class="color">Our Shop</strong></h1>
                              <p>Discover a world of eco-friendly solutions for your household and garden needs.</p>
                              <a class="btn btn-lg btn-primary" href="php/about.php" role="button">About</a>
                           </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="img-box">
                              <figure><img src="images/assets/index-item-1.png" alt="img"/></figure>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container">
                     <div class="row marginii">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="carousel-caption ">
                              <h1>Welcome to <strong class="color">Our Shop</strong></h1>
                              <p>Embrace a greener, more conscious way of living.</p>
                              <a class="btn btn-lg btn-primary" href="php/about.php" role="button">About</a>
                           </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="img-box ">
                              <figure><img src="images/assets/index-item-2.png" alt="img"/></figure>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container">
                     <div class="row marginii">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="carousel-caption ">
                              <h1>Welcome to <strong class="color">Our Shop</strong></h1>
                              <p>Our curated selection ensures sustainability without compromising style. </p>
                              <a class="btn btn-lg btn-primary" href="php/about.php" role="button">About</a>
                           </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="img-box">
                              <figure><img src="images/assets/index-item-3.png" alt="img"/></figure>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- plant -->
      <div id="plant" class="section product">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="titlepage">
                    <h2><strong class="black"> Featured Products</strong></h2>
                    <span> Explore our thoughtfully curated collection of eco-friendly products designed to enhance your home and garden.
                      From sustainable <a href="php/household.php" class="featured-text">household essentials</a> to <a href="php/garden.php" class="featured-text">garden additions</a> that embrace nature </span>
            </div>
        </div>
    </div>
</div>

<div class="shop_main section">
    <div class="container">
        <div class="row">
            <?php
            // Loop through the fetched products and display them
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">';
                echo '<div class="store_product" data-toggle="modal" data-target="#modal' . $row["product_id"] . '">';
                echo '<figure><img src="' . $row["photo"] . '" alt="img"/></figure>';
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
                echo '<img src="' . $row["photo"] . '" alt="' . $row["name"] . '" class="img-fluid">';
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
                  echo '<a href="php/add_cart.php?id=' . $row["product_id"] . '" class="btn btn-primary">Add to Cart</a>';
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
      <!--Our  Clients -->
      <div id="plant" class="section_Clients layout_padding padding_bottom_0">
         <div class="container">
            <div class="row">
               <div class="col-md-12 ">
                  <div class="titlepage">
                     <h2> Testmonial</h2>
                     <span style="text-align: center;">Hear from our delighted customers making a positive impact.</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
            <div class="section Clients_2 layout_padding padding-top_0">
               <div class="container">
                  <div class="row">
                     <div class="col-sm-12">

                        <div id="testimonial" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#testimonial" data-slide-to="0" class="active"></li>
    <li data-target="#testimonial" data-slide-to="1"></li>
    <li data-target="#testimonial" data-slide-to="2"></li>
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="titlepage">
                           <div class="john">
                              <div class="john_image"><img src="images/assets/john-image.png" style="max-width: 100%;"></div>
                              <div class="john_text">JOHN DUE</span></div>
                              <p class="lorem_ipsum_text">I never thought sustainable living could be this stylish and easy! Thanks to LeafStock, my home is now filled with beautiful, eco-friendly treasures. From kitchen essentials to garden delights, every product tells a story of sustainability. It's not just about what I buy; it's about the positive impact I make. Thank you for curating such a wonderful collection and inspiring a greener way of life! </p>
                              <div class="icon_image"><img src="images/assets/quote-icon.png"></div>
                           </div>
                        </div>
    </div>
    <div class="carousel-item">
      <div class="titlepage">
                           <div class="john">
                              <div class="john_image"><img src="images/assets/john-image.png" style="max-width: 100%;"></div>
                              <div class="john_text">JOHN DUE</span></div>
                              <p class="lorem_ipsum_text">I never thought sustainable living could be this stylish and easy! Thanks to LeafStock, my home is now filled with beautiful, eco-friendly treasures. From kitchen essentials to garden delights, every product tells a story of sustainability. It's not just about what I buy; it's about the positive impact I make. Thank you for curating such a wonderful collection and inspiring a greener way of life! </p>
                              <div class="icon_image"><img src="images/assets/quote-icon.png"></div>
                           </div>
                        </div>
    </div>
    <div class="carousel-item">
      <div class="titlepage">
                        <div class="john">
                              <div class="john_image"><img src="images/assets/john-image.png" style="max-width: 100%;"></div>
                              <div class="john_text">JOHN DUE</span></div>
                              <p class="lorem_ipsum_text">I never thought sustainable living could be this stylish and easy! Thanks to LeafStock, my home is now filled with beautiful, eco-friendly treasures. From kitchen essentials to garden delights, every product tells a story of sustainability. It's not just about what I buy; it's about the positive impact I make. Thank you for curating such a wonderful collection and inspiring a greener way of life! </p>
                              <div class="icon_image"><img src="images/assets/quote-icon.png"></div>
                           </div>
                        </div>
    </div>
    
  </div>
       <!-- Left and right controls -->
       <a class="carousel-control-prev" href="#testimonial" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#testimonial" data-slide="next">
      <span class="carousel-control-next-icon"></span>
      </a>
   </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
      <!-- end Our  Clients -->
      <!-- footer start-->

    <div id="footer" class="Contact layout_padding">
       <div class="container">
          <div class="row">
             <div class="col-sm-12">
               <div class="titlepage">
                  <div class="main">
                     <h1 class="contact_text">Contact</h1>
                  </div>
               </div>
             </div>
          </div>
               <div class="contact_2">
                  <div class="row">
                     <div class="col-sm-12 col-md-12 col-lg-4">
                       <div class="site_info">
                          <span class="info_icon"><img src="images/assets/map-icon.png" /></span>
                          <span style="margin-top: 10px;">Av. Universidad Anáhuac 46, Lomas Anahuac, 52786 Lomas Anáhuac, Méx.</span></div>
                     </div>
                     <div class="col-sm-12 col-md-12 col-lg-4">
                       <div class="site_info">
                          <span class="info_icon"><img src="images/assets/phone-icon.png" /></span>
                          <span style="margin-top: 21px;">(+52) 5512345678</span></div>
                     </div>
                     <div class="col-sm-12 col-md-12 col-lg-4">
                       <div class="site_info">
                          <span class="info_icon"><img src="images/assets/email-icon.png" /></span>
                          <span style="margin-top: 21px;">oscarpobletesaenz@gmail.com</span></div>
                     </div>
                     </div> 
                  </div>
               </div>
                  <div class="menu_main">
                     <div class="menu_text">
                        <ul>
                           <li class="active"><a href="#">Home</a></li>                         
                           <li><a href="php/about.php">About</a></li>
                           <li><a href="php/household.php">Household</a></li>
                           <li><a href="php/garden.php">Garden</a></li>
                        </ul>
                     </div>
                  </div>
       </div>
    </div>

      <div id="plant" class="footer layout_padding">
         <div class="container">
            <p>© 2023 LeafStock. All Rights Reserved.</a></p>
         </div>
      </div>

      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>