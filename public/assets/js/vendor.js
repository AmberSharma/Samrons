$(document).ready(function() {
    var hasVariantCombinationSelected = 0;
    var tableClasses = ['table-primary', 'table-secondary', 'table-success', 'table-danger', 'table-warning', 'table-info', 'table-light', 'table-dark']
    function cartesianProduct(arr) {
        return arr.reduce((a, b) =>
            a.map(x => b.map(y => x.concat(y)))
                .reduce((a, b) => a.concat(b), []), [[]]);
    }

    function renderSubCategory(element) {
        console.log("Fdsgsdgsd");
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

    function renderUploadedImages(response) {
        let self = $("#savedImageDiv").html('');
        response = JSON.parse(JSON.stringify(response));

        html = '<table class="table table-bordered" style="text-align: center">';
        html += '<thead class="thead-dark">';
        html += '<tr>';
        html += '<th scope="col">Image</th>';
        html += '<th scope="col">URL</th>';
        html += '<th scope="col">Action</th>';
        html += '</tr>';
        html += '</thead>';
        html += '<tbody>';

        response.forEach(function (item) {
            html += '<tr>';
            html += '<td>';
            html += '<img alt="uploadedImage" class="img-thumbnail" src="'+item+'" width="150" height="150" style="margin: 3px;">';
            html += '</td>';
            html += '<td>';
            html += item;
            html += '</td>';
            html += '<td style="text-align: center;">';
            html += '<button class="btn btn-warning clipboard-icon"><i class="fa fa-copy"></i></button>';
            html += '<button class="btn btn-info remove-icon"><i class="fa fa-trash"></i></button>';
            html += '</td>';
            html += '</tr>';
        });

        html += '</tbody>';
        html += '</table>';

        self.append(html);
    }

    function optionValueCombination(element) {
        element.parent().next().html('');
        let valueCombination = [];
        $("*[id^=optionvalue__]").each(function(index) {
            if ($(this).val().length !== 0) {
                if (valueCombination[index] === undefined) {
                    valueCombination[index] = [];
                }
                let indexValues = JSON.parse($(this).val());
                indexValues.forEach(function (item, key) {
                    if (valueCombination[index][key] === undefined) {
                        valueCombination[index][key] = [];
                    }
                    valueCombination[index][key] = item.value;
                });
            }
        });

        if(valueCombination.length === 0) {
            $(".alert-danger").html("Atleast 1 variant should be selected").show();
            autoHideAlert();
            return;
        }
        valueCombination = cartesianProduct(valueCombination);

        let html = '';
        if (valueCombination !== undefined) {
            hasVariantCombinationSelected = 1;
            html += '<table id="bootstrap-data-table" class="table table-striped table-bordered table-danger">';
            html += '<thead>';
            html += '<tr>';
            html += '<th>Variant</th>';
            html += '<th>SKU Id</th>';
            html += '<th>Quantity</th>';
            html += '<th>Image</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            valueCombination.forEach(function (item, index) {
                html += '<tr class="'+ tableClasses[index] +'">';
                html += '<td>';
                html += item.join("/");
                html +='<input type="hidden" id="valueCombination" name="valueCombination" value='+item+'>'
                html += '</td>';
                html += '<td>';
                html += '<input type="text" name="skuId" class="form-control"/>';
                html += '</td>';
                html += '<td>';
                html += '<input type="text" name="quantity" class="form-control"/>';
                html += '</td>';
                html += '<td>';
                html += ' <input class="form-control" type="file" name="productimage" id="productimage" onchange="return fileValidation(this.id);">';
                html += '</td>';
            });

            html += '</tbody>';
            html += '</table>';
        }

        element.parent().next().append(html);
    }

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

    $('#plus').on('click',function () {
        let self = $(this);
        $.ajax({
            url: '/vendor/getOptions',   // sending ajax request to this url
            type: 'post',
            data: {
                'source': 'script'
            },
            success: function (response) {
                if (response.length > 0) {
                    response = JSON.parse(response);
                    let optionValueSelectorLength = $("[id^=pro__]").length;

                    html = '<div class="form-group row">';
                    html += '<div class="col-sm-4">';
                    html += '<select id="pro__'+ optionValueSelectorLength +'" class="form-control" name="options">';
                    html += '<option value=""> ---Select Option---</option>';
                    if (response !== undefined) {
                        response.forEach(function (item, index) {
                            html += '<option value=' + item['id'] + '>' + item['name'] + '</option>';
                        });
                    }

                    html += "</select>";
                    html += "</div>";
                    html += '<div class="col-sm-8 optionval">\n';
                    let optionValueSelector = '<input type="textarea" id="optionvalue__'+optionValueSelectorLength+'" placeholder="Enter Option Values" class="form-control" name="optionvalues"></div></div>';
                    html += optionValueSelector;

                    //let currentHtml = self.parent().next().html() + html;
                    self.parent().next().append(html);

                    $("input[name=optionvalues]").each(function(i, obj) {
                        new Tagify(obj)
                    });

                    if(response.length === optionValueSelectorLength + 1) {
                        self.remove();
                    }
                }
            },
            error: function (e) {
                $("#result").html("Some error encountered.");
            }
        });
    });

    $('*[id^=cat__]').change(function(){
        renderSubCategory($(this));
    });

    $("#refresh").click(function () {
        optionValueCombination($(this));
    });

    $("#addProductDetails").click(function () {
        // if (hasVariantCombinationSelected !== 1) {
        //     $(".alert-danger").html("Variant Details and Option Value should be selected").show();
        //     autoHideAlert();
        //     return;
        // }
        // if($("#addProductForm").valid()) {

            let data = new FormData();
            let formData = $('form').serializeArray();
            $.each(formData, function (key, input) {
                if (input.name === "category") {
                    if (input.value !== '0') {
                        data.append("productdetails[" + input.name + "]", input.value);
                    }
                } else if (input.name === "options"
                    || input.name === "optionvalues"
                    || input.name === "valueCombination"
                    || input.name === "skuId"
                    || input.name === "quantity"
                ) {
                    data.append("productdetails[" + input.name + "][" + key + "]", input.value);
                } else {
                    data.append("productdetails[" + input.name + "]", input.value);
                }
            });
            let formField = $('input[name="productimage"]');
            formField.each(function (key, item) {
                let fileData = item.files;
                for (var i = 0; i < fileData.length; i++) {
                    data.append("productimage[]", fileData[i]);
                }
            })

            $.ajax({
                url: '/vendor/addProductDetails',   // sending ajax request to this url
                type: 'post',
                dataType: "JSON",
                processData: false,
                contentType: false,
                data: data,
                success: function (response) {
                    response = JSON.parse(JSON.stringify(response));
                    if (response.success == true) {
                        $(".alert-success").html(response.message).show();
                        autoHideAlert();
                        $("#addProductForm")[0].reset();
                    } else {
                        let html = '';
                        for (let key in response.error) {
                            if (response.error.hasOwnProperty(key)) {
                                let value = response.error[key];
                                html += key + ": " + value+ "<br/>";
                            }
                            $(".alert-danger").html(html).show();
                            autoHideAlert();
                        }
                    }
                },
                error: function (e) {
                    $("#result").html("Some error encountered.");
                }
            });
        // }
    });

    $("input[name=tags]").each(function(i, obj) {
        new Tagify(obj)
    });

    $("#bulkUploadImages").change(function(){
        let appendToDiv = $("#uploadedImageDiv");
        $(".img-wrap").remove();
        if (this.files) {
            var filesAmount = this.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    let html = '<div class="img-wrap">';
                    html += '<span class="close">&times;</span>';
                    html += '<img alt="uploadedImage" class="img-thumbnail" src="'+event.target.result+'" width="190" height="190" style="margin: 3px;">';
                    html += "</div>";
                    appendToDiv.append($.parseHTML(html));
                }

                reader.readAsDataURL(this.files[i]);
            }
        }
    });
    $("#bulkUploadImagesUrlButton").click(function () {
        $.ajax({
            url: '/vendor/getUploadedImagesUrl',   // sending ajax request to this url
            type: 'get',
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function (response) {
                renderUploadedImages(response);
            },
            error: function (e) {
                $("#result").html("Some error encountered.");
            }
        });
    });

    $("#savedImageDiv").on("click", ".remove-icon", function(){
        let url = $(this).parent().prev().html().split("/").pop();
        $.ajax({
            url: '/vendor/removeUploadedImages',   // sending ajax request to this url
            type: 'post',
            dataType: "JSON",
            data: {
                "url": url,
            },
            success: function (response) {
                renderUploadedImages(response);
            },
            error: function (e) {
                $("#result").html("Some error encountered.");
            }
        });
    });

    $("#savedImageDiv").on("click", ".clipboard-icon", function(){
        let url = $(this).parent().prev().html();
        if (window.isSecureContext && navigator.clipboard) {
            navigator.clipboard.writeText(url);
        } else {
            const textArea = document.createElement("textarea");
            textArea.value = url;
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try {
                document.execCommand('copy');
            } catch (err) {
                console.error('Unable to copy to clipboard', err);
            }
            document.body.removeChild(textArea);
        }
    });

    $("#bulkUploadImagesButton").click(function () {
        let data = new FormData();

        let formField = $('#bulkUploadImages');
        data.append("source", "script");
        formField.each(function(key, item) {
            let fileData = item.files;
            console.log(fileData);
            for (var i = 0; i < fileData.length; i++) {
                data.append("bulkUploadImages[]", fileData[i]);
            }
        })

        $.ajax({
            url: '/vendor/saveUploadedImages',   // sending ajax request to this url
            type: 'post',
            dataType: "JSON",
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {

            },
            error: function (e) {
                $("#result").html("Some error encountered.");
            }
        });
    });

    $("#bulkUploadProductForm").submit( function(eventObj) {
        console.log("Fdsgdfgfdgfd");
        let categoryId = 0;
        $("select[name^='category']").each(function() {
            if($(this).val() != "0") {
                categoryId = $(this).val();
            }
        });
        $("<input />").attr("type", "hidden")
            .attr("name", "category")
            .attr("value", categoryId)
            .appendTo("#bulkUploadProductForm");
        return true;
    });
});