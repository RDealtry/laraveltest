"use strict";

$(function() {
    $("#mytests-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: "mytests_data/get_data",
        columns: [
            {
                data: "name"
            },
            {
                data: "cnum"
            },
            {
                data: "email"
            },
            {
                data: "address"
            },
            {
                data: "action",
                orderable: false,
                searchable: false
            }
        ]
    });

    function refresh() {
        var table = $("#mytests-table").DataTable();
        table.ajax.reload(null, false);
    }

    function cleaner() {
        $(".id").val("");
        $(".name").val("");
        $(".cnum").val("");
        $(".email").val("");
        $(".address").val("");
    }

    function token() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
    }

    //create
    $(document).on("click", ".create", function(e) {
        e.preventDefault();

        cleaner();
        $("#modalAdd").modal("show");
        $(".modal-title").text("Create Mytest");
    });

    //edit
    $(document).on("click", ".edit", function(e) {
        e.preventDefault();
        var id = $(this).attr("mytest_id");

        token();

        $.ajax({
            url: "mytests/" + id + "/edit",
            method: "get",
            success: function(result) {
                if (result.success) {
                    let json = jQuery.parseJSON(result.data);

                    $(".id").val(json.id);
                    $(".name").val(json.name);
                    $(".cnum").val(json.cnum);
                    $(".email").val(json.email);
                    $(".address").val(json.address);

                    $("#modalEdit").modal("show");
                    $(".modal-title").text("Update Mytest");
                }
            }
        });
    });

    //store
    $(document).on("submit", "#modalAdd", function(e) {
        e.preventDefault();

        var formData = $("form#store").serializeArray();

        token();

        var data = {
            name: formData[0].value,
            cnum: formData[1].value,
            email: formData[2].value,
            address: formData[3].value
        };
        $.ajax({
            url: "mytests",
            method: "post",
            data: data,
            success: function(result) {
                if (result.success) {
                    refresh();
                    $("#modalAdd").modal("hide");
                    swal("Good job!", "Successfully Saved!", "success");
                }
            }
        });
    });

    //update
    $(document).on("submit", "#modalEdit", function(e) {
        e.preventDefault();

        var formData = $("form#update").serializeArray();

        token();

        var id = formData[0].value;
        var data = {
            name: formData[1].value,
            cnum: formData[2].value,
            email: formData[3].value,
            address: formData[4].value
        };

        $.ajax({
            url: "mytests/" + id,
            method: "PUT",
            data: data,
            success: function(result) {
                if (result.success) {
                    refresh();
                    cleaner();
                    $("#modalEdit").modal("hide");
                    swal("Updated!", "Successfully Updated!", "success");
                }
            }
        });
    });

    //delete data
    $(document).on("click", ".delete", function(e) {
        e.preventDefault();
        var id = $(this).attr("mytest_id");

        swal({
            title: "Are you sure?",
            text: "you want to remove this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(result => {
            if (result.value) {
                token();

                $.ajax({
                    url: "mytests/" + id,
                    method: "DELETE",
                    success: function(result) {
                        if (result.success) {
                            refresh();
                            cleaner();
                            swal(
                                "Deleted!",
                                "Successfully Deleted!",
                                "success"
                            );
                        }
                    }
                });
            }
        });
    });
});
