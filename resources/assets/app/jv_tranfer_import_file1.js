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

var table2 = $("#datatable1").DataTable({
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
    // dom: '<"dt-top-container"<l><"dt-center-in-div"B><f>r>t<"dt-filter-spacer"f><ip>',
    dom: '<"float-left" l><"float-right mb-2"B>rt<"row"<"col-sm-4"i><"col-sm-4"><"col-sm-4"p>>',
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],

    ajax: {
        url: myurl + "/empoyee/import-file1/lists1",
        type: "POST",
    },
    columns: [
        { data: "orgCopCode", name: "orgCopCode" },
        { data: "empCode", name: "empCode" },
        { data: "titleNameEN", name: "titleNameEN" },
        { data: "firstNameEN", name: "firstNameEN" },
        { data: "lastNameEN", name: "lastNameEN" },
        { data: "titleNameTH", name: "titleNameTH" },
        { data: "firstNameTH", name: "firstNameTH" },
        { data: "lastNameTH", name: "lastNameTH" },
        { data: "orgDivCode", name: "orgDivCode" },
        { data: "orgDepCode", name: "orgDepCode" },
        { data: "orgJobCode", name: "orgJobCode" },
        { data: "orgLineCode", name: "orgLineCode" },
        { data: "addressLine1", name: "addressLine1" },
        { data: "addressLine2", name: "addressLine2" },
        { data: "addressLine3", name: "addressLine3" },
        { data: "postCode", name: "postCode" },
        { data: "SSNO", name: "SSNO" },
        { data: "IDCard", name: "IDCard" },
        { data: "mobile", name: "mobile" },
        { data: "birthDate", name: "birthDate" },
        { data: "dateFr", name: "dateFr" },
        { data: "dateSt", name: "dateSt" },
        { data: "dateEx", name: "dateEx" },
        { data: "sex", name: "sex" },
        { data: "empStatus", name: "empStatus" },
        { data: "levelCode", name: "levelCode" },
        { data: "positinCode", name: "positinCode" },
        { data: "paymentBank", name: "paymentBank" },
        { data: "busRate", name: "busRate" },
        { data: "pregnantFlag", name: "pregnantFlag" },
        { data: "religion", name: "religion" },
        { data: "nationality", name: "nationality" },
    ],
});

var table2 = $("#datatable2").DataTable({
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
        url: myurl + "/empoyee/import-file1/lists2",
        type: "POST",
    },
    columns: [
        { data: "orgCopCode", name: "orgCopCode" },
        { data: "empCode", name: "empCode" },
        { data: "empRate", name: "empRate" },
    ],
});
