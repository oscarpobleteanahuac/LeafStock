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
      <title>About Us</title>
      <meta name="keywords" content="About Us">
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
            <!--about -->
       <div class="about">
         <div class="container">
             <div class="row">
                <div class="col-12">
                    <div class="titlepage">
                     <h2><strong class="black"> About</strong>  Us</h2>
                     <span>At LeafStock, we're on a mission to redefine sustainable living. Our passion lies in offering a thoughtfully curated collection of eco-friendly household and garden products that seamlessly blend style with sustainability. From reducing waste to promoting mindful consumption, every item in our selection reflects our commitment to a greener, more harmonious world.
As a team of eco-enthusiasts, we believe that small, conscious choices can collectively make a significant impact. With LeafStock, you're not just purchasing products; you're joining a community dedicated to fostering a healthier planet. Discover a lifestyle where sustainability meets style, and let's embark on this journey together. </span>
                  </div>
                </div>
             </div>
         </div>
      </div>
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
                     <div class="row marginii-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="carousel-about_text ">
                              <h1 class="about_text">Happy Homes, Happy Hearts</h1>
                              <p  class="lorem_text">At LeafStock, we believe in fostering family joy through sustainable living. Our eco-friendly products bring warmth and harmony to homes, creating spaces where love grows, and nature thrives.</p>
                           </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="img-box">
                              <br>
                              <figure><img src="../images/assets/family-image.png" style="max-width: 90%; border: 15px solid #fff;"/></figure>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container">
                     <div class="row marginii-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="carousel-about_text ">
                              <h1 class="about_text">Stylish Indoors, Sustainable Choices</h1>
                              <p  class="lorem_text">LeafStock's commitment to elegance is intertwined with our dedication to sustainability. Each item in our curated collection reflects our values—style that resonates with a conscious, eco-centric lifestyle.</p>
                           </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="img-box">
                           <br>
                              <figure><img src="../images/assets/house-image.png" style="max-width: 90%; border: 15px solid #fff;"/></figure>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container">
                     <div class="row marginii-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="carousel-about_text ">
                              <h1 class="about_text">Nurturing Nature, Embracing Tranquility</h1>
                              <p  class="lorem_text">LeafStock envisions outdoor spaces as reflections of natural serenity. Our garden essentials breathe life into your surroundings, creating an oasis that echoes our commitment to a greener, more harmonious world.</p>
                           </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="img-box">
                           <br>
                              <figure><img src="../images/assets/garden-image.png" style="max-width: 90%; border: 15px solid #fff;"/></figure>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

         </div>
      </section>

      </div>
      <!--end about -->
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