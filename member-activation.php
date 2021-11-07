<?php require_once 'header.php'; 
switch($_GET['Operation']) {
    case 'activation':
?>
<!--============= Banner Section Starts Here =============-->
    <section class="banner-section">
        <div class="banner-bg bg_img" data-background="./assets/images/banner/banner-bg.jpg">
            <div class="banner-bg-shape"><img src="./assets/images/banner/banner-shape.png" alt="banner"></div>
            <div class="round-1">
                <img src="./assets/images/banner/01.png" alt="banner">
            </div>
            <div class="round-2">
                <img src="./assets/images/banner/02.png" alt="banner">
            </div>
        </div>
        <div class="container">
        <?php 
        $user_token = $_GET['user_token'];
        $Query = $db->getColumn("SELECT COUNT(*) FROM members WHERE user_token=?",array($user_token));
        if($Query > 0) {
            $Update = $db->Update("UPDATE members SET user_token=?,status=?",array("",1));
        ?>
        <script>
         setTimeout(function(){   
        window.location.assign(SITE_URL);
        }, 1500);
        </script>
            <div class="banner-form-group">
                <h3 class="subtitle"><?=$array['success-activation']?></h3>
            <div class="check_mark">
            <div class="sa-icon sa-success animate">
                <span class="sa-line sa-tip animateSuccessTip"></span>
                <span class="sa-line sa-long animateSuccessLong"></span>
                <div class="sa-placeholder"></div>
                <div class="sa-fix"></div>
            </div>
            <?php }else { ?>
                 <div class="banner-form-group">
                <h3 class="subtitle"><?=$array['error-activation']?></h3>
    <div class="error-banmark">
        <div class="ban-icon">
            <span class="icon-line line-long-invert"></span>
            <span class="icon-line line-long"></span>
            <div class="icon-circle"></div>
            <div class="icon-fix"></div>
        </div>
    </div>
            <?php } ?>
            </div>
        </div>
    </section>
    <!--============= Banner Section Ends Here =============-->


    <!--============= Footer Section Starts Here =============-->
    <footer class="footer-section padding-top">
        <div class="footer-bg bg_img" data-background="./assets/images/footer/footer-bg.jpg"></div>
        <div class="footer-bg d-md-block d-none"><img src="./assets/images/footer/wave.png" alt="footer"></div>
        <div class="container">
            <div class="section-header cl-white-499">
                <h5 class="cate"><?=$array['contact-us']?></h5>
                <h2 class="title"><?=$array['get-in-touch']?></h2>
            </div>
            <form class="contact-form" id="contact_form_submit">
                <div class="form-group">
                    <label for="name"><?=$array['contact-name-title']?></label>
                    <input type="text" name="name" id="name" placeholder="<?=$array['contact-name']?>">
                </div>
                <div class="form-group">
                    <label for="email"><?=$array['contact-email-title']?>l</label>
                    <input type="text" name="email" id="email" placeholder="<?=$array['contact-email']?>">
                </div>
                <div class="form-group">
                    <label for="message"><?=$array['contact-message-title']?></label>
                    <textarea name="message" id="message" placeholder="<?=$array['contact-message']?>"></textarea>
                </div>
                <div class="form-group text-center">
                    <button type="submit"><?=$array['contact-button-text']?></button>
                </div>
            </form>
            
<?php 
break;
    }
require_once 'footer.php'; ?>