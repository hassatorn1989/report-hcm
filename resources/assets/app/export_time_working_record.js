

$('input[name="date_filter"]').daterangepicker({
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
    ajax: {
        url: myurl + "/export-as400/time-working-record-lists",
        type: "POST",
        data: function (d) {
            d.date_filter = $('input[name="date_filter"]').val();
        }
    },
    columns: [
        { data: "SCO", name: "SCO" },
        { data: "SID", name: "SID" },
        { data: "SDTE", name: "SDTE" },
        { data: "STME", name: "STME" },
        { data: "SMNO", name: "SMNO" },
        { data: "STY", name: "STY" },
        { data: "SFAG", name: "SFAG" },
    ],
});

$('input[name="date_filter"]').change(function (e) {
    table.ajax.reload();
});

