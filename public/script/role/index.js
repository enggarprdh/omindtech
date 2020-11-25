$(document).ready(function () {

    loadGrid();
});

function loadGrid() {
    $('#dt-role').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: urlGetRole,
            complete: function () {
                initGrid();
            }
        },
        lengthMenu: [5, 10, 25, 50, 75, 100],
        columns: [{
                data: 'code',
                orderable: false,
            },
            {
                data: 'name',
                orderable: false,
            },
            {
                data: 'isActive',
                orderable: false,
                render: function (data) {
                    if (data) {
                        return '<center><span class="badge badge-pill badge-soft-success font-size-12">' + lang.active + '</span></center>';
                    } else {
                        return '<center><span class="badge badge-pill badge-soft-danger font-size-12">' + lang.inActive + '</span></center>';
                    }
                }
            },
            {
                target: 3,
                orderable: false,
                render: function (data, type, row, meta) {


                    var headBtnChangeStatus = '<form action="' + row.id + '" method="POST">';
                    var endBtnChangeStatus = '</form>';
                    var btnChangeStatusMethod = '<input type="hidden" name="_method" value="delete" />';
                    var csrf_token = $('meta[name="csrf-token"]').attr('content');
                    var btnChangeStatusCSRF = '<input type="hidden" name="_token" value="' + csrf_token + '"/>';
                    var linkStatus = '';

                    if (row.isActive) {
                        linkStatus = '<button type="button" title data-original-title="' + lang.inActive + '" data-toggle="tooltip" data-placement="right" data-id="' + row.id + '" data-token=' + csrf_token + ' class="dropdown-item btn-status">' +
                            '<i style="color:red;" class="fas fa-ban font-size-18 align-middle mr-2"></i>' + lang.inActive +
                            '</button>';
                    } else {
                        linkStatus = '<button type="button" title data-original-title="' + lang.active + '" data-toggle="tooltip" data-placement="right" data-id="' + row.id + '" data-token=' + csrf_token + ' class="dropdown-item btn-status">' +
                            '<i style="color:green;" class="fas fa-check-circle font-size-18 align-middle mr-2"></i>' + lang.active +
                            '</button>';
                    }

                    var btnEditHtml = '<button data-toggle="tooltip" data-id="' + row.id + '"' + 'data-placement="right" title data-original-title="' + lang.edit + '" type="button" class="dropdown-item btn-edit"><i style="color:grey;" class="bx bxs-wrench font-size-18 align-middle mr-2"></i>' + lang.edit + '</button>';

                    var btnDeleteHtml = '<button data-toggle="tooltip" data-id="' + row.id + '"' + 'data-token="' + csrf_token + '" data-placement="right" title data-original-title="' + lang.delete + '" type="button" class="dropdown-item btn-delete"><i class="mdi dripicons-cross font-size-18 align-middle mr-2"></i>' + lang.delete + '</button>'


                    var btnDropDown = '<div class="dropdown">' +
                        '<a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="true">' +
                        '<center><i class="mdi mdi-dots-horizontal font-size-18"></i></center>' +
                        '</a>' +
                        '<div class="dropdown-menu dropdown-menu-right" style="position: absolute; transform: translate3d(-163px, 25px, 0px); top: 0px; left: 0px; will-change: transform;" x-placement="bottom-end">' +
                        headBtnChangeStatus + btnChangeStatusMethod + btnChangeStatusCSRF + linkStatus + endBtnChangeStatus +
                        btnEditHtml +
                        headBtnChangeStatus + btnChangeStatusMethod + btnChangeStatusCSRF + btnDeleteHtml + endBtnChangeStatus +
                        '</div>';

                    return btnDropDown;
                }
            }
        ],
        columnDefs: [{
            "orderable": false,
            "targets": 0
        }],
        initComplete: function (e) {
            var table = $(this).DataTable();
            table.buttons().container().appendTo("#dt-role_wrapper .col-md-6:eq(0)");
            initGrid();
        },
        buttons: [
            {
                extend: "excel",
                text: langDT.exportExcel
            },
            {
                extend: "pdf",
                text: langDT.exportPDF
            }, ,
            {
                extend: "colvis",
                text: langDT.colvis
            },
        ],
        language: {
            processing: langDT.processing,
            search: langDT.search,
            paginate: {
                previous: langDT.previous,
                next: langDT.next
            },
            info: langDT.info,
            lengthMenu: langDT.lengthMenu
        }
    })
}

function initGrid() {
    $(".btn-edit").on("click", function () {
        var id = $(this).data("id");
        window.location.href = urlEdit + "/edit/" + id;
    });

    $(".btn-status").on("click", function () {
        var id = $(this).data("id");
        var link = urlEdit + "/status/" + id;
        var token = $(this).data('token');
        Swal.fire({
            title: lang.confirmation,
            text: lang.confirmationStatus,
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Yes"
        }).then(function (t) {
            if (t.value) {
                var dataToSend = {
                    id: id,
                    _method: 'DELETE',
                    _token: token
                }

                $.when(ajaxUpdateStatus(link, dataToSend)).done(function () {
                    Swal.fire({
                        position: "center",
                        type: "success",
                        title: lang.confirmationSuccess,
                        timer: 1000
                    });
                    var table = $('#dt-role').DataTable();
                    table.clear();
                    table.ajax.reload(function () {
                        initGrid();
                    });

                });
            }

        })

    });

    $(".btn-delete").on("click", function () {
        var id = $(this).data("id");
        var link = urlEdit + "/delete/" + id;
        var token = $(this).data('token');
        Swal.fire({
            title: lang.confirmation,
            text: lang.confirmationDelete,
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Yes"
        }).then(function (t) {
            if (t.value) {
                var dataToSend = {
                    id: id,
                    _method: 'DELETE',
                    _token: token
                }

                $.when(ajaxDeleteRole(link, dataToSend)).done(function () {
                    Swal.fire({
                        position: "center",
                        type: "success",
                        title: lang.confirmationDelete,
                        timer: 1000
                    });
                    var table = $('#dt-role').DataTable();
                    table.clear();
                    table.ajax.reload(function () {
                        initGrid();
                    });

                });
            }

        })
    });

    $('[data-toggle="tooltip"]').tooltip()
}


function ajaxUpdateStatus(link, data) {
    return $.ajax({
        url: link,
        data: data,
        type: 'DELETE',
        success: function (result) {

        },
        error: function (result) {

        }
    });
}

function ajaxDeleteRole(link, data) {
    return $.ajax({
        url: link,
        data: data,
        type: 'DELETE',
        success: function (result) {

        },
        error: function (result) {

        }
    });
}
