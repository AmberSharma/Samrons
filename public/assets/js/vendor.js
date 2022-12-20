$(document).ready(function() {

    var tableClasses = ['table-primary', 'table-secondary', 'table-success', 'table-danger', 'table-warning', 'table-info', 'table-light', 'table-dark']
    function cartesianProduct(arr) {
        return arr.reduce((a, b) =>
            a.map(x => b.map(y => x.concat(y)))
                .reduce((a, b) => a.concat(b), []), [[]]);
    }

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
                        if (response !== undefined) {
                            let parentClass = self.parent().parent().attr("class");
                            let html = '';
                            html = '<div class="form-group row subcategory" >';
                            html += '<div class="'+parentClass+'">';
                            html += '<div class="form-floating">';
                            html += '<select id="' + attributeId + '" class="form-control category-subset" name="category">';
                            html += '<option> ---Select Sub Category---</option>';
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


    function optionValueCombination(element) {
        let valueCombination = [];
        $("*[id^=optionvalue__]").each(function(index) {
            if (valueCombination[index] === undefined) {
                valueCombination[index] = [];
            }
            let indexValues = JSON.parse($(this).val());
            console.log(indexValues);
            indexValues.forEach(function(item, key) {
                if (valueCombination[index][key] === undefined) {
                    valueCombination[index][key] = [];
                }
                valueCombination[index][key] = item.value;
            });
        });


        valueCombination = cartesianProduct(valueCombination);
        console.log(valueCombination);
        let html = '';
        if (valueCombination !== undefined) {
            html += '<table id="bootstrap-data-table" class="table table-striped table-bordered table-danger">';
            html += '<thead>';
            html += '<tr>';
            html += '<th>Variant</th>';
            html += '<th>SKU Id</th>';
            html += '<th>Quantity</th>';
            html += '<th>Price</th>';
            html += '<th>Image</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            valueCombination.forEach(function (item, index) {
                html += '<tr class="'+ tableClasses[index] +'">';
                // html += '<div class="form-group row" >';
                // html += '<div class="col-sm-1">';
                html += '<td>';
                html += item.join("/");
                html +='<input type="hidden" id="valueCombination" name="valueCombination" value='+item+'>'
                // html += "</div>";
                // html += '<div class="col-sm-2">';
                html += '</td>';
                html += '<td>';
                html += '<input type="text" name="skuId" class="form-control"/>';
                // html += "</div>";
                // html += '<div class="col-sm-2">';
                html += '</td>';
                html += '<td>';
                html += '<input type="text" name="quantity" class="form-control"/>';
                // html += "</div>";
                // html += '<div class="col-sm-2">';
                html += '</td>';
                html += '<td>';
                html += '<input type="text" name="price" class="form-control"/>';
                html += '</td>';
                html += '<td>';
                html += ' <input class="form-control" type="file" name="productimage" id="productimage" onchange="return fileValidation(this.id);">';
                html += '</td>';
                // html += "</div>";
                // html += "</div>";
            });

            html += '</tbody>';
            html += '</table>';
        }

        element.parent().next().append(html);
    }

    $("#addCategoryButton").click(function () {
        if($("#addCategoryForm").valid()) {
            let data = new FormData();
            let formData = $('form').serializeArray();

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
                    data.append("categoryimage[]", fileData[i]);
                }
            })

            $.ajax({
                url: '/vendor/addCategories',   // sending ajax request to this url
                type: 'post',
                dataType: "JSON",
                processData: false,
                contentType: false,
                data: data,
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

    $('#plus').on('click',function () {
        let self = $(this);
        $.ajax({
            url: '/admin/getOptions',   // sending ajax request to this url
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
                    html += '<option> ---Select Option---</option>';
                    if (response !== undefined) {
                        response.forEach(function (item, index) {
                            html += '<option value=' + item['id'] + '>' + item['name'] + '</option>';
                        });
                    }

                    html += "</select>";
                    html += "</div>";
                    html += '<div class="col-sm-6 optionval">\n';
                    let optionValueSelector = '<input type="textarea" id="optionvalue__'+optionValueSelectorLength+'" placeholder="Enter Option Values" class="form-control" name="optionvalues"></div></div>';
                    html += optionValueSelector;

                    //let currentHtml = self.parent().next().html() + html;
                    self.parent().next().append(html);

                    $("input[name=optionvalues]").each(function(i, obj) {
                        new Tagify(obj)
                    });

                }
            },
            error: function (e) {
                $("#result").html("Some error encountered.");
            }
        });

        // let optionValueSelectorLength = $("[id^=optionvalue__]").length;
        // let optionSelector=$(this).parent().parent();
        // optionSelector = optionSelector.find("select").attr("id", "pro__"+optionValueSelectorLength).parent().html();;
        // let html = '';
        // html += '<div class="form-group row" style="margin-top:10px;">';
        // html += '<div class="col-sm-4 optionval">';
        // html += optionSelector;
        // html += '</div>'
        // html += '<div class="col-sm-6 optionval">\n';
        // let optionValueSelector = '<input type="textarea" id="optionvalue__"'+optionValueSelectorLength+' placeholder="Enter Option Values" class="form-control" name="tags"></div></div>';
        // html += optionValueSelector;
        // $(this).parent().parent().after(html);
        //
        // //let input = document.querySelector('input[name=tags]')
        // $("input[name=tags]").each(function(i, obj) {
        //     new Tagify(obj)
        // });

    });

    $('*[id^=cat__]').change(function(){
        renderSubCategory($(this));
    });

    $("#refresh").click(function () {
        optionValueCombination($(this));
        optionValueCombinationSave($(this));
    });

   /* function renderOptionValues(element) {
        let self = elemen t;
        let elementId = element.attr("id");
        let elementIdNum = elementId.split("__")[1];
        if (elementIdNum === undefined) {
            elementIdNum = 0;
        } else {
            elementIdNum = parseInt(elementIdNum);
        }
        let optionid=element.val();
        self.removeClass('error');
        self.parent().nextAll('.optionval').remove();
        if (!isNaN(parseInt(optionid))) {
            $.ajax({
                url: '/vendor/getoptionValues',   // sending ajax request to this url
                type: 'post',
                data: {
                    'optionid': optionid,
                    'source': 'script'
                },
                success: function (response) {
                    if (response.length > 0) {
                        let attributeId = 'pro__' + (elementIdNum + 1);
                        response = JSON.parse(response);
                        let html = '';
                        html += '<div class="col-sm-4 optionval">';
                        html += '<select id="' + attributeId + '" class="form-control selectpicker" multiple data-live-search="true">';
                        html += '<option> ---Select Option Value---</option>';

                        if (response !== undefined) {
                            response.forEach(function (item, index) {
                                html += '<option value=' + item['id'] + '>' + item['value_name'] + '</option>';
                            });
                            html += '</select>';
                            html += '</div></div>';
                            html += '<div class="col-sm-2 optionval optionbutton">';
                            html += '<button type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button>';
                            html += '</div>';

                            self.parent().after(html);
                            $('.selectpicker').selectpicker();
                        }
                    }
                },
                error: function (e) {
                    $("#result").html("Some error encountered.");
                }

            });
        }
    }*/
    $("#addProductDetails").click(function () {
        //let data = new FormData();
        // let formData = $("form").serializeArray();
        // let formDataLength = formData.length;
        //
        // let fileData = $('input[name="productimage"]')[0].files;
        // for (var i = 0; i < fileData.length; i++) {
        //     //formData.append("productimage[]", fileData[i]);
        //     formData[formDataLength] = {
        //         "name": "productimage",
        //         "value": [{
        //             'lastMod': fileData[i].lastModified,
        //             'lastModDate': fileData[i].lastModifiedDate,
        //             'name': fileData[i].name,
        //             'size': fileData[i].size,
        //             'type': fileData[i].type
        //         }]
        //     }
        //     //JSON.stringify(formData[formDataLength].value);
        //     formDataLength += 1;
        // }
        // console.log(formData);

        let data = new FormData();
        let formData = $('form').serializeArray();

        $.each(formData, function (key, input) {
            data.append("productdetails["+key+"][name]", input.name);
            data.append("productdetails["+key+"][value]", input.value);
        });
        let formField = $('input[name="productimage"]');
        formField.each(function(key, item) {
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
            // data: {
            //     "productdetails": formData
            // },
            success: function (response) {

                // reset form fields after submit
                //$("#regForm")[0].reset();
            },
            error: function (e) {
                $("#result").html("Some error encountered.");
            }
        });

    });

    $("input[name=tags]").each(function(i, obj) {
        new Tagify(obj)
    });
});