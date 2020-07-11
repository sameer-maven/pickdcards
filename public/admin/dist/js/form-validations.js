$(document).ready(function(){
    //Add business profile: (url:admin/profile)     
    $(".adminProfileFrmbtn").click(function(e){
        $('#adminProfileFrm').validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true
                }
            }
        });
    });


    //Change password: (url:admin/change-password)     
    $(".adminChangePassFrmbtn").click(function(e){
        $('#adminChangePassFrm').validate({
            rules: {
                password: {
                    required: true,
                    minlength : 8
                },
                password_confirmation: {
                    required: true,
                    minlength : 8,
                    equalTo : "#password"
                }
            }
        });
    });

    $(".deleteUser").click(function(){
        var url = $(this).attr("data-url");
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
            window.location.replace(url);
          }
        });
    });

    //Add Pages: (url:/pages/create)     
    $(".adminPageFrmbtn").click(function(e){
        $('#adminPageFrm').validate({
            rules: {
                title: {
                    required: true
                },
                slug: {
                    required: true
                }
            }
        });
    });

    //Add Testimonials: (url:/testimonials/create)     
    $(".adminTestimonialbtn").click(function(e){
        $('#adminTestimonialFrm').validate({
            rules: {
                title: {
                    required: true
                },
                company_name: {
                    required: true
                }
            }
        });
    });

});