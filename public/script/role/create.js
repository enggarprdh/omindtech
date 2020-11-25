var csrf_token = $('meta[name="csrf-token"]').attr('content');
var tempDataRole = [];
var featureList = [];


$(document).ready(function () {
    InitForm();
    InitNavbar();
});

function InitForm() {


    $.when(ajaxDataPlugin()).done(function (result) {
        $(".select2").select2({
            data: result,
            placeholder: lang.selectFeature,
            allowClear: true
        })
    });


    $('#dt-feature').DataTable({
        columns: [{
                data: 'pluginName',
                orderable: false,
            },
            {
                data: 'featureName',
                orderable: false,
            }, {
                data: 'canCreate',
                render: function (data, type, row, meta) {
                    var createChecked = "";
                    var checkCreate = ""
                    if (row.canCreate) {
                        createChecked = 'checked';
                        checkCreate = '<center><input type="checkbox" data-val="' + row.canCreate + '" class="chx-create" data-id="' + row.feature_id + '" checked="' + createChecked + '" /></center>';
                    } else {
                        checkCreate = '<center><input type="checkbox" data-val="' + row.canCreate + '" class="chx-create" data-id="' + row.feature_id + '" /></center>';
                    }

                    return checkCreate;
                }
            },
            {
                data: 'canRead',
                render: function (data, type, row, meta) {
                    var readChecked = "";
                    var checkRead = '';
                    if (row.canRead) {
                        readChecked = 'checked';
                        checkRead = '<center><input type="checkbox" class="chx-read" data-id="' + row.feature_id + '" checked="' + readChecked + '" /></center>';
                    } else {
                        checkRead = '<center><input type="checkbox" class="chx-read" data-id="' + row.feature_id + '" /></center>';
                    }

                    return checkRead;
                }
            },
            {
                data: 'canUpdate',
                render: function (data, type, row, meta) {
                    var updateChecked = "";
                    var checkUpdate = '';
                    if (row.canUpdate) {
                        updateChecked = 'checked';
                        checkUpdate = '<center><input type="checkbox" class="chx-update" data-id="' + row.feature_id + '" ' + updateChecked + ' /></center>';
                    } else {
                        checkUpdate = '<center><input type="checkbox" class="chx-update" data-id="' + row.feature_id + '" /></center>';
                    }

                    return checkUpdate;
                }
            },
            {
                data: 'canDelete',
                render: function (data, type, row, meta) {
                    var deleteChecked = "";
                    var checkDelete = '';
                    if (row.canDelete) {
                        deleteChecked = 'checked';
                        checkDelete = '<center><input type="checkbox" class="chx-delete" data-id="' + row.feature_id + '" ' + deleteChecked + ' /></center>';
                    } else {
                        checkDelete = '<center><input type="checkbox" class="chx-delete" data-id="' + row.feature_id + '" /></center>';
                    }

                    return checkDelete;
                }
            },
            {
                data: 'feature_id',
                render: function (data, type, row, meta) {
                    var btnEditHtml = '<center><a href="#" data-toggle="tooltip" data-id="' + row.feature_id +
                        '" data-placement="right" title data-original-title="' + lang.delete + '" type="button" ' +
                        'class="btn-delete"><i style="color:grey;" class="mdi dripicons-cross font-size-18 align-middle mr-2"></i></a></center>';
                    return btnEditHtml;
                },
            },

        ],
        paging: false,
        ordering: false,
        info: false,
        language: {
            processing: langDT.processing,
            search: langDT.search,
        }
    });

}

function Save() {

    var table = $('#dt-feature').DataTable();
    var data = table.rows().data();

    $.each(data, function (key, value) {

        var canAdd = true;

        if (featureList.length > 0) {
            var find = $.grep(featureList, function (data) {
                return data.feature_id === value.feature_id
            });

            if (find.length > 0) {
                canAdd = false;
            }
        }

        if (canAdd) {
            var feature = {
                featureName: value.featureName,
                pluginName: value.pluginName,
                feature_id: value.feature_id,
                canRead: value.canRead,
                canCreate: value.canCreate,
                canUpdate: value.canUpdate,
                canDelete: value.canDelete
            };

            featureList.push(feature);
        }

    })

    var link = urlSaveRole;

    var form = {
        name: $("#name").val(),
        code: $("#code").val()
    }

    var dataToSend = {
        roleInfo: form,
        roleFeature: featureList
    }

    if (formValidate(dataToSend)) {
        $.when(ajaxSave(link, dataToSend)).done(function (result) {
            if (result.result) {
                Swal.fire({
                    type: "success",
                    position: "center",
                    title: "Your data has been saved",
                    timer: 2000
                });
                window.setTimeout(function () {
                    window.location.href = urlPage;
                }, 2000);
            } else {
                Swal.fire({
                    type: "error",
                    title: result.message,
                    timer: 2000
                });
            }
        });
    }
}

function formValidate(data) {

    var result = true;

    if (data.roleInfo.code == null || data.roleInfo.code == "") {
        $("#code").addClass('is-invalid');

        $("#code").on("keyup", function () {
            if ($(this).val() != "" || $(this).val() != " ") {
                $("#code").removeClass('is-invalid');
                $("#code").addClass('is-valid');
            }
        });

        result = false;
    }

    if (data.roleInfo.name == null || data.roleInfo.name == "") {
        $("#name").addClass('is-invalid');

        $("#name").on("keyup", function () {
            if ($(this).val() != "" || $(this).val() != " ") {
                $("#name").removeClass('is-invalid');
                $("#name").addClass('is-valid');
            }
        });

        result = false;
    }

    if (data.roleFeature.length == 0 || data.roleFeature.length < 0) {
        var alertError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
            'Please select feature first' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">×</span>' +
            '</button>' +
            '</div>';


        $("#alert-section").append(alertError);

        result = false;
    }

    return result;

}


function ajaxDataPlugin() {
    return $.ajax({
        url: urlListPlugin,
        type: 'GET',
        success: function (data) {

        },
        error: function (data) {

        }
    });
}

function ajaxSave(link, data) {
    return $.ajax({
        url: link,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        success: function (data) {

        },
        error: function (data) {

        }
    });
}

function addFeature() {

    var table = $('#dt-feature').DataTable();
    var tempData = table.rows().data();
    var feature_id = $(".select2").val();
    var canAdd = true;

    if (tempData.length > 0) {

        $.each(tempData, function (key, value) {

            if (value.feature_id == feature_id) {
                canAdd = false;
            }
        })

        if (canAdd) {
            AddToTable(feature_id);
        }

    } else {
        AddToTable(feature_id);
    }
}

function AddToTable(feature_id) {
    $.when(GetFeature(feature_id)).done(function (x) {

        var obj = {
            plugin_id: x[0].plugin_id,
            feature_id: x[0].feature_id,
            pluginName: x[0].pluginName,
            featureName: x[0].featureName,
        }

        var dt = $('#dt-feature').DataTable();


        var rowNode = dt.row.add({
            pluginName: obj.pluginName,
            featureName: obj.featureName,
            feature_id: obj.feature_id,
            canCreate: 0,
            canRead: 0,
            canUpdate: 0,
            canDelete: 0
        }).draw().node();

        $(rowNode).last().animate({
            height: "50px"
        }, 500);

        $(".btn-delete").on("click", function () {
            var table = $('#dt-feature').DataTable();
            var rowNode = table.row($(this).parents('tr')).remove().draw();

            $(".arrow").remove();
            $(".tooltip-inner").remove();
        });

        $(".chx-create").on("change", function () {
            var canCreate = false;
            if (!$(this).is(':checked')) {
                $(this).attr('checked', false);
                $(this).attr('data-val', '0');
                canCreate = 0;

            } else {
                $(this).attr('checked', true);
                $(this).attr('data-val', '1');
                canCreate = 1;
            }

            var feature_id = $(this).data('id');

            reloadDataTable(feature_id, 'canCreate', canCreate);
        });

        $(".chx-read").on("change", function () {
            var canRead = false;
            if (!$(this).is(':checked')) {
                $(this).attr('checked', false);
                $(this).attr('data-val', '0');
                canRead = 0;

            } else {
                $(this).attr('checked', true);
                $(this).attr('data-val', '1');
                canRead = 1;
            }

            var feature_id = $(this).data('id');

            reloadDataTable(feature_id, 'canRead', canRead);
        });

        $(".chx-update").on("change", function () {
            var canUpdate = false;
            if (!$(this).is(':checked')) {
                $(this).attr('checked', false);
                $(this).attr('data-val', '0');
                canUpdate = 0;

            } else {
                $(this).attr('checked', true);
                $(this).attr('data-val', '1');
                canUpdate = 1;
            }

            var feature_id = $(this).data('id');

            reloadDataTable(feature_id, 'canUpdate', canUpdate);
        });

        $(".chx-delete").on("change", function () {
            var canDelete = false;
            if (!$(this).is(':checked')) {
                $(this).attr('checked', false);
                $(this).attr('data-val', '0');
                canDelete = 0;

            } else {
                $(this).attr('checked', true);
                $(this).attr('data-val', '1');
                canDelete = 1;
            }

            var feature_id = $(this).data('id');

            reloadDataTable(feature_id, 'canDelete', canDelete);
        });

        $('[data-toggle="tooltip"]').tooltip()

    })
}

function reloadDataTable(feature_id, mode, valueRef) {

    var table = $("#dt-feature").DataTable();
    var data = table.rows().data();

    $.each(data, function (key, value) {

        if (value.feature_id == feature_id) {

            if (mode == 'canCreate') {
                value.canCreate = valueRef;
            } else if (mode == 'canRead') {
                value.canRead = valueRef;
            } else if (mode == 'canUpdate') {
                value.canUpdate = valueRef;
            } else if (mode == 'canDelete') {
                value.canDelete = valueRef;
            }
        }

    });

    table.draw();
}

function InitTempTable() {
    $('#dt-role').DataTable();

}

function GetFeature(id) {
    var link = urlPage + '/getfeature/' + id;
    return $.ajax({
        url: link,
        type: 'GET',
        success: function (data) {

        },
        error: function (data) {

        }
    });
}
