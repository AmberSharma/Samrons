$(document).ready(function() {

    $('*[id^=cat__]').change(function(){
        renderSubCategory($(this));
    });

    $("#addCategoryButton").click(function () {
        if($("#addCategoryForm").valid()) {
            let data = new FormData();
            let formData = $("#addCategoryForm").serializeArray();
            data.append('source',  'script');

            $.each(formData, function (key, input) {
                if(input.name == "category") {
                    if (input.value != 0) {
                        data.append(input.name, input.value);
                    }
                } else {
                    data.append(input.name, input.value);
                }
            });
            let formField = $('input[name="categoryimage"]');
            formField.each(function(key, item) {
                let fileData = item.files;
                for (var i = 0; i < fileData.length; i++) {
                    data.append("categoryimage", fileData[i]);
                }
            })

            $.ajax({
                url: '/admin/addCategories',   // sending ajax request to this url
                type: 'post',
                dataType: "JSON",
                processData: false,
                contentType: false,
                data: data,
                success: function (data) {
                    let response = JSON.parse(JSON.stringify(data));
                    $(".invalid-feedback").remove();
                    if(response.success == false) {
                        $.each(response.error, function(index,jsonObject){
                            $.each(jsonObject, function(key,val){
                                let html = '<div id="'+index+'-error" class="error invalid-feedback">';
                                html += val;
                                html += '</div>';
                                $("#"+index).addClass("is-invalid").after(html);
                            });
                        });
                    }

                    if (response.success == true) {
                        $('.alert').show()
                        autoHideAlert();
                        $("#addCategoryForm")[0].reset();
                    }
                },
                error: function (e) {
                    $("#result").html("Some error encountered.");
                }
            });
        }
    });

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
        self.parent().parent().parent().nextAll('.subcategory').remove();
        if (!isNaN(parseInt(parentcatid))) {
            $.ajax({
                url: '/admin/getsubcategories',   // sending ajax request to this url
                type: 'post',
                data: {

                    'parentid': parentcatid,
                    'source': 'script'
                },
                success: function (response) {
                    if (response.length > 0) {
                        let attributeId = 'cat__' + (elementIdNum + 1);
                        response = JSON.parse(response);
                        if (response !== undefined) {
                            let parentClass = self.parent().parent().attr("class");
                            let html = '';
                            html = '<div class="form-group row subcategory" >';
                            html += '<div class="'+parentClass+'">';
                            html += '<div class="form-floating">';
                            html += '<select id="' + attributeId + '" class="form-control category-subset" name="category">';
                            html += '<option value=""> ---Select Sub Category---</option>';
                            response.forEach(function (item, index) {
                                html += '<option value=' + item['id'] + '>' + item['name'] + '</option>';
                            });
                            html += '</select>';
                            html += '<label>Sub Category</label>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            self.parent().parent().parent().after(html);
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

    $("#approve").click(function () {

        $.ajax({
            url: '/admin/approve_vendor',   // sending ajax request to this url
            type: 'post',
            data: {
                'id': $(this).attr("data-id"),
            },
            success: function (response) {

                let table = $("#bootstrap-data-table").DataTable();
                table.clear().rows.add(response).draw();
                // reset form fields after submit
                //$("#regForm")[0].reset();
            },
            error: function (e) {
                $("#result").html("Some error encountered.");
            }

        });
    });

    $("#reject").click(function () {

        $.ajax({
            url: '/admin/reject_vendor',   // sending ajax request to this url
            type: 'post',
            data: {
                'id': $(this).attr("data-id"),
            },
            success: function (response) {

                let table = $("#bootstrap-data-table").DataTable();
                table.clear().rows.add(response).draw();
                // reset form fields after submit
                //$("#regForm")[0].reset();
            },
            error: function (e) {
                $("#result").html("Some error encountered.");
            }

        });
    });


});