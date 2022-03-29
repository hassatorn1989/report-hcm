$(function () {
    $(document).ready(function () {
        bsCustomFileInput.init();
        // $('#form').ajaxForm({
        //     beforeSubmit: function () {
        //         $('#form').validate({
        //             rules: {
        //                 file_import: {
        //                     required: true
        //                 },
        //             },
        //             errorElement: 'span',
        //             errorPlacement: function (error, element) {
        //                 error.addClass('invalid-feedback');
        //                 element.closest('.input-group').append(error);
        //             },
        //             highlight: function (element, errorClass, validClass) {
        //                 $(element).addClass('is-invalid');
        //             },
        //             unhighlight: function (element, errorClass, validClass) {
        //                 $(element).removeClass('is-invalid');
        //             },
        //         });
        //         return $('#form').valid();
        //     },
        //     beforeSend: function () {
        //         var percentage = '0';
        //         $('#btn_import').empty().html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Please wait importing').attr('disabled', true);
        //     },
        //     uploadProgress: function (event, position, total, percentComplete) {
        //         // console.log(position);
        //         var percentage = percentComplete;
        //         $('.progress .progress-bar').css("width", percentage + '%', function () {
        //             return $(this).attr("aria-valuenow", percentage) + "%";
        //         })
        //         $('#percentage').text(percentage + '%');
        //     },
        //     complete: function (xhr) {
        //         // console.log('File has uploaded');
        //         window.location.reload();
        //     }
        // });
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
        'copy', 'csv', 'excel',  'print'
    ],
    dom: '<"float-left" l><"float-right mb-2"B>rt<"row"<"col-sm-4"i><"col-sm-4"><"col-sm-4"p>>',
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    ajax: {
        url: myurl + "/jv-payroll/payroll-import/lists",
        type: "POST",
        data: function (d) {
            d.date_filter = $('input[name="date_filter"]').val();
        }
    },
    columns: [
        { data: "payrollDate", name: "payrollDate" },
        { data: "orgCopCode", name: "orgCopCode" },
        { data: "orgDivCode", name: "orgDivCode" },
        { data: "orgDepCode", name: "orgDepCode" },
        { data: "costCenter", name: "costCenter" },
        { data: "accountCode", name: "accountCode" },
        { data: "docNumber", name: "docNumber" },
        { data: "amtHour", name: "amtHour" },
        { data: "amtWage", name: "amtWage" },
        { data: "jvReferance", name: "jvReferance" },
    ],
});

$('#search-form').on('submit', function (e) {
    table.ajax.reload();
    e.preventDefault();
});

$('#date_filter').daterangepicker({
    showDropdowns: true,
    locale: {
        format: 'DD/MM/YYYY'
    }
})
