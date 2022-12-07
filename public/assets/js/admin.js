$(document).ready(function() {
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