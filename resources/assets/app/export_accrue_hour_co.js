$('input[name="date_export"]').daterangepicker({
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
        url: myurl + "/export/accrue-hour-co-lists",
        type: "POST",
        data: function (d) {
            d.date_export = $('input[name="date_export"]').val();
            d.date_post = $('input[name="date_post"]').val();
            d.co_type = $('select[name="co_type"]').val();
        }
    },
    columns: [
        { data: "controllingArea", name: "controllingArea" },
        { data: "documentDate", name: "documentDate" },
        { data: "posingDate", name: "posingDate" },
        { data: "documentText", name: "documentText" },
        { data: "costCenter", name: "costCenter" },
        { data: "skf", name: "skf" },
        { data: "quantity", name: "quantity" },
        { data: "text", name: "text" },
    ],
});


$('input[name="date_export"]').change(function (e) {
    table.ajax.reload();
});

$('input[name="date_post"]').change(function (e) {
    table.ajax.reload();
});

$('select[name="co_type"]').change(function (e) {
    table.ajax.reload();
});
