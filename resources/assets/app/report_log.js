
var table = $("#datatable").DataTable({
    processing: true,
    serverSide: true,
    searching: false,
    order: [
        [0, "asc"]
    ],
    dom: '<"float-left"><"float-right"f>rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>',
    ajax: {
        url: myurl + "/report/log/lists",
        type: "POST",
        data: function (d) {
            d.filter_full_name = $('input[name="filter_full_name"]').val();
        }
    },
    columns: [
        { data: null, sortable: false, searchable: false, className: "text-center" },
        { data: "menu_name", name: "menu_name" },
        { data: "log_description", name: "log_description" },
        { data: "log_datetime", name: "log_datetime" },
        { data: "full_name", name: "full_name" },
    ],
    fnRowCallback: function (nRow, aData, iDisplayIndex) {
        var info = $(this)
            .DataTable()
            .page.info();
        $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
        return nRow;
    }
});
