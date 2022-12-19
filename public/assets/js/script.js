function fileValidation(id) {
    let fileInput = document.getElementById(id);
    let filePath = fileInput.value;
    // Allowing file type
    let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

    if (!allowedExtensions.exec(filePath)) {
        alert('Invalid file type');
        fileInput.value = '';
        return false;
    }
    else
    {
        // Image preview
        if (fileInput.files && fileInput.files[0]) {
            let reader = new FileReader();
            let imagePreview = id+"ImagePreview";
            // reader.onload = function(e) {
            //     document.getElementById(imagePreview).style.display='block';
            //     document.getElementById(imagePreview).innerHTML = '<img height="50" width="50" src="' + e.target.result +'" />';
            // };

            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}

$(document).ready(function() {
    $(".radio_user_type").click(function () {
        if($(this).val() == "Vendor"){
            $("#aadhar").parent().show();
            $("#aadhar").attr("required", true);
            $("#pancard").parent().show();
            $("#pancard").attr("required", true);
            $("#gst").parent().show();
            $("#gst").attr("required", true);
            $("#caccountnumber").parent().show();
            $("#caccountnumber").attr("required", true);
            $("#cancelcheque").parent().show();
            $("#photo").parent().show();
            $("#sign").parent().show();
        }else{
            $("#aadhar").parent().hide();
            $("#aadhar").attr("required", false);
            $("#pancard").parent().hide();
            $("#pancard").attr("required", false);
            $("#gst").parent().hide();
            $("#gst").attr("required", false);
            $("#caccountnumber").parent().hide();
            $("#caccountnumber").attr("required", false);
            $("#cancelcheque").parent().hide();
            $("#photo").parent().hide();
            $("#sign").parent().hide();


        }
    });

    $("#cancelcheque").focusout(function() {
        $("#udcancelchequeerror").remove();
        var formData = new FormData();
        formData.append('file', $('#cancelcheque')[0].files[0]);
        $.ajax({
            url: '/signup/check_fileupload',   // sending ajax request to this url
            type: 'post',
            data: formData,
            success:function(response) {
                $("#udcancelchequeerror").after("<span id='udcancelchequeerror' class='text-danger'>"+response+"</span>");

                // reset form fields after submit
                //$("#regForm")[0].reset();
            },
            error:function(e) {
                $("#result").html("Some error encountered.");
            }

        });
    });
    $("#uemail").focusout(function() {
        $("#uemailerror").remove();
        $.ajax({
            url: '/signup/check_email',   // sending ajax request to this url
            type: 'post',
            data: {
                'uemail': $(this).val(),
                'usertype': $('input[name="chktype"]:checked').val(),
            },
            success:function(response) {
                $("#uemail").after("<span id='uemailerror' class='text-danger'>"+response+"</span>");

                // reset form fields after submit
                //$("#regForm")[0].reset();
            },
            error:function(e) {
                $("#result").html("Some error encountered.");
            }

        });
    });
    /*$("#uemail").focusout(function() {
        $("#uemailerror").remove();
        $.ajax({
            url: '/signup/check_email',   // sending ajax request to this url
            type: 'post',
            data: {
                'uemail': $(this).val(),
            },
            success:function(response) {
                $("#uemail").after("<span id='uemailerror' class='text-danger'>"+response+"</span>");

                // reset form fields after submit
                //$("#regForm")[0].reset();
            },
            error:function(e) {
                $("#result").html("Some error encountered.");
            }

        });
    });*/
    $("#uphone").focusout(function() {
        $("#uphoneerror").remove();
        $.ajax({
            url: '/signup/check_phone',   // sending ajax request to this url
            type: 'post',
            data: {
                'uphone': $(this).val(),
                'usertype': $('input[name="chktype"]:checked').val(),
            },
            success:function(response) {
                $("#uphone").after("<span id='uphoneerror' class='text-danger'>"+response+"</span>");

                // reset form fields after submit
                //$("#regForm")[0].reset();
            },
            error:function(e) {
                $("#result").html("Some error encountered.");
            }

        });
    });
    $("#upass").focusout(function() {
        $("#upasserror").remove();
        $.ajax({
            url: '/signup/check_pass',   // sending ajax request to this url
            type: 'post',
            data: {
                'upass': $(this).val(),
            },
            success:function(response) {
                $("#upass").after("<span id='upasserror' class='text-danger'>"+response+"</span>");

                // reset form fields after submit
                //$("#regForm")[0].reset();
            },
            error:function(e) {
                $("#result").html("Some error encountered.");
            }

        });
    });
    $("#upass2").focusout(function() {
        $("#ucpasserror").remove();
        if($(this).val() !== $("#upass").val())
        {
            $("#upass2").after("<span id='ucpasserror' class='text-danger'>Password do not match</span>");

                // reset form fields after submit
                //$("#regForm")[0].reset();
        }
    });

    $(".radio_user_type").trigger('click');

    // function validateForm() {
    //     $("#error").remove();
    //
    //     if($("#uname").val() == "") {
    //         $("#uname").after("<span id='error' class='text-danger'> Enter your name </span>");
    //         return false;
    //     }
    //
    //     if($("#uemail").val() === "") {
    //         $("#uemail").after("<span id='error' class='text-danger'> Enter your email </span>");
    //         return false;
    //     }
    //     if($("#upass").val() === "") {
    //         $("#upass").after("<span id='error' class='text-danger'> Enter your password </span>");
    //         return false;
    //     }
    //     if($("#upass2").val() === "") {
    //         $("#upass2").after("<span id='error' class='text-danger'> Re-enter your password </span>");
    //         return false;
    //     }
    //     if($("#upass").val() !== $("#upass2").val()) {
    //         $("#upass2").after("<span id='error' class='text-danger'> Password not confirmed </span>");
    //         return false;
    //     }
    //
    //     return true;
    // }
    //
    //
    // $("#registerButton").click(function() {
    //     if(validateForm() === false) {
    //         return;
    //     }
    //
    //     // sending ajax request
    //     $.ajax({
    //         url: './process.php',   // sending ajax request to this url
    //         type: 'post',
    //         data: {
    //             'uname'     : $("#uname").val(),
    //             'uemail'    : $("#uemail").val(),
    //             'upass'     : $("#upass").val(),
    //             'upass2'    : $("#upass2").val(),
    //             'uphone'    : $("#uphone").val(),
    //             'chktype'   : $("#chktype").val(),
    //             'aadhar'    : $("#aadhar").val(),
    //             'pancard'    : $("#pancard").val(),
    //             'aadhar'    : $("#aadhar").val(),
    //             'aadhar'    : $("#aadhar").val(),
    //             'aadhar'    : $("#aadhar").val(),
    //             'aadhar'    : $("#aadhar").val(),
    //             'save' : 1
    //         },
    //         beforeSend: function() {
    //             $("#result").html("<p class='text-success'> Please wait.. </p>");
    //         },
    //         success:function(response) {
    //             $("#result").html(response);
    //
    //             // reset form fields after submit
    //             $("#regForm")[0].reset();
    //         },
    //         error:function(e) {
    //             $("#result").html("Some error encountered.");
    //         }
    //
    //     });
    // });
});

// function checkEmail(emailInput){
//     $.ajax({
//         method:"POST",
//         url: "php-script.php",
//         data:   {
//             emailId:emailInput
//         },
//         success: function(data){
//             $('#emailStatus').html(data);
//         }
//     });
// }