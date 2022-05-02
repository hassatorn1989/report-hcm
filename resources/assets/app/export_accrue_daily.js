$('input[name="date_export_accrue_daily"]').daterangepicker({
    showDropdowns: true,
    locale: {
        format: 'DD/MM/YYYY'
    }
});

$('input[name="date_post"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    locale: {
        format: 'DD/MM/YYYY'
    }
});

// $('#form-accrue-daily').validate({
//     rules: {
//         date_export_accrue_daily: {
//             required: true,
//         },
//         date_post: {
//             required: true,
//         },
//     },
//     errorElement: 'span',
//     errorPlacement: function (error, element) {
//         error.addClass('invalid-feedback');
//         element.closest('.form-group').append(error);
//     },
//     highlight: function (element, errorClass, validClass) {
//         $(element).addClass('is-invalid');
//     },
//     unhighlight: function (element, errorClass, validClass) {
//         $(element).removeClass('is-invalid');
//     },
//     submitHandler: function (form) {
//         $('#modal-accrue-daily').modal('toggle');
//         form.submit();
//     }
// });


var table = $("#datatable").DataTable({
    processing: true,
    serverSide: true,
    searching: false,
    pageLength: 100,

    order: [
        [0, "asc"]
    ],
    // buttons: [
    //     'copy', 'csv', 'excel', 'print'
    // ],
    // dom: 'Bfrtip',
    ajax: {
        url: myurl + "/export/accrue-daily-lists",
        type: "POST",
        data: function(d) {
            d.date_export_accrue_daily = $('input[name="date_export_accrue_daily"]').val();
            d.date_post = $('input[name="date_post"]').val();
        }
    },
    columns: [
        { data: "NO", name: "NO" },
        { data: "BUKRS", name: "BUKRS" },
        { data: "XBLNR", name: "XBLNR" },
        { data: "BLART", name: "BLART" },
        { data: "BKTXT", name: "BKTXT" },
        { data: "BLDAT", name: "BLDAT" },
        { data: "BUDAT", name: "BUDAT" },
        { data: "BSCHL", name: "BSCHL" },
        { data: "SAKNR", name: "SAKNR" },
        { data: "WAERS", name: "WAERS" },
        { data: "WRBTR", name: "WRBTR" },
        { data: "SHKZG", name: "SHKZG" },
        { data: "AUFNR", name: "AUFNR" },
        { data: "KOSTL", name: "KOSTL" },
        // { data: "ZUONR", name: "ZUONR" },
        // { data: "SGTXT", name: "SGTXT" },
        // { data: "MEINS", name: "MEINS" },
        // { data: "MENGE", name: "MENGE" },
    ],
});

// $('#search-form').on('submit', function (e) {
//     table.ajax.reload();
//     e.preventDefault();
// });

$('input[name="date_export_accrue_daily"]').change(function(e) {
    table.ajax.reload();
});

$('input[name="date_post"]').change(function(e) {
    table.ajax.reload();
});
