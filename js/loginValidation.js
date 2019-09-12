$(document).ready(function () {

    $("#submitBtn").click(function () {
        var loginEmail = $("#email").val()
        var loginPass = $("#password").val()

        function validateEmail($loginEmail) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test($loginEmail);
        }

        if (loginEmail == "") {
            toastr.error('Please enter your email address')
        } else if (!validateEmail(loginEmail)) {
            toastr.warning('Please enter a valid email address')
        } else if (loginPass == "") {
            toastr.error('Please enter your password')
        } else {
            $.ajax({
                url: "sign/login.php?task=login&email=" + loginEmail + "&password=" + loginPass,
                success: function (data) {
                    if (data.indexOf('sentAdmin') > -1) {
                        toastr.success('Admin successfully logged in.');
                        window.location.replace("admin.php")
                    } else if (data.indexOf('sentUser') > -1) {
                        toastr.success('User successfully logged in.');
                        window.location.replace("user.html")
                    } else if (data.indexOf('pass') > -1) {
                        toastr.error('Password is incorrect');
                    } else if (data.indexOf('mail') > -1) {
                        toastr.error("Email doesn't exists");
                    } else {
                        toastr.error("Email doesn't exists");
                    }
                },
                error: function (data, err) {
                    toastr.error('Some problem occurred. We are sorry.');
                }
            })
        }
    })

})