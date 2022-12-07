$(document).ready(function() {
    function renderSubCategory(element) {
        let self = element;
        let elementId = element.attr("id");
        let elementIdNum = elementId.split("__")[1];
        if (elementIdNum === undefined) {
            elementIdNum = 0;
        } else {
            elementIdNum = parseInt(elementIdNum);
        }
        let parentcatid=element.val();
        self.removeClass('error');
        self.parent().parent().nextAll('.subcategory').remove();
        if (!isNaN(parseInt(parentcatid))) {
            $.ajax({
                url: '/vendor/getsubcategories',   // sending ajax request to this url
                type: 'post',
                data: {

                    'parentid': parentcatid,
                    'source': 'script'
                },
                success: function (response) {
                    if (response.length > 0) {
                        let attributeId = 'cat__' + (elementIdNum + 1);
                        response = JSON.parse(response);
                        let html = '<div class="form-group row subcategory">';
                        html += '<div class="col-sm-6">';
                        html += '<label>Sub Category</label>';
                        html += '<select id="' + attributeId + '" class="form-control category-subset">';
                        html += '<option> ---Select Sub Category---</option>';

                        if (response !== undefined) {
                            response.forEach(function (item, index) {
                                html += '<option value=' + item['id'] + '>' + item['name'] + '</option>';
                            });

                            self.parent().parent().after(html);
                            $("#" + attributeId).on('change', function () {
                                renderSubCategory($(this));
                            });
                        }
                    }
                },
                error: function (e) {
                    $("#result").html("Some error encountered.");
                }

            });
        }
    }

    $("#addCategoryButton").click(function () {

        if($('#cname').val().length == 0) {
            $('#cname').addClass('error');
        }

        else if($('#desc').val().length == 0) {
            $('#desc').addClass('error');
        } else {

            let categoryDropdownLength = $("[id^=cat__]").length;
            let categoryId = $('#cat__' + (categoryDropdownLength - 1)).val();
            if ((categoryDropdownLength - 1) == 0) {
                categoryId = 0;
            } else if (isNaN(parseInt(categoryId))) {
                $('#cat__' + (categoryDropdownLength - 1)).addClass('error');
            }

            $.ajax({
                url: '/vendor/addCategories',   // sending ajax request to this url
                type: 'post',
                data: {
                    'cname': $('#cname').val(),
                    'desc': $('#desc').val(),
                    'parentcat': categoryId,
                },
                success: function (response) {

                    // reset form fields after submit
                    //$("#regForm")[0].reset();
                },
                error: function (e) {
                    $("#result").html("Some error encountered.");
                }

            });

        }
    });
$('#cat__0').on('change',function () {
    renderSubCategory($(this));
});



});