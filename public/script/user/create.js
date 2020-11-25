$(document).ready(function () {
    InitForm();
});


function InitForm() {

    //dropdown role
    $.when(ajaxGetRole()).done(function (dataRole) {
        $("#role").select2({
            data: dataRole,
            placeholder: 'Select Role',
            allowClear: true
        })
    });

    //password control
    $(".mdi-eye").on("click", function () {
        var selectorPass = $("#password");

        if (selectorPass.attr('type') == 'password') {
            selectorPass.attr('type', 'text');
            $(this).removeClass('mdi-eye');
            $(this).addClass('mdi-eye-off');
        } else {
            selectorPass.attr('type', 'password');
            $(this).removeClass('mdi-eye-off');
            $(this).addClass('mdi-eye');
        }
    });

    $("#upload").on("change", function () {
        console.log($(this).val());
    });

}

function ajaxGetRole() {
    return $.ajax({
        url: urlRoleDropdown,
        type: 'GET',
        success: function (data) {

        },
        error: function (data) {

        }
    });
}

function Save() {
    if (ValidateForm()) {
        var link = urlUserSave;
        var form = {
            firstName: $("#firstname").val(),
            lastName: $("#lastname").val(),
            roleId: $("#role").val(),
            email: $("#email").val(),
            password: $("#password").val(),
            file: $("#upload").prop('files')
        }

        var options = {
            urlAction: link,
            data: form,
            urlRedirect: urlPage,
            successMessage: "Success",
            errorMessage: "Failed"
        }

        ExecuteSave(options, true);
    }
}
