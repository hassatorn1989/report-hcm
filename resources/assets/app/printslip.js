$('#form').validate({
    rules: {
        emp_code: {
            required: true,
            remote: {
                url: myurl + '/pay-slip/print-slip/check-emp',
                type: "POST",
                data: {
                    emp_code: function () {
                        return $('input[name="emp_code"]').val();
                    }
                }
            }
        },
        pay_date: {
            required: true,
        }
    },
    messages: {
        emp_code: {
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

$(document).ready(function () {
    $('input[name="emp_code"]').keyup(function (e) {
        var option = '<option value="">' + lang_action.select + '</option>'
        if ($(this).val().length >= 6) {
            $.ajax({
                type: "POST",
                url: myurl + '/pay-slip/print-slip/get-date',
                data: {
                    emp_code: $(this).val(),
                },
                dataType: "json",
                success: function (response) {
                    $.each(response, function (index, item) {
                        option += '<option value="' + item.PayDateValue + '">' + item.PayDate + '</option>'
                    });
                    $('select[name="pay_date"]').empty().append(option);
                }
            });
        }else{
            $('select[name="pay_date"]').empty().append(option);
        }
    });

});
