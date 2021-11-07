<?php require_once 'header.php'; ?>
<!--============= Banner Section Starts Here =============-->
    <section class="banner-section">
        <div class="banner-bg bg_img" data-background="./assets/images/banner/banner-bg.jpg">
            <div class="banner-bg-shape"><img src="./assets/images/banner/banner-shape.png" alt="banner"></div>
        </div>
        <div class="container">
            
            <div class="banner-form-group">
            <form class="account-form" id="account-form">
            <?php 
            $id = decrypt($_GET['id'], $key);
            $AccountQuery = $db->getRow("SELECT * FROM members WHERE id=?",array($id))

            ?>
            <span class="feedback"></span>
                <div class="form-group">
                    <label for="name"><?=$array['name-title']?></label>
                    <input type="text" name="name_surname" id="name_surname" value="<?=$AccountQuery->name_surname?>">
                </div>
                <div class="form-group">
                    <label for="email"><?=$array['email-title']?></label>
                    <input type="text" name="email" id="email" value="<?=$AccountQuery->email?>">
                </div>
                <div class="form-group">
                    <label for="password"><?=$array['new-password-title']?></label>
                    <input type="password" name="password" id="password" placeholder="<?=$array['new-password']?>">
                </div>
                        <i style="font-size:23px" class="bi bi-eye-slash" id="togglePassword"></i>   <?=$array['password-toggle']?>
                        <input type="hidden" name="token" id="token" value="<?=encrypt($_SESSION['token'], $key)?>">
                <div class="form-group text-center">
                    <button id="btnSaveAccount" type="submit"><span id="btn-text"></span>  <?=$array['save-changes']?></button>
                </div>
            </form>
                </div>
            </div>
        </div>
    </section>
    <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function (e) {
    const passwordType = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', passwordType);
    this.classList.toggle('bi-eye');
});

    </script>

    <footer class="footer-section padding-top">
        <div class="footer-bg bg_img" data-background="./assets/images/footer/footer-bg.jpg"></div>
        <div class="footer-bg d-md-block d-none"><img src="./assets/images/footer/wave.png" alt="footer"></div>
        <div class="container">
            </div>
        </footer>

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
        <script src="./assets/js/contact.js"></script>
        <script src="./assets/js/main.js"></script>
    </body>

    </html>