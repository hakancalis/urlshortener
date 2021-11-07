<?php require_once 'header.php';  
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
            <div class="banner-content">
                <h3 class="cate"><?=$array['home-text-title']?></h3>
                <h1 class="title"><?=$array['home-text']?></h1>
                <p><?=$array['home-text-description']?></p>
            </div>
            <div class="banner-form-group">
                <h3 class="subtitle"><?=$array['short-link-title']?></h3>
                <div class="feedback"></div>
                <form class="banner-form">
                    <input type="text" placeholder="URL" name="url" id="url">
                    <input type="hidden" name="token" id="token" value="<?=encrypt($_SESSION['token'], $key)?>">
                    <button id="btnSubmit" type="submit"><?=$array['shorten']?> <i id="loader" class="flaticon-startup"></i></button>
                </form>
                <div class="banner-counter">
                    <div class="counter-item">
                        <h2 class="counter-title"><span class="counter">100</span>+</h2>
                        <p><?=$array['counter-1']?></p>
                    </div>
                    <div class="counter-item">
                        <h2 class="counter-title"><span class="counter">500</span>+</h2>
                        <p><?=$array['counter-2']?></p>
                    </div>
                    <div class="counter-item">
                        <h2 class="counter-title"><span class="counter">150</span>+</h2>
                        <p><?=$array['counter-3']?></p>
                    </div>
                </div><br><br>
                     <?php if(@$_SESSION['login']) { ?>
                     <table class="table col-12">
  <thead class="thead-dark">
    <tr>
      <th class="col-8">URL</th>
      <th class="col-8"><?=$array['click']?></th>
      <th class="col-8"><?=$array['short-link']?></th>
      <th><?=$array['delete']?></th>
    </tr>
  </thead>
  <tbody id="tableResult">
  <?php 
  $MemberLinks = $db->getRows("SELECT * FROM links WHERE member_id=?",array($_SESSION['id']));
  foreach($MemberLinks as $row) {
  ?>
    <tr id="<?=$row->id?>">
      <td  class="text-break"><?=$row->url?></td>
      <td><?=$row->visitors?></td>
      <td><a target="_blank" href='<?=$link . "redirect/" . $row->redirect_code?>'><?=$link . "redirect/" . $row->redirect_code?></a></td>
      <td>
      	<a href="javascript:void(0)" class="text-danger" onclick="Delete('<?=$row->id?>')">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        </svg>
        </a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
                    <?php } ?>
            </div>
        </div>
    </section>
    <!--============= Banner Section Ends Here =============-->


    <!--============= Why Section Starts Here =============-->
    <section class="why-section padding-bottom padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mt-lg-100">
                    <div class="section-header left-style mb-lg-0 sticky-header mb-low ml-0">
                        <h2 class="title">
                            <?=$array['about-title']?>
                        </h2>
                        <p><?=$array['about-text']?></p>
                        <a href="<?=$array['sign-up-button-link']?>" class="custom-button active mt-2"><?=$array['crate-account']?></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="choose-item">
                        <div class="choose-thumb">
                            <img src="./assets/images/why/01.png" alt="why">
                        </div>
                        <div class="choose-content">
                            <h5 class="title"><?=$array['join-network-title']?></h5>
                                <p><?=$array['join-network-text']?></p>
                        </div>
                    </div>
                    <div class="choose-item">
                        <div class="choose-thumb">
                            <img src="./assets/images/why/02.png" alt="why">
                        </div>
                        <div class="choose-content">
                            <h5 class="title"><?=$array['highest-rates-title']?></h5>
                            <p><?=$array['highest-rates-text']?></p>
                        </div>
                    </div>
                    <div class="choose-item">
                        <div class="choose-thumb">
                            <img src="./assets/images/why/03.png" alt="why">
                        </div>
                        <div class="choose-content">
                            <h5 class="title"><?=$array['payments-on-time-title']?></h5>
                            <p><?=$array['payments-on-time-text']?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--============= How Section Starts Here =============-->
    <section class="how-section padding-top padding-bottom pt-md-half pb-max-lg-0">
        <div class="container">
            <div class="section-header mb-low">
                <h2 class="title mb-0"><?=$array['how-to-start']?></h2>
            </div>
            <div class="row justify-content-center mb--40">
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="how-item">
                        <div class="how-thumb">
                            <img src="./assets/images/how/how1.png" alt="how">
                        </div>
                        <div class="how-content">
                            <h6 class="title"><?=$array['step-1']?></h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="how-item">
                        <div class="how-thumb">
                            <img src="./assets/images/how/how2.png" alt="how">
                        </div>
                        <div class="how-content">
                            <h6 class="title"><?=$array['step-2']?></h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="how-item">
                        <div class="how-thumb">
                            <img src="./assets/images/how/how3.png" alt="how">
                        </div>
                        <div class="how-content">
                            <h6 class="title"><?=$array['step-3']?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============= How Section Ends Here =============-->


    <!--============= Call In Action Section Starts Here =============-->
    <section class="call-in-action padding-top padding-bottom section-bg text-center">
        <div class="container">
            <div class="section-header mb-low">
                <h5 class="cate"><?=$array['join-us-now']?></h5>
                <h2 class="title"><?=$array['join-us-now-title']?></h2>
                <p><?=$array['join-us-now-text']?></p>
            </div>
            <a href="<?=$array['sign-up-button-link']?>" class="custom-button"><?=$array['join-us-now-button']?></a>
        </div>
    </section>
    <!--============= Call In Action Section Ends Here =============-->

    <!--============= Footer Section Starts Here =============-->
            
<?php require_once 'footer.php'; ?>