$(document).ready(function () {
    //start of jquery
    // Global variables
    var letters = /^[A-Za-z]+$/;

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
            // var letters = /^[A-Za-z]+$/;
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

    var farmerDetails = ["name_househead", "others_religion", "name_of_group"];

    jQuery.each(farmerDetails, function (i, val) {
        $("#farmerDetails #" + val).keyup(function (e) {
            /// ===
            // var letters = /^[A-Za-z]+$/;
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

    $("#farmerDetails #religion").on("change", function () {
        const value = $('input[name="religion"]:checked').val();
        const idQ = "#farmerDetails #others_religion";
        switch (value) {
            case "Christianity":
                $(idQ).attr("readonly", true).val("Christianity");
                break;
            case "Islam":
                $(idQ).attr("readonly", true).val("Islam");
                break;

            default:
                $(idQ).attr("readonly", false).val("");
                break;
        }
    });

    $("#farmerDetails #is_house_head").on("change", function () {
        const value = $('input[name="is_house_head"]:checked').val();
        const idQ = "#farmerDetails #name_househead";

        if (value === "Yes") {
            const name = $(".profile-username").html();
            $(idQ).attr("readonly", true).val(name);
        } else {
            $(idQ).attr("readonly", false).val("");
        }
    });

    //     "is_ip " => "IP is required",
    //     "name_of_group " => "This field is required",

    $("#farmerDetails #is_ip").on("change", function () {
        const value = $('input[name="is_ip"]:checked').val();
        const idQ = "#farmerDetails #name_of_group";

        if (value === "Yes") {
            $(idQ).attr("readonly", false).val("");
        } else {
            $(idQ).attr("readonly", true).val("None");
        }
    });

    $("#farmerDetails #no_male").keyup(function () {
        const num_of_household = $("#farmerDetails #num_of_household").val();
        const no_male = $(this).val();

        const result = num_of_household - no_male;

        if (result >= 0 && result <= num_of_household) {
            $("#no_female").val(result);
        } else {
            $("#no_male").val("");
            $("#no_female").val("0");
        }
    });

    // Validation on onchange event for farmers and fisherfolk type of activity
    $("#livelihood #type_of_activity").on("change", function () {
        const value = $(this).val();
        switch (value) {
            case "Crops":
                checkingProps(this, "#livelihood #crops_specify");
                break;
            case "Livestock":
                checkingProps(this, "#livelihood #livestock_specify");
                break;
            case "Poultry":
                checkingProps(this, "#livelihood #poultry_specify");
                break;
            default:
                //do nothing
                break;
        }
    });

    $("#livelihood #kind_of_work").on("change", function () {
        const value = $(this).val();

        if (value == "Others") {
            if ($(this).prop("checked") == true) {
                $("#livelihood #kind_of_work_others").attr("readonly", false);
            } else {
                $("#livelihood #kind_of_work_others").attr("readonly", true);
            }
        }
    });
    $("#livelihood #fishing_activity").on("change", function () {
        const value = $(this).val();

        if (value == "Others") {
            if ($(this).prop("checked") == true) {
                $("#livelihood #fishing_activity_others").attr(
                    "readonly",
                    false
                );
            } else {
                $("#livelihood #fishing_activity_others").attr(
                    "readonly",
                    true
                );
            }
        }
    });
    $("#livelihood #involvement").on("change", function () {
        const value = $(this).val();

        if (value == "Others") {
            if ($(this).prop("checked") == true) {
                $("#livelihood #involvement_others").attr("readonly", false);
            } else {
                $("#livelihood #involvement_others").attr("readonly", true);
            }
        }
    });

    /**For the Farm Details add more name of farmer**/
    $("#add_name_of_owner").on("click", function (e) {
        e.preventDefault();

        $("#more_owner").append(
            "<div class='row' id='row'><div class='col d-flex align-items-center'> <input type='text' name='name_of_owner[]' id='name_of_owner' class='form-control mr-1 mb-1' placeholder='Name of Owner'> <a href='#' id='remove_name_of_owner'> <i class='fa-solid fa-xmark'></i></a></label></div></div>"
        );
    });

    /**for the update add more**/
    $("#update_add_name_of_owner").on("click", function (e) {
        e.preventDefault();

        $("#more_owner").append(
            "<div class='row' id='row'><div class='col d-flex align-items-center'> <input type='text' name='name_of_owner[]' id='name_of_owner' class='form-control mr-1 mb-1' placeholder='Name of Owner'> <a href='#' id='remove_name_of_owner'> <i class='fa-solid fa-xmark'></i></a></label></div></div>"
        );
    });

    $("body").on("click", "#remove_name_of_owner", function (e) {
        e.preventDefault();
        $(this).parents("#row").remove();
    });

    $("body").on("click", "#update_remove_name_of_owner", function (e) {
        e.preventDefault();

        $(this).parents("#row").remove();
    });

    $("#admin_farmdetails #location_purok").keyup(function () {
        const node = $(this);
        node.val(upperCase(node));
    });

    $("#admin_farmdetails #name_of_owner").keyup(function () {
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
    });

    $("#admin_farmdetails #ownership_type").on("change", function () {
        const node = $(this).val();

        if (node == "") {
            $("#admin_farmdetails #name_of_owner").val("");
        } else {
            switch (node) {
                case "Registered Owner":
                    const ownerName = $(
                        "#admin_farmdetails #farm_owner_name"
                    ).val();
                    $("#admin_farmdetails #name_of_owner").val(ownerName);
                    $("#admin_farmdetails #name_of_owner").attr(
                        "readonly",
                        true
                    );
                    $("#admin_farmdetails #add_name_of_owner").css(
                        "display",
                        "none"
                    );
                    break;

                default:
                    $("#admin_farmdetails #name_of_owner").val("");
                    $("#admin_farmdetails #add_name_of_owner").css(
                        "display",
                        "block"
                    );
                    $("#admin_farmdetails #name_of_owner").attr(
                        "readonly",
                        false
                    );
                    break;
            }
        }
    });

    $("#admin_farmdetails #total_area").keyup(function () {
        var val = $(this).val();
        doubleValueOnly(val, $(this));
    });

    $("#saveActivity #area,#saveActivity #hills").keyup(function () {
        var val = $(this).val();
        doubleValueOnly(val, $(this));
    });

    $("#saveActivity #remarks").keyup(function () {
        const node = $(this);
        node.val(upperCase(node));
    });

    //ajax for updating farm detail status
    $("#update_farmdetails_status #farmdetails_status").on(
        "change",
        function () {
            var farmDetailsUrl = $(this).parents("table tr").attr("id");

            swal({
                title: "Are you sure you want to change farm details status?",
                text: "Inactive farm details will not be accessable.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: farmDetailsUrl,
                        type: "get",
                        dataType: "json",
                        success: function (response) {
                            swal("Farm status was successfully updated!", {
                                icon: "success",
                            });
                        },
                        error: function () {
                            swal("OPPS!", "Error changing status", "error");
                        },
                    });
                }
            });
        }
    );

    // Adding Farm Activity Using A modal
    // #modalFarmName, #modalFarmName

    $("#saveActivity #program_id").on("change", function () {
        const progUrm = $(this).val(); //the url
        const url = progUrm.split("@");
        $("#saveActivity #pc_id").html("");
        $.ajax({
            url: url,
            type: "get",
            dataType: "json",
            success: function (response) {
                $.each(response.programCategory, function (key, value) {
                    $("#saveActivity #pc_id").append(
                        '<option value="' +
                            value.pc_id +
                            '">' +
                            value.pc_name +
                            "</option>"
                    );
                });
            },
            error: function () {
                swal("OPPS!", "Error Loading Region ", "error");
            },
        });
    });

    $("#saveActivity").validate({
        rules: {
            program_id: {
                required: true,
            },
            pc_id: {
                required: true,
            },
            area: {
                required: true,
            },
            hills: {
                required: true,
            },
            no_of_heads: {
                required: true,
            },
            farmtype: {
                required: true,
            },
            is_organic: {
                required: true,
            },
            remarks: {
                required: true,
            },
        },
        messages: {
            program_id: {
                required: "This field is required",
            },
            pc_id: {
                required: "This field is required",
            },
            area: {
                required: "This field is required",
            },
            hills: {
                required: "This field is required",
            },
            no_of_heads: {
                required: "This field is required",
            },
            farmtype: {
                required: "This field is required",
            },
            is_organic: {
                required: "This field is required",
            },
            remarks: {
                required: "This field is required",
            },
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },
    });

    /******* FUNCTIONS *******/

    function doubleValueOnly(value, selectors) {
        var dataVal = value;
        if (isNaN(dataVal)) {
            dataVal = dataVal.replace(/[^0-9\.]/g, "");
            if (dataVal.split(".").length > 2)
                dataVal = dataVal.replace(/\.+$/, "");
        }
        $(selectors).val(dataVal);
    }

    function upperCase(input) {
        return input.val().toUpperCase();
    }

    function checkingProps(event, specify) {
        if ($(event).prop("checked") == true) {
            $(specify).attr("readonly", false).val("");
        } else {
            $(specify).attr("readonly", true).val("None");
        }
    }

    //end of jquery
});
