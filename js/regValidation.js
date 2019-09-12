$(document).ready(function () {

    $("#submitBtn").click(function () {
        var regEmail = $("#email").val()
        var regFullName = $("#fullName").val()
        var regPass = $("#password").val()

        function validateEmail($regEmail) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test($regEmail);
        }

        if (regEmail == "") {
            toastr.error('Please enter your email address')
        } else if (!validateEmail(regEmail)) {
            toastr.warning('Please enter a valid email address')
        } else if (regFullName == "") {
            toastr.error('Please enter your name')
        } else if (regPass == "") {
            toastr.error('Please enter your password')
        } else {
            $.ajax({
                url: "sign/reg.php?task=register&email=" + regEmail + "&fullName=" + regFullName + "&password=" + regPass,
                success: function (data) {
                    if (data.indexOf('sent') > -1) {
                        toastr.success('Your account created successfully.');
                        $('#email').val("");
                        $('#fullName').val("");
                        $('#password').val("")
                    } else {
                        toastr.error('Email address already exists.');
                    }
                },
                error: function (data, err) {
                    toastr.error('Some problem occurred. We are sorry.');
                }
            })
        }
    })

})