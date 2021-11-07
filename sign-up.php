<?php
require_once 'functions.php';
require_once 'DatabaseClass/database.class.php'; 
if(@$_SESSION['login'] == 1) {
    header("location: ".$link);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

      <title><?=$site_name . " | ".$array['sign-up']?></title>

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/animate.css">
    <link rel="stylesheet" href="./assets/css/nice-select.css">
    <link rel="stylesheet" href="./assets/css/owl.min.css">
    <link rel="stylesheet" href="./assets/css/magnific-popup.css">
    <link rel="stylesheet" href="./assets/css/flaticon.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    
  
</head>

<body>
    <!--============= ScrollToTop Section Starts Here =============-->
    <div class="overlayer" id="overlayer">
        <div class="loader">
            <div class="loader-inner"></div>
        </div>
    </div>
    <a href="#0" class="scrollToTop"><i class="fas fa-angle-up"></i></a>
    <div class="overlay"></div>
    <!--============= ScrollToTop Section Ends Here =============-->

    <!--============= Sign In Section Starts Here =============-->
    <div class="account-section bg_img" data-background="./assets/images/account-bg.jpg">
        <div class="container">
            <div class="account-title text-center">
                <a href="<?=$link?>" class="back-home"><i class="fas fa-angle-left"></i><span><?=$array['home']?></span></a>
                <a href="<?=$link?>" class="logo">
                <h3 style="color:#fff"><?=$site_name?></h3>
                </a>
            </div>
            <div class="account-wrapper">
                <div class="account-header">
                    <h4 class="title"><?=$array['lets-get-started']?></h4>
                </div>
                <div class="account-body">
                    <span class="feedback"></span>
                    <form class="account-form" id="signup-form" method="POST">
                        <div class="form-group">
                            <label for="sign-up"><?=$array['name-title']?> </label>
                            <input type="text" placeholder="<?=$array['name']?> " id="name_surname" name="name_surname">
                        </div>
                        <div class="form-group">
                            <label for="sign-up"><?=$array['email-title']?> </label>
                            <input type="text" placeholder="<?=$array['email']?> " id="email" name="email">
                        </div>
                         <div class="form-group">
                            <label for="sign-up"><?=$array['password-title']?> </label>
                            <input type="password" placeholder="<?=$array['password']?> " id="password" name="password">
                        </div>
                         <div class="form-group">
                            <label for="sign-up"><?=$array['confirm-password-title']?> </label>
                            <input type="password" placeholder="<?=$array['confirm-password']?> " id="confirm-password" name="confirm-password">
                        </div>
                        <i style="font-size:23px" class="bi bi-eye-slash" id="togglePassword"></i>   <?=$array['password-toggle']?>
                        <input type="hidden" name="token" id="token" value="<?=encrypt($_SESSION['token'], $key)?>"><br><br>
                        <div class="form-group text-center">
                            <button id="btnSignup" type="submit"><span id="btn-text"></span>  <?=$array['try-it-now']?></button>
                            <span class="d-block mt-15"><?=$array['already-have-an-account']?> <a href="<?=$array['sign-in-button-link']?>"><?=$array['login']?></a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const confirmpassword = document.querySelector('#confirm-password');
    togglePassword.addEventListener('click', function (e) {
    const passwordType = password.getAttribute('type') === 'password' ? 'text' : 'password';
    const confirmPasswordType = confirmpassword.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', passwordType);
    confirmpassword.setAttribute('type', confirmPasswordType);
    this.classList.toggle('bi-eye');
});

    </script>
    <script src="./assets/js/jquery-3.3.1.min.js"></script>
    <script src="./assets/js/modernizr-3.6.0.min.js"></script>
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/waypoints.js"></script>
    <script src="./assets/js/nice-select.js"></script>
    <script src="./assets/js/counterup.min.js"></script>
    <script src="./assets/js/owl.min.js"></script>
    <script src="./assets/js/magnific-popup.min.js"></script>
    <script src="./assets/js/paroller.js"></script>
    <script src="./assets/js/main.js"></script>


</body>

</html>