//Bootstrap Duallistbox
$('.duallistbox').bootstrapDualListbox()

var table = $("#datatable").DataTable({
    processing: true,
    serverSide: true,
    searching: false,
    order: [
        [0, "asc"]
    ],
    dom: '<"float-left"><"float-right"f>rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>',
    ajax: {
        url: myurl + "/setting/user/lists",
        type: "POST",
        data: function (d) {
            d.filter_full_name = $('input[name="filter_full_name"]').val();
        }
    },
    columns: [
        { data: null, sortable: false, searchable: false, className: "text-center" },
        { data: "full_name", name: "full_name" },
        { data: "user_role", name: "user_role" },
        { data: "hr_role", name: "hr_role" },
        { data: "action", name: "action", orderable: false, searchable: false, className: "text-right" }
    ],
    fnRowCallback: function (nRow, aData, iDisplayIndex) {
        var info = $(this)
            .DataTable()
            .page.info();
        $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
        return nRow;
    }
});

$('#search-form').on('submit', function (e) {
    table.ajax.reload();
    e.preventDefault();
});

$('#form').validate({
    ignore: ".ignore",
    rules: {
        empCode: {
            required: true
        },
        user_name: {
            required: true
        },
        user_last: {
            required: true
        },
        username: {
            required: true
        },
        password: {
            required: true
        },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    },
    submitHandler: function (form) {
        $('#btn_save').empty().html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Saving...').attr('disabled', true);
        form.submit();
    }
});


$('#form-user-role').validate({
    ignore: ".ignore",
    rules: {
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    },
    submitHandler: function (form) {
        $('#btn_save_user_role').empty().html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Saving...').attr('disabled', true);
        form.submit();
    }
});

function add_data() {
    $("#modal-default .modal-title").text(lang.title_add);
    $('#modal-default #form').attr('action', myurl + '/setting/user/store');
    $('#modal-default #form input[type="text"], #modal-default #form input[type="password"], #modal-default #form select').removeClass('is-invalid');
    $('#modal-default #form input[type="text"], #modal-default #form input[type="password"], #modal-default #form select').val('');
    $('input[name="password"]').removeClass('ignore');
}

function edit_data(id) {
    $('#modal-default .modal-title').text(lang.title_edit);
    $('#modal-default #form').attr('action', myurl + '/setting/user/update');
    $('#modal-default #form input[type="text"], #modal-default #form input[type="password"], #modal-default #form select').removeClass('is-invalid');
    $('input[name="password"]').addClass('ignore');
    $.ajax({
        type: "POST",
        url: myurl + '/setting/user/edit',
        data: {
            id: id
        },
        dataType: "json",
        success: function (response) {
            $('input[name="id"]').val(response.idx);
            $('input[name="empCode"]').val(response.empCode);
            $('input[name="user_name"]').val(response.user_name);
            $('input[name="user_last"]').val(response.user_last);
            $('input[name="username"]').val(response.username);
            var user_role_checked = (response.user_role  == 'admin') ? true : false;
            $('input[name="user_role"]').prop('checked', user_role_checked);
            var hr_role_checked = (response.hr_role  == 'yes') ? true : false;
            $('input[name="hr_role"]').prop('checked', hr_role_checked);
        }
    });
}

function destroy(id) {
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
                url: myurl + "/setting/user/destroy",
                data: {
                    id: id
                },
                success: function (data) {
                    table.ajax.reload();
                    // const Toast = Swal.mixin({
                    //     toast: true,
                    //     position: 'top-end',
                    //     showConfirmButton: false,
                    //     timer: 3000
                    // });
                    // Toast.fire({
                    //     icon: 'success',
                    //     title: lang_action.delete_success
                    // })
                }
            });
        }
    });
}

function get_role(id) {
    $('input[name="user_id"]').val(id);
    $.ajax({
        type: "POST",
        url: myurl + "/setting/user/get-role",
        data: {
            id: id
        },
        success: function (data) {
            console.log(data);
            $.each(data, function (index, value) {
                var option = '';
                $.each(value.get_sub_menu, function (index2, value2) {
                    var selected = (value2.user_role > 0) ?'selected' : '';
                    option += '<option value="' + value2.id + '" ' + selected+'>' + value2.menu_name + '</option>';
                });
                $('#menu_' + value.id).empty().append(option).bootstrapDualListbox('refresh', true);;
            });
        }
    });
 }
