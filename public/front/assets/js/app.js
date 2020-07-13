// Collapse Navbar
var navbarCollapse = function() {
if ($("#mainNav").offset().top > 80) {
$("#mainNav").addClass("navbar-shrink");
} else {
$("#mainNav").removeClass("navbar-shrink");
}
};
// Collapse now if page is not at top
navbarCollapse();
// Collapse the navbar when page is scrolled
$(window).scroll(navbarCollapse);
//
// testimonial-slider
$('.testimonial-slider').slick({
dots: true,
arrows: false,
infinite: true,
speed: 300,
slidesToShow: 1,
adaptiveHeight: false,
fade: true,
cssEase: 'linear',
autoplay: true,
});
// password-toggle
$(".toggle-password").click(function() {
$(this).toggleClass("fa-eye fa-eye-slash");
var input = $($(this).attr("toggle"));
if (input.attr("type") == "password") {
input.attr("type", "text");
} else {
input.attr("type", "password");
}
});
//select-js
$(document).ready(function() {
    $('.cstm-select').select2();
});
// date-picker
$(function() {

  $('.date-select[name="datefilter"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('.date-select[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + '/' + picker.endDate.format('YYYY-MM-DD'));
  });

  $('.date-select[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});




$(document).ready(function() {
    
    $(".edit-profile-info").hide();
    $("#edit_profile").click(function() {
        $(".profile-info-detail").hide();
        $(this).hide();
        $(".edit-profile-info").show();
    });

    // Business Profile page validation

    $('.slide-4').slick({
         dots: false,
         infinite: false,
         speed: 300,
         slidesToShow: 4,
         slidesToScroll: 1,
         nextArrow: '<span class="slick-next"> <i class="fa fa-angle-right" aria-hidden="true"></i></span>',
         prevArrow: '<span class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
         responsive: [
            {
               breakpoint: 1200,
               settings: {
               slidesToShow: 3,
               infinite: true,
               dots: true
               }
            },
            {
               breakpoint: 992,
               settings: {
               slidesToShow: 2,
               }
            },
            {
               breakpoint: 768,
               settings: {
               slidesToShow: 1,
               }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
         ]
      });
});