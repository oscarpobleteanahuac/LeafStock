<?php
session_start();

// Check if there was a login error
$loginError = isset($_SESSION["login_error"]) && $_SESSION["login_error"] === true;

// Check if the user is already logged in
if (isset($_SESSION["user_id"])) {
    header("Location: account.php"); // Redirect to the user info page
    exit();
}

// Clear the error indicator
unset($_SESSION["login_error"]);
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
      <title>Login</title>
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
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout form_body login_page">
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
                                 <li class="last"><a href="#"><img src="../images/assets/account_icon.png" alt="icon"/></a></li>
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

      <!-- Login Form -->
      <main class="form_main">
         <div class="login-form">
            <div class="titlepage">
            <h2><strong class="black"> Login</h2>
            </div>
            <?php if ($loginError): ?>
               <div class="error-message">Invalid credentials. Please try again.</div>
            <?php endif; ?>
            <form action="login_process.php" method="post"  class="login-form-container">
               <div class="form-group">
                   <label for="email" class="form-label">Email:</label>
                   <input type="email" class="form-control" id="email" name="email" required>
               </div>
               <div class="form-group">
               <label for="password" class="form-label">Password:</label>
               <div class="input-group">
               <input type="password" class="form-control" id="password" name="password" required>
               <span class="input-group-text show-hide-password" onclick="togglePasswordVisibility('password')">
                  <i id="eye-icon" class="fa fa-eye"></i>
               </span>
                </div>
               </div>
               <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <div class="signup-link">
               <p>Don't have an account?<a href="signup.php" class="featured-text"> Sign Up!</a></p>
            </div>
         </div>
      </main>

      <!-- footer start-->
      <div class="copyright_text">
         <div id="plant" class="footer layout_padding">
            <div class="container">
               <p>© 2023 LeafStock. All Rights Reserved.</p>
            </div>
         </div>
      </div>

      <!-- Javascript files-->
      <script src="../js/password-toggle.js"></script>
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
