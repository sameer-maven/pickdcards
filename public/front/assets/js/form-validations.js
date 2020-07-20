$(document).ready(function() {

    //Add business profile: (url:/user)     
    $(".bus-profile-btn").click(function(e){
        $('#profileFrm').validate({ // initialize the plugin
            rules: {
                business_name: {
                    required: true
                },
                address: {
                    required: true
                },
                // city: {
                //     required: true
                // },
                // state: {
                //     required: true
                // },
                // pincode: {
                //     required: true,
                //     minlength : 5,
                //     maxlength:5,
                // },
                phone_number: {
                    required: true,
                    minlength : 8
                },
                // email: {
                //     required: true,
                //     email: true
                // },
                business_industry: {
                    required: true,
                },
                // business_type: {
                //     required: true
                // },
                // tax_id_number: {
                //     required: true
                // },
                about_business: {
                    required: false
                }
            },
            messages: {
                business_industry: {
                    required: "Please select below business industry"
                }
            }
        });
    }); 

    $.validator.addMethod("pwcheck", function (value) {
        return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/.test(value)
    });

    //Change profile password: (url:/user/change-password)     
    $(".user-change-password-btn").click(function(e){
        $('#userChangePassFrm').validate({ // initialize the plugin
            rules: {
                old_password: {
                    required: true
                },
                password: {
                    required: true,
                    minlength : 8,
                    pwcheck :true
                },
                con_password: {
                    required: true,
                    minlength : 8,
                    equalTo : "#password"
                }
            },
            messages: {
                old_password: {
                    required: "Please enter current password"
                },
                password: {
                    required: "Please enter a valid password.",
                    minlength :"Please enter a valid password.",
                    pwcheck :"Please enter a valid password."
                },
                con_password: {
                    required: "Please enter password confirmation",
                    equalTo: "Confirm password does not match with password"
                }
            }
        });
    }); 



//End      
});