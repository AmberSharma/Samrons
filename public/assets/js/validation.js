$(document).ready(function() {
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
});