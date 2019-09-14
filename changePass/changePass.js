$(document).ready(function () {

    $("#newPassBtn").click(function () {
        var newPass = $("#newPass").val()
        var confirmedPass = $("#confirmedPass").val()
        var email = $('#sessionEmail').val()

        if (newPass == "") {
            toastr.error('Please enter your email address')
        } else if (confirmedPass == "") {
            toastr.error('Please enter your password')
        } else if (confirmedPass !== newPass) {
            toastr.warning("The passwords doesn't match.")
        } else {
            $.ajax({
                url: "changePass/changePass.php?task=login&email=" + email + "&password=" + newPass,
                success: function (data) {
                    if (data.indexOf('changed') > -1) {
                        toastr.success('Password changed successfully');
                        window.location.replace("index.html")
                    } else {
                        toastr.error("There are a problem, please try later.");
                    }
                },
                error: function (data, err) {
                    toastr.error('Some problem occurred. We are sorry.');
                }
            })
        }
    })

})