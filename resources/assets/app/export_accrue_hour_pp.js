$('input[name="date_export"]').daterangepicker({
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
        url: myurl + "/export/accrue-hour-pp-lists",
        type: "POST",
        data: function (d) {
            d.date_export = $('input[name="date_export"]').val();
        }
    },
    columns: [
        { data: "costCenter", name: "costCenter" },
        { data: "ActivityType", name: "ActivityType" },
        { data: "date_from", name: "date_from" },
        { data: "date_to", name: "date_to" },
        { data: "Flag", name: "Flag" },
        { data: "amtHour", name: "amtHour" },
    ],
});

$('input[name="date_export"]').change(function (e) {
    table.ajax.reload();
});
