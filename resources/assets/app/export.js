$('input[name="date_export_tranfer_daily"]').daterangepicker({
    showDropdowns: true,
    locale: {
        format: 'DD/MM/YYYY'
    }
});
$('input[name="date_export_accrue_daily"]').daterangepicker({
    showDropdowns: true,
    locale: {
        format: 'DD/MM/YYYY'
    }
});

$('#form-tranfer-daily').validate({
    rules: {
        date_export_tranfer_daily: {
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
        $('#modal-tranfer-daily').modal('toggle');
        form.submit();
    }
});

$('#form-accrue-daily').validate({
    rules: {
        date_export_accrue_daily: {
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
        $('#modal-accrue-daily').modal('toggle');
        form.submit();
    }
});
