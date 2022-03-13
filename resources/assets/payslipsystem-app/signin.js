$('#form_print').validate({
    rules: {
        emp_code_print: {
            required: true,
            remote: {
                url: myurl + '/check-emp',
                type: "POST",
                data: {
                    emp_code_print: function () {
                        return $('input[name="emp_code_print"]').val();
                    }
                }
            }
        },
    },
    messages: {
        emp_code_print: {
            remote: "Employee information not found"
        }
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

        $('#btn_print').empty().html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Printing').attr('disabled', true);
        form.submit();
    }
});


$('#form').validate({
    rules: {
        emp_code: {
            required: true,
        },
        birth_date: {
            required: true,
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
        $('#btn_login').empty().html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loging in').attr('disabled', true);
        form.submit();
    }
});

