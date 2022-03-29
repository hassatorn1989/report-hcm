$(function () {
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
});

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
    dom: '<"float-left" l><"float-right mb-2"B>rt<"row"<"col-sm-4"i><"col-sm-4"><"col-sm-4"p>>',
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    ajax: {
        url: myurl + "/jv-payroll/import-file6/lists",
        type: "POST",
        data: function (d) {
            d.filter_year = $('select[name="filter_year"]').val();
            d.filter_period = $('select[name="filter_period"]').val();
            d.filter_round = $('select[name="filter_round"]').val();
        }
    },
    columns: [
        // { data: "transferDate", name: "transferDate" },
        { data: "orgCopCode", name: "orgCopCode" },
        { data: "orgDivCode", name: "orgDivCode" },
        { data: "orgDepCode", name: "orgDepCode" },
        { data: "empCode", name: "empCode" },
        { data: "year", name: "year" },
        { data: "period", name: "period" },
        { data: "round", name: "round" },
        { data: "accountType", name: "accountType" },
        { data: "leaveHour", name: "leaveHour" },
        { data: "leaveAmount", name: "leaveAmount" },
    ],
});

$('#search-form').on('submit', function (e) {
    table.ajax.reload();
    e.preventDefault();
});
