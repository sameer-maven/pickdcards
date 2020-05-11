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
      $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
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
});