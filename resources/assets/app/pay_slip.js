

$('#form').validate({
    rules: {
        file_import: {
            required: true
        },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.input-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    },
    submitHandler: function (form) {
        $('#btn_import').empty().html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Please wait importing').attr('disabled', true);
        form.submit();
    }
});

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
        url: myurl + "/pay-slip/payslip/lists",
        type: "POST",
    },
    columns: [
        { data: "EmpCode", name: "EmpCode" },
        { data: "EmpName", name: "EmpName" },
        { data: "EmpNameEng", name: "EmpNameEng" },
        { data: "EmpType", name: "EmpType" },
        { data: "PositionCode", name: "PositionCode" },
        { data: "PositionName", name: "PositionName" },
        { data: "PositionNameEng", name: "PositionNameEng" },
        { data: "OrgUnitCode", name: "OrgUnitCode" },
        { data: "OrgUnitName", name: "OrgUnitName" },
    ],
});
