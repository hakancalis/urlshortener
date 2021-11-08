<?php 
require_once 'functions.php';
require_once 'DatabaseClass/database.class.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?=$link?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?=$site_name?></title>

    <link rel="stylesheet" href="<?=$link?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=$link?>assets/css/all.min.css">
    <link rel="stylesheet" href="<?=$link?>assets/css/animate.css">
    <link rel="stylesheet" href="<?=$link?>assets/css/nice-select.css">
    <link rel="stylesheet" href="<?=$link?>assets/css/owl.min.css">
    <link rel="stylesheet" href="<?=$link?>assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?=$link?>assets/css/flaticon.css">
    <link rel="stylesheet" href="<?=$link?>assets/css/main.css">
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


    <!--============= Header Section Starts Here =============-->
    <header class="header-section">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="<?=$link?>">
                        <h3 style="color: #fff"><?=$site_name?></h3>
                    </a>
                </div>
                <ul class="menu">
                    <li>
                        <a href="<?=$link?>"><?=$array['home']?></a>
                    </li>
                       <li>
                        <a href="javascript:void(0)"><?=$array['language']?></a>
                        <ul class="submenu">
                            <li>
                    <a href="javascript:void(0)" onclick="LanguageEN()"><?=$array['EN']?></a>
                    <a href="javascript:void(0)" onclick="LanguageTR()"><?=$array['TR']?></a>
                            </li>
                        </ul>
                    </li>
                    <li class="d-sm-none text-center">
                        <a href="<?=$array['sign-in-button-link']?>" class="header-button active"><?=$array['login']?></a>
                    </li>
                    <li class="d-sm-none text-center">
                        <a href="<?=$array['sign-up-button-link']?>" class="mb-4 header-button"><?=$array['register']?></a>
                    </li>
                </ul>
                <div class="header-bar d-lg-none mr-sm-3">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="header-right">
                <?php 
                if(@!$_SESSION['login']) {
                ?>
                    <a href="<?=$array['sign-in-button-link']?>" class="header-button d-none d-sm-inline-block m-0 active"><?=$array['login']?></a>
                    <a href="<?=$array['sign-up-button-link']?>" class="header-button d-none d-sm-inline-block m-0"><?=$array['register']?></a>
                    <?php }else {  ?>
                    <ul class="menu">
                       <li>
                        <a href="javascript:void(0)"><?=$array['my-account']?></a>
                        <ul class="submenu">
                            <li>
                            <?php $Query = $db->getRow("SELECT * FROM members WHERE id=?",array($_SESSION['id'])) ?>
                    <a href="<?=$array['account-link']."/".encrypt($Query->id, $key)?>"><?=$array['account']?></a>
                    <a href="<?=$array['logout-link']?>"><?=$array['logout']?></a>
                        </ul>
                    </li>
                    </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>
    <!--============= Header Section Ends Here =============-->
