$('#form').validate({
    rules: {
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
        $('#btn_login').empty().html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Logging in').attr('disabled', true);
        form.submit();
    }
});
