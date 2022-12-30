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
    $("input[name='chktype']").change(function () {
        if($(this).val() == "Vendor"){
            $("#aadhar").attr("required", true).parent().show();
            $("#pancard").attr("required", true).parent().show();
            $("#gst").attr("required", true).parent().show();
            $("#caccountnumber").attr("required", true).parent().show();
            $("#cancelcheque").parent().show();
            $("#photo").parent().show();
            $("#sign").parent().show();
        } else {
            $("#aadhar").attr("required", false).parent().hide();
            $("#pancard").attr("required", false).parent().hide();
            $("#gst").attr("required", false).parent().hide();
            $("#caccountnumber").attr("required", false).parent().hide();
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
                if (response !== "1") {
                    $("#uemail").after("<span id='uemailerror' class='text-danger'>" + response + "</span>");
                }
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
        if ($(this).val().length === 10) {
            $.ajax({
                url: '/signup/check_phone',   // sending ajax request to this url
                type: 'post',
                data: {
                    'uphone': $(this).val(),
                    'usertype': $('input[name="chktype"]:checked').val(),
                },
                success: function (response) {
                    $("#uphone").after("<span id='uphoneerror' class='text-danger'>" + response + "</span>");
                },
                error: function (e) {
                    $("#result").html("Some error encountered.");
                }

            });
        }
    });
    $("#upass").focusout(function() {
        $("#upasserror").remove();
        if ($(this).val().length >= 8) {
            $.ajax({
                url: '/signup/check_pass',   // sending ajax request to this url
                type: 'post',
                data: {
                    'upass': $(this).val(),
                },
                success: function (response) {
                    $("#upass").after("<span id='upasserror' class='text-danger'>" + response + "</span>");
                },
                error: function (e) {
                    $("#result").html("Some error encountered.");
                }
            });
        }
    });

    $(".alert").delay(4000).slideUp(1000, function() {
        $(this).hide();
    });
});