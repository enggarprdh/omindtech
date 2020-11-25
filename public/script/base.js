function LoaderLayoutShow() {
    $("#status").show();
    $("#preloader").show();
}

function LoaderLayoutHide() {
    $("#status").fadeOut();
    $("#preloader").delay(350).fadeOut("slow");
}

function ValidateForm() {
    var result = true;
    var selector = $('[required]');

    $.each(selector, function () {
        if ($(this).val() == "" || $(this).val == " ") {

            $(this).addClass('is-invalid');

            if ($(this).attr('type') == 'password') {
                $('.input-group-text').addClass('invalid-password');
            }

            //kalau dia adalah dropdown init pakai ini
            if ($(this).hasClass('form-control select2-hidden-accessible')) {
                $('.select2-selection').addClass('select2-border-invalid');

                $(this).on("change", function () {
                    $('.select2-selection').removeClass('select2-border-invalid');
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                });
            }

            $(this).on("keyup", function () {
                if ($(this).val() != "" || $(this).val() != " ") {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');

                    if ($(this).attr('type') == 'password') {
                        $('.input-group-text').removeClass('invalid-password');
                    }
                }
            });

            result = false;
        }
    });
    return result;
}

//Start Save atau Update section
function ExecuteSave(opt, processData) {
    $.when(AjaxSave(opt.urlAction, opt.data, processData)).done(function (result) {
        if (result.response) {
            Swal.fire({
                type: "success",
                position: "center",
                title: result.message,
                timer: 2000
            });

            window.setTimeout(function () {
                window.location.href = opt.urlRedirect;
            }, 2000);
        } else {
            alert(result.message);
            Swal.fire({
                type: "error",
                position: "center",
                title: result.message
            });
        }
    })
}

function AjaxSave(linkSave, data, process) {

    console.log(linkSave);
    console.log(data);
    console.log(process);
    if(process) {
        
    return $.ajax({
        url: linkSave,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        // processData: false,
        success: function (data) {

        },
        error: function (data) {
            Swal.fire({
                type: "error",
                position: "center",
                title: "Something went wrong",
                timer: 2000
            });
        }
    });
    } else {
        
    return $.ajax({
        url: linkSave,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        success: function (data) {

        },
        error: function (data) {
            Swal.fire({
                type: "error",
                position: "center",
                title: "Something went wrong",
                timer: 2000
            });
        }
    });
    }

}
//End Save atau Update section
