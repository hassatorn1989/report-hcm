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
    buttons: [
        'copy', 'csv', 'excel', 'print'
    ],
    dom: '<"float-left" l><"float-right mb-2"B>rt<"row"<"col-sm-4"i><"col-sm-4"><"col-sm-4"p>>',
    "lengthMenu": [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "All"]
    ],
    ajax: {
        url: myurl + "/jv-tranfer/time-flap-gate-lists",
        type: "POST",
        data: function (d) {
            d.date_filter = $('input[name="date_filter"]').val();
        }
    },
    columns: [
        { data: "EmpID", name: "EmpID" },
        { data: "DateTime", name: "DateTime" },
        { data: "Date", name: "Date" },
        { data: "Time", name: "Time" },
        { data: "MachineNo", name: "MachineNo" },
        { data: "MachineType", name: "MachineType" },
        { data: "InOut", name: "InOut" },
        { data: "IsError", name: "IsError" },
        { data: "IsInterface", name: "IsInterface" },
    ],
});

$('#search-form').on('submit', function (e) {
    table.ajax.reload();
    e.preventDefault();
});
