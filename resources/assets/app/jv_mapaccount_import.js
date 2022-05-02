$('.select2bs4').select2({
    theme: 'bootstrap4'
})

$('#form').validate({
    rules: {
        // orgCopCode: {
        //     required: true
        // },
        OrgUnit: {
            required: true
        },
        // orgDepCode: {
        //     required: true
        // },
        // orgJobCode: {
        //     required: true
        // },
        // orgLineCode: {
        //     required: true
        // },
        accountType: {
            required: true
        },
        accountTypeName: {
            required: true
        },
        // company: {
        //     required: true
        // },
        // costCenter: {
        //     required: true
        // },
        accountCode: {
            required: true
        },
        // JDEcostCenter: {
        //     required: true
        // },
        // JDEaccountCode: {
        //     required: true
        // },
        // ioNumber: {
        //     required: true
        // },
    },
    errorElement: 'span',
    errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    },
    submitHandler: function(form) {
        $('#btn_save').empty().html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Saving...').attr('disabled', true);
        form.submit();
    }
});

var table = $("#datatable").DataTable({
    processing: true,
    serverSide: true,
    searching: false,
    pageLength: 100,
    order: [
        [1, "asc"],
        [2, "asc"],
        [3, "asc"],
        [4, "asc"]
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
        url: myurl + "/empoyee/mapaccount-import/lists",
        type: "POST",
        data: function(d) {
            d.filter_OrgUnit = $('select[name="filter_OrgUnit"]').val();
            // d.filter_orgDepCode = $('select[name="filter_orgDepCode"]').val();
            // d.filter_orgJobCode = $('input[name="filter_orgJobCode"]').val();
            // d.filter_costCenter = $('input[name="filter_costCenter"]').val();
            // d.filter_accountCode = $('input[name="filter_accountCode"]').val();
        }
    },
    columns: [
        // { data: "orgCopCode", name: "orgCopCode" },
        { data: "orgDivCode", name: "orgDivCode" },
        { data: "orgDepCode", name: "orgDepCode" },
        { data: "orgJobCode", name: "orgJobCode" },
        // { data: "orgLineCode", name: "orgLineCode" },
        { data: "accountType", name: "accountType" },
        { data: "accountTypeName", name: "accountTypeName" },
        { data: "company", name: "company" },
        { data: "costCenter", name: "costCenter" },
        { data: "accountCode", name: "accountCode" },
        // { data: "JDEcostCenter", name: "JDEcostCenter" },
        // { data: "JDEaccountCode", name: "JDEaccountCode" },
        { data: "ioNumber", name: "ioNumber" },
        { data: "action", name: "action" },
    ],
});


$('#search-form').on('submit', function(e) {
    table.ajax.reload();
    e.preventDefault();
});


function add_data() {
    $("#modal-default .modal-title").text(lang.title_add);
    $('#modal-default #form').attr('action', myurl + '/empoyee/mapaccount-import/store');
    $('#modal-default #form input[type="text"], #modal-default #form select').removeClass('is-invalid');
    $('#modal-default #form input[type="text"], #modal-default #form select').val('');
}

function edit_data(orgCopCode, orgDivCode, orgDepCode, orgJobCode, orgLineCode, accountType, accountCode) {
    $('#modal-default .modal-title').text(lang.title_edit);
    $('#modal-default #form').attr('action', myurl + '/empoyee/mapaccount-import/update');
    $('#modal-default #form input[type="text"], #modal-default #form select').removeClass('is-invalid');
    $.ajax({
        type: "POST",
        url: myurl + '/empoyee/mapaccount-import/edit',
        data: {
            orgCopCode: orgCopCode,
            orgDivCode: orgDivCode,
            orgDepCode: orgDepCode,
            orgJobCode: orgJobCode,
            orgLineCode: orgLineCode,
            accountType: accountType,
            accountCode: accountCode,
        },
        dataType: "json",
        success: function(response) {
            // console.log(response);
            $('input[name="id"]').val(response.idx);
            // $('select[name="orgCopCode"]').val(response.orgCopCode);
            $('select[name="OrgUnit"]').val(response.orgDivCode + '-' + response.orgDepCode);
            // $('select[name="orgDepCode"]').val(response.orgDepCode);
            $('input[name="orgJobCode"]').val(response.orgJobCode);
            // $('input[name="orgLineCode"]').val(response.orgLineCode);
            // $('input[name="accountType"]').val(response.accountType);
            $('select[name="accountTypeName"]').val(response.accountType + '-' + response.accountTypeName);
            // $('input[name="company"]').val(response.company);
            $('input[name="costCenter"]').val(response.costCenter);
            $('input[name="accountCode"]').val(response.accountCode);
            // $('input[name="JDEcostCenter"]').val(response.JDEcostCenter);
            // $('input[name="JDEaccountCode"]').val(response.JDEaccountCode);
            $('input[name="ioNumber"]').val(response.ioNumber);
        }
    });
}


function destroy(orgCopCode, orgDivCode, orgDepCode, orgJobCode, orgLineCode, accountType, accountCode) {
    Swal.fire({
        title: lang_action.destroy_title,
        icon: 'question',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: lang_action.destroy_yes,
        cancelButtonText: lang_action.destroy_no
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: myurl + "/empoyee/mapaccount-import/destroy",
                data: {
                    orgCopCode: orgCopCode,
                    orgDivCode: orgDivCode,
                    orgDepCode: orgDepCode,
                    orgJobCode: orgJobCode,
                    orgLineCode: orgLineCode,
                    accountType: accountType,
                    accountCode: accountCode,
                },
                success: function(data) {
                    table.ajax.reload();
                }
            });
        }
    });
}
