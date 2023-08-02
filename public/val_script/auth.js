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

    // for the program form validation

    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    //mask the contact number
    $("[data-mask]").inputmask();

    //DATA
    // $("#editProgramRow").hide();

    $("#ascomcremod #ac_status").on("change", function () {
        let value = $(this).val();
        let id = $(this).parents("tr").attr("id");
        $("#editProgramRow").removeClass("d-none");

        $("#editProgramRow #ac_program_id option[value=" + id + "]").prop('selected', true);
        $("#editProgramRow #ac_status option[value=" + value + "]").prop('selected', true);
        // $('#editProgramRow #ac_program_id').val(value).attr("selected", "selected");
        $("#editProgramRow").show(function () {
            $("#addProgramRow").hide();
        });
       
    });
});
