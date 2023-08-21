$(document).ready(function () {
    $("#success-alert")
        .delay(2000)
        .fadeIn("slow", function () {
            $("#success-alert").fadeOut(1500);
        });
    $("#error-alert")
        .delay(2000)
        .fadeIn("slow", function () {
            $("#error-alert").fadeOut(1500);
        });

    $(".error-message")
        .delay(1500)
        .fadeIn("slow", function () {
            $(".error-message").fadeOut(1500);
        });

    // for the program form validation
    // $("#programForm").validate({
    //     rules: {
    //         program_name: {
    //             required: true,
    //         },
    //     },
    //     messages: {
    //         program_name: {
    //             required: "Please enter a Program/Sector/Commodity name",
    //         },
    //     },
    //     errorElement: "span",
    //     errorPlacement: function (error, element) {
    //         error.addClass("invalid-feedback");
    //         element.closest(".form-group").append(error);
    //     },
    //     highlight: function (element, errorClass, validClass) {
    //         $(element).addClass("is-invalid");
    //     },
    //     unhighlight: function (element, errorClass, validClass) {
    //         $(element).removeClass("is-invalid");
    //     },
    // });

    // delete program modal
    $(".deleteProgramModal").on("click", function () {
        var val = $(this).parents("tr").attr("id");
        var name = $(this).parents("tr").attr("class");
        $("#deleteProgramModal #program_id").val(val);
        $("#deleteProgramModal #test").html(name);
    });
    $(".deleteStatusModal").on("click", function () {
        var val = $(this).parents("tr").attr("id");
        var name = $(this).parents("tr").attr("class");
        $("#deleteStatusModal #pc_id").val(val);
        $("#deleteStatusModal #test").html(name);
    });

    $("#programForm #program_name").bind("keyup blur", function () {
        var node = $(this);
        node.val(node.val().replace(/[0-9]/, ""));
    });
    $("#programCategoryForm #pc_name").bind("keyup blur", function () {
        var node = $(this);
        node.val(node.val().replace(/[0-9]/, ""));
    });

    $("#searchProductCategory #searchKey").bind("keyup blur", function () {
        var node = $(this);
        node.val(node.val().replace(/[0-9]/, ""));
    });
    $("#userForm #name").bind("keyup blur", function () {
        var node = $(this);
        node.val(node.val().replace(/[0-9]/, ""));
    });
    //for the association validation
    $("#associationForm #nameabbr,#associationForm #namedesc").bind(
        "keyup blur",
        function () {
            var node = $(this);
            node.val(node.val().replace(/[0-9]/, ""));
        }
    );

    // for the program form validation

    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    //mask the contact number
    $("[data-mask]").inputmask();

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    //AJAX
    $("#associationTable #as_status").on("change", function () {
        var uri = $(this).parents("table tr").attr("id");
        swal({
            title: "Are you sure?",
            text: "Inactive association will no longer be accessable!",
            icon: "warning",
            buttons: true,
            warningMode: true,
        }).then((isUpdate) => {
            if (isUpdate) {
                $.ajax({
                    url: uri,
                    type: "get",
                    dataType: "json",
                    success: function (response) {
                        swal("Good Job!", response.success, "success");
                    },
                    error: function () {
                        swal("OPPS!", "Error changing status", "error");
                    },
                });
            }
        });
    });
    $("#ascomcremod #ac_status").on("change", function () {
        var uri = $(this).parents("table tr").attr("class");
        $.ajax({
            url: uri,
            type: "get",
            dataType: "json",
            success: function (response) {
                swal("Good Job!", response.success, "success");
            },
            error: function () {
                swal("OPPS!", "Error changing status", "error");
            },
        });
    });

    $("#ascomcremod #deleteProgram").on("click", function () {
        var trObj = $(this);
        var userURL = $(this).data("url");
        var prograCount = $("#programCount").html();
        swal({
            title: "Are you sure?",
            text: "Once deleted, the user will no longer access the program.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: userURL,
                    type: "get",
                    dataType: "json",
                    success: function (response) {
                        swal("Poof! Successfully removed!", {
                            icon: "success",
                        });
                        trObj.parents("tr").remove();
                        prograCount -= 1;
                        $("#programCount").html(prograCount);
                    },
                    error: function () {
                        swal("OPPS!", "Error changing status", "error");
                    },
                });
            }
        });
    });

    $("#ascomcremod_barstatus #ab_status").on("change", function () {
        var uri = $(this).parents("table tr").attr("class");
        $.ajax({
            url: uri,
            type: "get",
            dataType: "json",
            success: function (response) {
                swal("Good Job!", response.success, "success");
            },
            error: function () {
                swal("OPPS!", "Error changing status", "error");
            },
        });
    });

    $("#ascomcremod_barstatus #deleteBarangay").on("click", function () {
        var trObj = $(this);
        var userURL = $(this).data("url");
        var prograCount = $("#barangayCount").html();
        swal({
            title: "Are you sure?",
            text: "Once deleted, the user will no longer access the barangay.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: userURL,
                    type: "get",
                    dataType: "json",
                    success: function (response) {
                        swal("Poof! Successfully removed!", {
                            icon: "success",
                        });
                        trObj.parents("tr").remove();
                        prograCount -= 1;
                        $("#barangayCount").html(prograCount);
                    },
                    error: function () {
                        swal("OPPS!", "Error changing status", "error");
                    },
                });
            }
        });
    });

    // validate form fixed position
    $("#fixedlocationForm").validate({
        rules: {
            region_id: "required",
            province_id: "required",
            citymun_id: "required",
        },
        messages: {
            region_id: "Region is required",
            province_id: "Province is required",
            citymun_id: "City/Municipality is required",
        },
    });

    //farmer form validation
    $("#farmerForm #reg_type").on("change", function () {
        $val = $(this).val();

        switch ($val) {
            case "All":
                $(
                    "#farmerForm #rsbsa_nat,#farmerForm #rsbsa_loc,#farmerForm #fishr_nat,#farmerForm #fishr_loc"
                ).attr("readonly", false);
                break;
            case "Farmer":
                $("#farmerForm #rsbsa_nat,#farmerForm #rsbsa_loc").attr(
                    "readonly",
                    false
                );
                $("#farmerForm #fishr_nat,#farmerForm #fishr_loc").attr(
                    "readonly",
                    true
                );
                break;
            case "Fisherfolk":
                $("#farmerForm #rsbsa_nat,#farmerForm #rsbsa_loc").attr(
                    "readonly",
                    true
                );
                $("#farmerForm #fishr_nat,#farmerForm #fishr_loc").attr(
                    "readonly",
                    false
                );
                break;
            default:
                $(
                    "#farmerForm #rsbsa_nat,#farmerForm #rsbsa_loc,#farmerForm #fishr_nat,#farmerForm #fishr_loc"
                ).attr("readonly", true);
                break;
        }
    });

    //mask the RSBSA
    $("#farmerForm  [data-mask]").inputmask();

    var farmerFormLettersOnly = [
        "fname",
        "mname",
        "lname",
        "pob",
        "name_of_spouse",
        "mothers_maidenname",
    ];

    jQuery.each(farmerFormLettersOnly, function (i, val) {
        $("#farmerForm #" + val).keyup(function (e) {
            /// ===
            var letters = /^[A-Za-z]+$/;
            var node = $(this);
            if (node.val().match(letters)) {
                node.val(node.val().toUpperCase());
            } else {
                // If you want to filter strings that are URL friendly and do not contain any special characters  /^[^ !"`'#%&,:;<>=@{}~\$\(\)\*\+\/\\\?\[\]\^\|]+$/
                node.val(
                    node
                        .val()
                        .toUpperCase()
                        .replace(/[0-9]/, "")
                        .replace(
                            /[-._!"`'#%&,:;<>=@{}~\$\(\)\*\+\/\\\?\[\]\^\|]+/,
                            ""
                        )
                );
            }
            /// ===
        });
    });

    var farmerFormDirectUpper = ["a_purok", "a_sitio"];

    $.each(farmerFormDirectUpper, function (index, value) {
        $("#farmerForm #" + value).keyup(function () {
            /// ===
            var node = $(this);
            node.val(upperCase(node));
            
            /// ===
        });
    });

    // for the civil status
    // $('input[name="civilstatus"]:checked').val();
    $("#farmerForm #civilstatus").on("change", function () {
        const value = $('input[name="civilstatus"]:checked').val();
        const idQ = "#farmerForm #name_of_spouse";
        switch (value) {
            case "Single":
                $(idQ).attr("readonly", true).val("N/A");
                break;
            case "Married":
                $(idQ).attr("readonly", false).val("");
                break;
            case "Separated":
                $(idQ).attr("readonly", false).val("");
                break;
            default:
                $(idQ).attr("readonly", true).val("Deceased");
                break;
        }
    });

     function upperCase(input) {
        return input.val().toUpperCase();
    }
});
