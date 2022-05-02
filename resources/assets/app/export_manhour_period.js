// $('input[name="date_export_tranfer_daily"]').daterangepicker({
//     showDropdowns: true,
//     locale: {
//         format: 'DD/MM/YYYY'
//     }
// });

$('input[name="date_post"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    locale: {
        format: 'DD/MM/YYYY'
    }
});

// $('#form-tranfer-daily').validate({
//     rules: {
//         date_export_tranfer_daily: {
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
//         $('#modal-tranfer-daily').modal('toggle');
//         form.submit();
//     }
// });

var table = $("#datatable").DataTable({
    processing: true,
    serverSide: true,
    searching: false,
    pageLength: 100,

    // order: [
    //     [0, "asc"]
    // ],
    // buttons: [
    //     'copy', 'csv', 'excel', 'print'
    // ],
    // dom: 'Bfrtip',
    ajax: {
        url: myurl + "/export/manhour-period-lists",
        type: "POST",
        data: function(d) {
            d.filter_year = $('select[name="filter_year"]').val();
            d.filter_period = $('select[name="filter_period"]').val();
            d.filter_round = $('select[name="filter_round"]').val();
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


$('.select_filter_period').change(function(e) {
    table.ajax.reload();
});

$('input[name="date_post"]').change(function(e) {
    table.ajax.reload();
});
