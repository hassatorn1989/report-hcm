// $('input[name="filter_date"]').daterangepicker({
//     startDate: moment().subtract('days', 29),
//     endDate: moment(),
// });
$('#date_filter').daterangepicker({
    showDropdowns: true,
    locale: {
        format: 'DD/MM/YYYY'
    }
})

$('input[name="date_calculate"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    locale: {
        format: 'DD/MM/YYYY'
    }
});

$('#form').validate({
    rules: {
        date_calculate: {
            required: true,
            remote: myurl + '/jv-tranfer/report-tranfer-daily-check'
        },
    },
    messages: {
        date_calculate: {
            remote: "Repeat date"
        }
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
        $('#btn_save').empty().html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Saving...').attr('disabled', true);
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
        'copy', 'csv', 'excel',  'print'
    ],
    dom: 'Bfrtip',
    ajax: {
        url: myurl + "/jv-tranfer/report-tranfer-daily-lists",
        type: "POST",
        data: function (d) {
            d.date_filter = $('input[name="date_filter"]').val();
        }
    },
    columns: [
        { data: "transferDate", name: "transferDate" },
        { data: "orgCopCode", name: "orgCopCode" },
        { data: "orgDivCode", name: "orgDivCode" },
        { data: "orgDepCode", name: "orgDepCode" },
        { data: "amtHour", name: "amtHour" },
        { data: "amtWage", name: "amtWage" },
        { data: "costCenter", name: "costCenter" },
        { data: "ioNumber", name: "ioNumber" },
        { data: "accountCode", name: "accountCode" },
        { data: "jvReferance", name: "jvReferance" },
        { data: "isActive", name: "isActive" },
    ],
});

$('#search-form').on('submit', function (e) {
    table.ajax.reload();
    e.preventDefault();
});
