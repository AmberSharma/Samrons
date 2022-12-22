$(document).ready(function() {
    jQuery.validator.addMethod(
        "letterswithspace",
        function(value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Only Alphabetical characters");

    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Please check your input."
    );

    $("#addCategoryForm").validate({
        rules: {
            categoryimage: {
                required: true,
                extension: "jpg|jpeg|png"
            }
        },
        errorElement: "div",
        errorPlacement: function ( error, element ) {
            error.addClass( "invalid-feedback" );
            error.insertAfter( element );
        },
        highlight: function(element) {
            $(element).removeClass('is-valid').addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        }
    });

    // $("#registerForm").validate({
    //     rules: {
    //         uname: {
    //             letterswithspace: true,
    //             required: true,
    //             maxlength: 50
    //         },
    //         uphone: {
    //             required:true,
    //             minlength:9,
    //             maxlength:10,
    //             number: true
    //         },
    //         uemail: {
    //             required: true,
    //             email: true,
    //         },
    //         upass: {
    //             required: true,
    //             minlength: 8,
    //             maxlength: 15,
    //         },
    //         upass2: {
    //             required: true,
    //             equalTo: "#upass"
    //         },
    //         aadhar: {
    //             required: true,
    //             regex: "^[2-9]{1}[0-9]{3}\\s[0-9]{4}\\s[0-9]{4}$"
    //         },
    //         pancard: {
    //             required: true,
    //             regex: "^[A-Z]{5}\\d{4}[A-Z]{1}$"
    //         },
    //         gst: {
    //             required: true,
    //             regex: "^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$"
    //         },
    //         caccountnumber: {
    //             required: true
    //         },
    //         cancelcheque: {
    //             required: true,
    //             extension: "jpg|jpeg|png"
    //         },
    //         photo: {
    //             required: true,
    //             extension: "jpg|jpeg|png"
    //         },
    //         sign: {
    //             required: true,
    //             extension: "jpg|jpeg|png"
    //         }
    //     },
    //     messages:{
    //         uname: {
    //             lettersonly: "Please enter characters only",
    //             maxlength: "Name should not exceed 50 characters"
    //         },
    //         aadhar: {
    //             regex: "Valid format: 2234 5678 1234"
    //         },
    //         pancard: {
    //             regex: "Valid format: ABCDE1234F"
    //         },
    //         gst: {
    //             regex: "Valid format: 05ABDCE1234F1Z2"
    //         }
    //     },
    //     errorElement: "div",
    //     errorPlacement: function ( error, element ) {
    //         error.addClass( "invalid-feedback" );
    //         error.insertAfter( element );
    //     },
    //     highlight: function(element) {
    //         $(element).removeClass('is-valid').addClass('is-invalid');
    //     },
    //     unhighlight: function(element) {
    //         $(element).removeClass('is-invalid').addClass('is-valid');
    //     }
    // });
});