function autoHideAlert(delay = 4000, slide = 1000) {
    $(".alert").delay(delay).slideUp(slide, function () {
        $(this).hide();
    });
}