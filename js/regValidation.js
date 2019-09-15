$(document).ready(function () {

    $("#submitBtn").click(function () {
        var regEmail = $("#email").val()
        var regFullName = $("#fullName").val()
        var regPass = $("#password").val()
        var repeatPass = $('#repeatPass').val()

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
        } else if (repeatPass == "") {
            toastr.error('Please re-enter your password')
        } else if (regPass != repeatPass) {
            toastr.warning('Passwords are not same')
        } else {
            $.ajax({
                url: "sign/reg.php?task=register&email=" + regEmail + "&fullName=" + regFullName + "&password=" + regPass,
                success: function (data) {
                    if (data.indexOf('sent') > -1) {
                        toastr.success('Your account created successfully.');
                        $('#email').val("");
                        $('#fullName').val("");
                        $('#password').val("")
                        $('#repeatPass').val("")
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