
var table = $("#datatable").DataTable({
    processing: true,
    serverSide: true,
    searching: false,
    pageLength: 100,
    order: [
        [0, "asc"]
    ],
    buttons: [
        'copy', 'csv', 'excel', 'print'
    ],
    dom: 'Bfrtip',
    ajax: {
        url: myurl + "/preparation/lists",
        type: "POST",
        data: function (d) {
            d.filter_dateCalculate = $('input[name="filter_dateCalculate"]').val();
            d.filter_OrgUnit = $('select[name="filter_OrgUnit"]').val();
        }
    },
    columns: [
        { data: "dateIn", name: "dateIn" },
        { data: "orgUnitNameDivEN", name: "orgUnorgUnitNameDivENitNameEN" },
        { data: "orgUnitNameDepEN", name: "orgUnitNameDepEN" },
        { data: "DepCode", name: "DepCode" },
        { data: "SumR", name: "SumR" },
        { data: "SumO", name: "SumO" },
        { data: "SumRR", name: "SumRR" },
        { data: "SumOO", name: "SumOO" },
        { data: "action", name: "action" },
    ],
});

$('#search-form').on('submit', function (e) {
    table.ajax.reload();
    e.preventDefault();
});


$('#form').on('submit', function (event) {
    $('.costCenter').each(function () {
        $(this).rules("add", {
            required: true,
        });
    });
    $('.accountCode').each(function () {
        $(this).rules("add", {
            required: true,
        });
    });
    $('.hoursPrice').each(function () {
        $(this).rules("add", {
            required: true,
        });
    });
});

$('#form').validate({
    rules: {
        dateCalculate: {
            required: true
        },
        OrgUnit: {
            required: true
        },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: myurl + "/preparation/check-data",
            data: {
                dateCalculate: $('input[name="dateCalculate"]').val(),
                OrgUnit: $('select[name="OrgUnit"]').val(),
            },
            dataType: "json",
            success: function (response) {
                if ($('input[name="type"]').val() == 'add') {
                    if (response.check_TimeWorking_hour > 0 && response.check_preparation == 0) {
                        $('#btn_save').empty().html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Saving...').attr('disabled', true);
                        form.submit();
                    } else {
                        if (response.check_TimeWorking_hour < 1) {
                            Swal.fire(
                                'Alert!',
                                'Data Time Working Hour Not Found!',
                                'warning'
                            )
                        }
                        if (response.check_preparation > 0) {
                            Swal.fire(
                                'Alert!',
                                'Information has been added!',
                                'warning'
                            )
                        }
                    }
                } else {
                    $('#btn_save').empty().html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Saving...').attr('disabled', true);
                    form.submit();
                }

            }
        });
    }
});

function add_data() {
    $('#modal-default .modal-title').text('Add Data');
    $('#modal-default #form').attr('action', myurl + '/preparation/update');
    $('#modal-default #form input[type="date"], #modal-default #form select').val('').removeClass('is-invalid');
    $('input[name="dateCalculate"]').attr('readonly', false);
    $('select[name="OrgUnit"] option').attr('disabled', false);
    $('input[name="type"]').val('add');
    var row = '';
    row += '<tr id="0">'
    row += '<td><div class="form-group">'
    row += '<input type="text" class="form-control costCenter" name="costCenter[0]" id="costCenter_0" placeholder="' + lang.placeholder + '" autocomplete="off">'
    row += '</div></td>'
    row += '<td><div class="form-group">'
    row += '<input type="text" class="form-control accountCode" name="accountCode[0]" id="accountCode_0" placeholder="' + lang.placeholder + '" autocomplete="off">'
    row += '</div></td>'
    row += '<td><div class="form-group">'
    row += '<input type="number" class="form-control hoursPrice" name="hoursPrice[0]" id="hoursPrice_0" placeholder="' + lang.placeholder + '" autocomplete="off">'
    row += '</div></td>'
    row += '<td align="center"><div style="margin-top: 7px">'
    row += '<a href="#" class="remove_row"><i class="fa fa-minus-circle" aria-hidden="true" style="color: red"></i></a>'
    row += '</div></td>'
    row += '</tr>'
    $('#table_detail tbody').empty().append(row);

}


function add_row() {
    var num_row = parseInt($('#table_detail tbody tr:last').attr('id')) + 1;
    var row = '';
    row += '<tr id="' + num_row + '">'
    row += '<td><div class="form-group">'
    row += '<input type="text" class="form-control costCenter" name="costCenter[' + num_row + ']" id="costCenter_' + num_row + '" placeholder="' + lang.placeholder + '" autocomplete="off">'
    row += '</div></td>'
    row += '<td><div class="form-group">'
    row += '<input type="text" class="form-control accountCode" name="accountCode[' + num_row + ']" id="accountCode_' + num_row + '" placeholder="' + lang.placeholder + '" autocomplete="off">'
    row += '</div></td>'
    row += '<td><div class="form-group">'
    row += '<input type="number" class="form-control hoursPrice" name="hoursPrice[' + num_row + ']" id="hoursPrice_' + num_row + '" placeholder="' + lang.placeholder + '" autocomplete="off">'
    row += '</div></td>'
    row += '<td align="center"><div style="margin-top: 7px">'
    row += '<a href="#" class="remove_row"><i class="fa fa-minus-circle" aria-hidden="true" style="color: red"></i></a>'
    row += '</div></td>'
    row += '</tr>'

    $('#table_detail tbody').append(row);
}

$("#table_detail").on('click', '.remove_row', function () {
    if ($('#table_detail tbody tr').length > 1) {
        $(this).parent().parent().parent().remove();
    } else {
        Swal.fire(
            'Alert!',
            'The row could not be deleted!',
            'warning'
        )
    }
});

function edit_data(dateCalculate, orgDivCode, orgDepCode) {
    $('#modal-default .modal-title').text('Edit Data');
    $('#modal-default #form').attr('action', myurl + '/preparation/update');
    $('#modal-default #form input, #modal-default #form select').removeClass('is-invalid');
    $('input[name="type"]').val('edit');
    $.ajax({
        type: "POST",
        url: myurl + '/preparation/edit',
        data: {
            dateCalculate: dateCalculate,
            orgDivCode: orgDivCode,
            orgDepCode: orgDepCode
        },
        dataType: "json",
        success: function (response) {
            $('input[name="dateCalculate"]').val(response.dateCalculate).attr('readonly', true);
            $('select[name="OrgUnit"]').val(response.OrgUnit);
            $('select[name="OrgUnit"] option:not(:selected)').attr('disabled', true);

            var row = '';
            $.each(response.preparation, function (index, item) {
                row += '<tr id="' + index + '">'
                row += '<td><div class="form-group">'
                row += '<input type="text" class="form-control costCenter" name="costCenter[' + index + ']" id="costCenter_' + index + '" placeholder="' + lang.placeholder + '" autocomplete="off" value="' + item.costCenter + '">'
                row += '</div></td>'
                row += '<td><div class="form-group">'
                row += '<input type="text" class="form-control accountCode" name="accountCode[' + index + ']" id="accountCode_' + index + '" placeholder="' + lang.placeholder + '" autocomplete="off" value="' + item.accountCode + '">'
                row += '</div></td>'
                row += '<td><div class="form-group">'
                row += '<input type="number" class="form-control hoursPrice" name="hoursPrice[' + index + ']" id="hoursPrice_' + index + '" placeholder="' + lang.placeholder + '" autocomplete="off" value="' + item.hoursPrice + '">'
                row += '</div></td>'
                row += '<td align="center"><div style="margin-top: 7px">'
                // if (index > 0) {
                row += '<a href="#" class="remove_row"><i class="fa fa-minus-circle" aria-hidden="true" style="color: red"></i></a>'
                // }
                row += '</div></td>'
                row += '</tr>'
            });

            $('#table_detail tbody').empty().append(row);
        }
    });
}

function destroy(dateCalculate, orgDivCode, orgDepCode) {
    Swal.fire({
        title: lang_action.destroy_title,
        icon: 'question',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: lang_action.destroy_yes,
        cancelButtonText: lang_action.destroy_no
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: myurl + "/preparation/destroy",
                data: {
                    dateCalculate: dateCalculate,
                    orgDivCode: orgDivCode,
                    orgDepCode: orgDepCode
                },
                success: function (data) {
                    table.ajax.reload();
                }
            });
        }
    });
}
