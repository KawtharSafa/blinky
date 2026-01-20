//  js Document

// Created on : 13/08/2018.
// Description: Blinky - App Promo Landing Page.
// Version    : 1.0.
// Author     : @KawtharSafa.

"use strict";

// Prealoder
function prealoader() {
  if ($("#loader").length) {
    $("#loader").fadeOut(); // will first fade out the loading animation
    $("#loader-wrapper").delay(350).fadeOut("slow"); // will fade out the white DIV that covers the website.
    $("body").delay(350).css({ overflow: "visible" });
  }
}

// WOW animation
function wowAnimation() {
  if ($(".wow").length) {
    var wow = new WOW({
      offset: 0, // distance to the element when triggering the animation (default is 0)
      mobile: true, // trigger animations on mobile devices (default is true)
      live: true, // act on asynchronously loaded content (default is true)
      scrollContainer: null, // optional scroll container selector, otherwise use window,
      resetAnimation: true, // reset animation on end (default is true)
    });
    wow.init();
  }
}

// placeholder remove
function removePlaceholder() {
  if ($("input,textarea").length) {
    $("input,textarea").each(function () {
      $(this).data("holder", $(this).attr("placeholder"));
      $(this).on("focusin", function () {
        $(this).attr("placeholder", "");
      });
      $(this).on("focusout", function () {
        $(this).attr("placeholder", $(this).data("holder"));
      });
    });
  }
}

//Add OnepageNav / Sidebar
function onePageFixedNav() {
  if ($("body").length) {
    // Add scrollspy to
    $("body").scrollspy({ target: ".theme-main-header", offset: 70 });

    // Add smooth scrolling on all links inside the one-page-menu
    $(".one-page-menu li a").on("click", function (event) {
      // Make sure this.hash has a value before overriding default behavior
      if (this.hash !== "") {
        // Prevent default anchor click behavior
        event.preventDefault();

        // Store hash
        var hash = this.hash;

        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
        $("html, body").animate(
          {
            scrollTop: $(hash).offset().top,
          },
          1300,
          function () {
            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
          }
        );
      } // End if
    });
  }
}

// Scroll to top
function scrollToTop() {
  if ($(".scroll-top").length) {
    //Check to see if the window is top if not then display button
    $(window).on("scroll", function () {
      if ($(this).scrollTop() > 200) {
        $(".scroll-top").fadeIn();
      } else {
        $(".scroll-top").fadeOut();
      }
    });

    //Click event to scroll to top
    $(".scroll-top").on("click", function () {
      $("html, body").animate({ scrollTop: 0 }, 1500);
      return false;
    });
  }
}

// Related Post slider
function postSlider() {
  var wSlider = $(".related-post-slider");
  if (wSlider.length) {
    wSlider.owlCarousel({
      loop: true,
      nav: false,
      dots: false,
      autoplay: true,
      margin: 30,
      autoplayTimeout: 4000,
      smartSpeed: 800,
      lazyLoad: true,
      responsive: {
        0: {
          items: 1,
        },
        551: {
          items: 2,
        },
      },
    });
  }
}

// Testimonial Slider
function testimonialSlider() {
  var tSlider = $("#client-slider");
  if (tSlider.length) {
    tSlider.multislider({
      continuous: true,
      duration: 8000,
    });
  }
}

// Apps Screenshot Slider
function screenshotSlider() {
  var cSlider = $(".screenshot-slider-one");
  if (cSlider.length) {
    cSlider.owlCarousel({
      loop: true,
      nav: false,
      dots: false,
      autoplay: true,
      center: true,
      margin: 75,
      autoplayTimeout: 40000000,
      smartSpeed: 1200,
      lazyLoad: true,
      responsive: {
        0: {
          items: 1,
        },
        450: {
          items: 2,
        },
        992: {
          items: 3,
        },
      },
    });
  }
}

// Apps Screenshot Slider
function screenshotSliderTwo() {
  var cSlider = $(".screenshot-slider-two");
  if (cSlider.length) {
    cSlider.owlCarousel({
      loop: true,
      nav: false,
      dots: false,
      autoplay: true,
      center: true,
      margin: 50,
      autoplayTimeout: 4000,
      smartSpeed: 1200,
      lazyLoad: true,
      responsive: {
        0: {
          items: 1,
        },
        768: {
          items: 2,
        },
        1200: {
          items: 3,
        },
      },
    });
  }
}

//Contact Form Validation
function contactFormValidation() {
  var activeForm = $(".form-validation");
  if (activeForm.length) {
    activeForm.validate({
      // initialize the plugin
      rules: {
        name: {
          required: true,
        },
        sub: {
          required: true,
        },
        email: {
          required: true,
          email: true,
        },
        message: {
          required: true,
        },
      },
      submitHandler: function (form) {
        $(form).ajaxSubmit({
          success: function () {
            $(".form-validation :input").attr("disabled", "disabled");
            activeForm.fadeTo("slow", 1, function () {
              $(this).find(":input").attr("disabled", "disabled");
              $(this).find("label").css("cursor", "default");
              $("#alert-success").fadeIn();
            });
          },
          error: function () {
            activeForm.fadeTo("slow", 1, function () {
              $("#alert-error").fadeIn();
            });
          },
        });
      },
    });
  }
}

// Close suddess Alret
function closeSuccessAlert() {
  var closeButton = $(".closeAlert");
  if (closeButton.length) {
    closeButton.on("click", function () {
      $(".alert-wrapper").fadeOut();
    });
    closeButton.on("click", function () {
      $(".alert-wrapper").fadeOut();
    });
  }
}

// Sticky header
function stickyHeader() {
  if ($(".theme-main-header").length) {
    var sticky = $(".theme-main-header"),
      scroll = $(window).scrollTop();

    if (scroll >= 190) sticky.addClass("fixed");
    else sticky.removeClass("fixed");
  }
}

// Counter function
function CounterNumberChanger() {
  var timer = $(".timer");
  if (timer.length) {
    timer.appear(function () {
      timer.countTo();
    });
  }
}

// Parallax
function ParallaxMas() {
  var parlax = $(".paroller");
  if (parlax.length) {
    $("[data-paroller-factor]").paroller();
    parlax.paroller({
      factor: 0.4,
      type: "foreground",
    });
  }
}

// DOM ready function
jQuery(document).on("ready", function () {
  (function ($) {
    removePlaceholder();
    scrollToTop();
    onePageFixedNav();
    postSlider();
    testimonialSlider();
    screenshotSlider();
    screenshotSliderTwo();
    contactFormValidation();
    closeSuccessAlert();
    CounterNumberChanger();
    ParallaxMas();
  })(jQuery);
});

// Window load function
jQuery(window).on("load", function () {
  (function ($) {
    prealoader();
  })(jQuery);
});

// Window scroll function
jQuery(window).on("scroll", function () {
  (function ($) {
    stickyHeader();
  })(jQuery);
});
