<?php
session_start();

// Check if there was a signup error
$signupErrorStatus = isset($_SESSION["signup_error_status"]);
$signupErrorMessage = isset($_SESSION["signup_error_message"]) ? $_SESSION["signup_error_message"] : '';

// Check if the user is already logged in
if (isset($_SESSION["user_id"])) {
    header("Location: account.php"); // Redirect to the user info page
    exit();
}

// Clear the error indicators
unset($_SESSION["signup_error_status"]);
unset($_SESSION["signup_error_message"]);
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
      <title>Sign Up</title>
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
   <body class="main-layout form_body signup_page">
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
                                 <li class="last"><a href="login.php"><img src="../images/assets/account_icon.png" alt="icon"/></a></li>
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

      <!-- Sign Up Form -->
      <main class="form_main">
         <div class="signup-form">
            <div class="titlepage">
               <br><br><br>
            <h2><strong class="black"> Create</strong> Account</h2>
            </div>
            <?php if ($signupErrorStatus): ?>
               <div class="error-message"><?= $signupErrorMessage ?></div>
            <?php endif; ?>
            <form action="signup_process.php" method="post"  class="signup-form-container">
            <div class="form-group">
                <label for="full_name" class="form-label">Full Name:</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="birthdate" class="form-label">Birth Date:</label>
               <input type="date" class="form-control" id="birthdate" name="birthdate" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <span class="input-group-text show-hide-password" onclick="togglePasswordVisibility('password')">
                        <i id="password-toggle-icon" class="fa fa-eye"></i>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="confirm_password" class="form-label">Confirm Password:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    <span class="input-group-text show-hide-password" onclick="togglePasswordVisibility('confirm_password')">
                        <i id="confirm-password-toggle-icon" class="fa fa-eye"></i>
                    </span>
                </div>
            </div>
               <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>
            <div class="login-link">
               <p>Already have an account?<a href="login.php" class="featured-text"> Log In!</a></p>
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
      <script src="../js/age-validation.js"></script>
      <script src="../js/password-toggle.js"></script>
      <script src="../js/jquery.min.js"></script>
      <script src="../js/popper.min.js"></script>
      <script src="../js/bootstrap.bundle.min.js"></script>
      <script src="../js/jquery-3.0.0.min.js"></script>
      <script src="../js/plugin.js"></script>
      <!-- sidebar -->
      <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="../js/custom.js"></script>
      <!-- javascript --> 
      <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
   </body>
</html>
