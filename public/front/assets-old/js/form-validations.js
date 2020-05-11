
$(document).ready(function() {

    //Add business profile: (url:public/user)     
    $(".bus-profile-btn").click(function(e){
        $('#profileFrm').validate({ // initialize the plugin
            rules: {
                business_name: {
                    required: true
                },
                address: {
                    required: true
                },
                phone_number: {
                    required: true,
                    minlength : 8
                },
                email: {
                    required: true,
                    email: true
                },
                business_industry: {
                    required: true,
                },
                business_type: {
                    required: true
                },
                tax_id_number: {
                    required: true
                }
            }
        });
    });  
});