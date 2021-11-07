<?php
require_once 'functions.php';
require_once 'DatabaseClass/database.class.php'; 
$RedirectCodeCount = $db->getColumn("SELECT COUNT(*) FROM links WHERE redirect_code=?",array($_GET['redirect_code']));
$RedirectCodeQuery = $db->getRow("SELECT * FROM links WHERE redirect_code=?",array($_GET['redirect_code']));

if($RedirectCodeCount < 1) {
    header("Location:".$link);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Cortaly - URL Shortner HTML Template</title>

    <link rel="stylesheet" href="<?=$link?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=$link?>assets/css/all.min.css">
    <link rel="stylesheet" href="<?=$link?>assets/css/animate.css">
    <link rel="stylesheet" href="<?=$link?>assets/css/nice-select.css">
    <link rel="stylesheet" href="<?=$link?>assets/css/owl.min.css">
    <link rel="stylesheet" href="<?=$link?>assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?=$link?>assets/css/flaticon.css">
    <link rel="stylesheet" href="<?=$link?>assets/css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <link rel="shortcut icon" href="<?=$link?>assets/images/favicon.png" type="image/x-icon">
    
  
</head>

<body>

    <div class="overlayer" id="overlayer">
        <div class="loader">
            <div class="loader-inner"></div>
        </div>
    </div>
    <a href="#0" class="scrollToTop"><i class="fas fa-angle-up"></i></a>
    <div class="overlay"></div>

    <div class="account-section bg_img" data-background="<?=$link?>assets/images/account-bg.jpg">
        <div class="container">
            <div class="account-title text-center">
                <a href="index.php" class="back-home"><i class="fas fa-angle-left"></i><span>Back <span class="d-none d-sm-inline-block">To Cortaly</span></span></a>
                <a href="index.php" class="logo">
                    <img src="<?=$link?>assets/images/logo/logo.png" alt="logo">
                </a>
            </div>
            <div class="account-wrapper">
                <div class="account-body">
                <span class="feedback"></span>
                <div style="background-color: #D8F8B7; height:70px; padding-top:20px;border-radius:30px" class="warning"><?=$array['safe-link']?></div><br>
                <span id="timer"></span>
                <button class="btn-popup" style="background-color: #44c767;color: #fff;border-radius:50px; width: 200px;"><?=$array['go-link']?></button><br><br>
                <input id="redirect_url" type="hidden" value="<?=encrypt($RedirectCodeQuery->url, $key)?>">
                <input id="id" type="hidden" value="<?=encrypt($RedirectCodeQuery->id, $key)?>">
              <?=$array['note']?>
                </div>
            </div>
        </div>
    </div>
    <style>
    </style>
    <script src="<?=$link?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?=$link?>assets/js/modernizr-3.6.0.min.js"></script>
    <script src="<?=$link?>assets/js/plugins.js"></script>
    <script src="<?=$link?>assets/js/bootstrap.min.js"></script>
    <script src="<?=$link?>assets/js/wow.min.js"></script>
    <script src="<?=$link?>assets/js/waypoints.js"></script>
    <script src="<?=$link?>assets/js/nice-select.js"></script>
    <script src="<?=$link?>assets/js/counterup.min.js"></script>
    <script src="<?=$link?>assets/js/owl.min.js"></script>
    <script src="<?=$link?>assets/js/magnific-popup.min.js"></script>
    <script src="<?=$link?>assets/js/paroller.js"></script>
    <script src="<?=$link?>assets/js/main.js"></script>


</body>

</html>