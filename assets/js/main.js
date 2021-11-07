(function ($) {
  "user strict";
  // Preloader Js
  $(window).on('load', function () {
    $("[data-paroller-factor]").paroller();
    $('#overlayer').fadeOut(1000);
    var img = $('.bg_img');
    img.css('background-image', function () {
      var bg = ('url(' + $(this).data('background') + ')');
      return bg;
    });
  });
  $(document).ready(function () {
    // Nice Select
    $('.select-bar').niceSelect();
    // counter 
    $('.counter').countUp({
      'time': 1500,
      'delay': 10
    });
    // PoPuP 
    $('.popup').magnificPopup({
      disableOn: 700,
      type: 'iframe',
      mainClass: 'mfp-fade',
      removalDelay: 160,
      preloader: false,
      fixedContentPos: false,
      disableOn: 300
    });
    $("body").each(function () {
      $(this).find(".img-pop").magnificPopup({
        type: "image",
        gallery: {
          enabled: true
        }
      });
    })
    //Faq
    $('.faq-wrapper .faq-title').on('click', function (e) {
      var element = $(this).parent('.faq-item');
      if (element.hasClass('open')) {
        element.removeClass('open');
        element.find('.faq-content').removeClass('open');
        element.find('.faq-content').slideUp(300, "swing");
      } else {
        element.addClass('open');
        element.children('.faq-content').slideDown(300, "swing");
        element.siblings('.faq-item').children('.faq-content').slideUp(300, "swing");
        element.siblings('.faq-item').removeClass('open');
        element.siblings('.faq-item').find('.faq-title').removeClass('open');
        element.siblings('.faq-item').find('.faq-content').slideUp(300, "swing");
      }
    });
    //Menu Dropdown Icon Adding
    $("ul>li>.submenu").parent("li").addClass("menu-item-has-children");
    // drop down menu width overflow problem fix
    $('.submenu').parent('li').hover(function () {
      var menu = $(this).find("ul");
      var menupos = $(menu).offset();
      if (menupos.left + menu.width() > $(window).width()) {
        var newpos = -$(menu).width();
        menu.css({
          left: newpos
        });
      }
    });
    $('.menu li a').on('click', function (e) {
      var element = $(this).parent('li');
      if (element.hasClass('open')) {
        element.removeClass('open');
        element.find('li').removeClass('open');
        element.find('ul').slideUp(300, "swing");
      } else {
        element.addClass('open');
        element.children('ul').slideDown(300, "swing");
        element.siblings('li').children('ul').slideUp(300, "swing");
        element.siblings('li').removeClass('open');
        element.siblings('li').find('li').removeClass('open');
        element.siblings('li').find('ul').slideUp(300, "swing");
      }
    })
    // Scroll To Top 
    var scrollTop = $(".scrollToTop");
    $(window).on('scroll', function () {
      if ($(this).scrollTop() < 500) {
        scrollTop.removeClass("active");
      } else {
        scrollTop.addClass("active");
      }
    });
    //Click event to scroll to top
    $('.scrollToTop').on('click', function () {
      $('html, body').animate({
        scrollTop: 0
      }, 500);
      return false;
    });
    //Header Bar
    $('.header-bar').on('click', function () {
      $(this).toggleClass('active');
      $('.overlay').toggleClass('active');
      $('.menu').toggleClass('active');
    })
    $('.overlay').on('click', function () {
      $(this).removeClass('active');
      $('.header-bar').removeClass('active');
      $('.menu').removeClass('active');
    })
    // Header Sticky Herevar prevScrollpos = window.pageYOffset;
    var scrollPosition = window.scrollY;
    if (scrollPosition >= 1) {
      $(".header-section").addClass('active');
    }
    var header = $(".header-section");
    $(window).on('scroll', function () {
      if ($(this).scrollTop() < 1) {
        header.removeClass("active");
      } else {
        header.addClass("active");
      }
    });
    $('.tab ul.tab-menu li').on('click', function (g) {
      var tab = $(this).closest('.tab'),
        index = $(this).closest('li').index();
      tab.find('li').siblings('li').removeClass('active');
      $(this).closest('li').addClass('active');
      tab.find('.tab-area').find('div.tab-item').not('div.tab-item:eq(' + index + ')').hide(10);
      tab.find('.tab-area').find('div.tab-item:eq(' + index + ')').fadeIn(10);
      g.preventDefault();
    });
    //Widget Slider
    $('.testimonial-slider').owlCarousel({
      loop:true,
      nav:false,
      dots: false,
      items:1,
      autoplay:true,
      autoplayTimeout:2500,
      autoplayHoverPause:true,
      margin: 0,
      mouseDrag: false,
      touchDrag: true,
    });
    var owlBela = $('.testimonial-slider');
    owlBela.owlCarousel();
    // Go to the next item
    $('.testi-next').on('click', function() {
        owlBela.trigger('prev.owl.carousel');
    })
    // Go to the previous item
    $('.testi-prev').on('click', function() {
        owlBela.trigger('next.owl.carousel', [300]);
    })
    $('.sponsor-slider-4').owlCarousel({
      loop: true,
      margin: 30,
      responsiveClass: true,
      nav: false,
      dots: false,
      loop: true,
      autoplay: true,
      autoplayTimeout: 2000,
      autoplayHoverPause: true,
      responsive:{
          0:{
              items:2,
          },
          480:{
              items:3,
          },
          768:{
              items:5,
          },
          992:{
              items:6,
          },
          1200:{
              items:7,
          },
      }
    })
    //Widget Slider
    $('.widget-slider').owlCarousel({
      loop:true,
      nav:false,
      dots: false,
      items:1,
      autoplay:true,
      autoplayTimeout:2500,
      autoplayHoverPause:true,
      margin: 30,
    });
    var owlTutu = $('.widget-slider');
    owlTutu.owlCarousel();
    // Go to the next item
    $('.widget-next').on('click', function() {
        owlTutu.trigger('next.owl.carousel');
    })
    // Go to the previous item
    $('.widget-prev').on('click', function() {
        owlTutu.trigger('prev.owl.carousel', [300]);
    })
  });
})(jQuery);


function LanguageTR() {
  $.get('dil/tr');
  window.location.reload();
}

function LanguageEN() {
  $.get('dil/en');
  window.location.reload();
}

$(document).on("submit", "#signup-form", function (event) {
    $("#btnSignup").prop("disabled", true);
    $("#btn-text").addClass("fa fa-spinner fa-spin");
    event.preventDefault();
    $.ajax({
        url: "signUp",
        type: "POST",
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          $('html, body').animate({
            scrollTop: 0
          }, 400);
            $("#btnSignup").prop("disabled", false);
            $("#btn-text").removeClass("fa fa-spinner fa-spin");
            $(".feedback").html("<div class='alert alert-"+data['alert']+"'>"+data['result']+"</div>");
            if(data['feedback'] == "success") {
              $("form").trigger("reset");
              $("#name_surname").removeClass("border border-danger");
              $("#email").removeClass("border border-danger");
              $("#password").removeClass("border border-danger");
            }else if(data['feedback'] == "email_filter") {
              $("#email").val("");
            }else if(data['feedback'] == "not-match") {
              $("#password").val("");
              $("#confirm-password").val("");
            }else if (data['feedback'] == "name-surname-lenght") {
              $("#name_surname").addClass("border border-danger");
            }else if (data['feedback'] == "email-lenght") {
              $("#email").addClass("border border-danger");
            }else if (data['feedback'] == "password-lenght") {
              $("#password").addClass("border border-danger");
            }else if (data['feedback'] == "registered") {
              $("#email").addClass("border border-danger");
            }
        }
    });
});



$(document).on("submit", "#signin-form", function (event) {
  $("#btnSignIn").prop("disabled", true);
  $("#btn-text").addClass("fa fa-spinner fa-spin");
  event.preventDefault();
  $.ajax({
    url: "signIn",
    type: "POST",
    data: new FormData(this),
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      $('html, body').animate({
        scrollTop: 0
      }, 400);
      $("#btnSignIn").prop("disabled", false);
      $("#btn-text").removeClass("fa fa-spinner fa-spin");
      $(".feedback").html("<div class='alert alert-" + data['alert'] + "'>" + data['result'] + "</div>");
      if (data['feedback'] == "success") {
        $("form").trigger("reset");
        $("#email").removeClass("border border-danger");
        $("#password").removeClass("border border-danger");
          window.location.href = SITE_URL;
      } else if (data['feedback'] == "email_filter") {
        $("#email").val("");
        $("#email").addClass("border border-danger");
      }
    }
  });
});


$(document).on("submit", "#account-form", function (event) {
  $("#btnSaveAccount").prop("disabled", true);
  $("#btn-text").addClass("fa fa-spinner fa-spin");
  event.preventDefault();
  $.ajax({
    url: "saveAccount",
    type: "POST",
    data: new FormData(this),
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      $('html, body').animate({
        scrollTop: 0
      }, 400);
      $("#btnSaveAccount").prop("disabled", false);
      $("#btn-text").removeClass("fa fa-spinner fa-spin");
      $(".feedback").html("<div class='alert alert-" + data['alert'] + "'>" + data['result'] + "</div>");
      if (data['feedback'] == "success") {
        $("#email").removeClass("border border-danger");
        $("#password").removeClass("border border-danger");
        $("#name_surname").removeClass("border border-danger");
        setTimeout(function () {
          window.location.reload();
        }, 1000);
      } else if (data['feedback'] == "email_filter") {
        $("#email").addClass("border border-danger");
      }
      else if (data['feedback'] == "password-lenght") {
        $("#email").addClass("border border-danger");
      }
      else if (data['feedback'] == "email-lenght") {
        $("#email").addClass("border border-danger");
      }else if (data['feedback'] == "name-surname-lenght") {
        $("#name_surname").addClass("border border-danger");
      }
    }
  });
});


$(document).on("submit", ".banner-form", function (event) {
  $("#btnSubmit").prop("disabled", true);
  $(".flaticon-startup").addClass("fa fa-spinner fa-spin");
  $(".flaticon-startup").removeClass("flaticon-startup");
  event.preventDefault();
  $.ajax({
    url: SITE_URL + "/shortenUrl",
    type: "POST",
    data: new FormData(this),
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      $("#btnSubmit").prop("disabled", false);
      $("#loader").removeClass("fa fa-spinner fa-spin");
        $("#loader").addClass("flaticon-startup");
      $(".feedback").html("<div class='alert alert-" + data['alert'] + "'>" + data['result'] + "</div>");
      if (data['feedback'] == "success") {
        $("form").trigger("reset");
        $("#tableResult").load(SITE_URL + "/refreshTable");
      }else if(data['feedback'] == "filter_url") {
        $("#url").addClass("border border-danger");
      }
    }
  });
});


var time = 5;
function timer() {
  if (time != 0) {
    time -= 1
    document.getElementById('timer').innerHTML = time;
  }
  else {
  
  }
  setTimeout("timer()", 1000)
}


$('.btn-popup').click(function () {
  var number1 = 1;
  var number2 = 5;
  var random = Math.random();
  random = random * (number1 - number2);
  random = Math.floor(random) + number2;
  window.open(SITE_URL +"/advertisement-"+random);
  timer();
  $(".btn-popup").hide();
  var redirect_url = $("#redirect_url").val()
  var id = $("#id").val();
  $.ajax({
    url: "redirectUrl",
    type: "POST",
    data: { redirect_url: redirect_url, id:id},
    success: function (data) {
      setTimeout(function(){   
        window.location.assign(data);
        }, 5000);
    }
  });
});


function Delete(ID) {
  $.get('deleteURL' ,
    { "ID": ID }, function (data) {
      data = data.split(":::", 2);
      var message = data[0];
      var mistake = data[1];
      Swal.fire({
        icon: 'success',
        text: message,
        width: 600
        })
      if (mistake == "success") {
        $("#" + ID).remove();
      }
    });
}
