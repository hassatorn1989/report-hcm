$(function () {
    $(document).ready(function () {
        bsCustomFileInput.init();
        // $('#form').ajaxForm({
        //     beforeSubmit: function () {

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
        //         window.location.reload();
        //     }
        // });
    });
});


$('#form').validate({
    rules: {
        file_import: {
            required: true,
            // remote: {
            //     url: myurl + '/personal/check-personal-code',
            //     type: 'POST',
            //     data: {
            //         personal_code: function () {
            //             return $('input[name="personal_code"]').val();
            //         },
            //         personal_code_check: function () {
            //             return $('input[name="personal_code_check"]').val();
            //         }
            //     },
            // }
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
    dom: 'Bfrtip',
    ajax: {
        url: myurl + "/jv-tranfer/import-file3/lists",
        type: "POST",
        data: function (d) {
            d.date_filter = $('input[name="date_filter"]').val();
        }
    },
    columns: [
        { data: "orgCopCode", name: "orgCopCode" },
        { data: "empCode", name: "empCode" },
        { data: "accountType", name: "accountType" },
        { data: "shiftType", name: "shiftType" },
        { data: "dateIn", name: "dateIn" },
        { data: "timeIn", name: "timeIn" },
        { data: "dateOut", name: "dateOut" },
        { data: "timeOut", name: "timeOut" },
        { data: "workHour", name: "workHour" },
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
