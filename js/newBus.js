$(document).ready(function () {
    $('#newAddBtn').click(function () {
        var startDestination = $('#startDestination').val()
        var endDestination = $('#endDestination').val()
        var price = $('#price').val()
        var busType = $('#busType').val()
        var company = $('#company').val()
        var route = $('#route').val()

        if (startDestination == "") {
            toastr.error("Please enter the start destination")
        } else if (endDestination == "") {
            toastr.error("Please enter the end destination")
        } else if (price == "" || price == 0) {
            toastr.error("Please enter the ticket price")
        } else if (busType == "") {
            toastr.error("Please enter the bus type")
        } else if (company == "") {
            toastr.error("Please enter the company name")
        } else if (route == "") {
            toastr.error("Please enter the driving route")
        } else {
            $.ajax({
                url: "bus/addNew.php?task=new&startDestination=" + startDestination + "&endDestination=" + endDestination + "&price=" + price + "&busType=" + busType + "&company=" + company + "&route=" + route,
                success: function (data) {
                    if (data.indexOf('sent') > -1) {
                        toastr.success('New bus added successfully')
                        $('#form').collapse('hide')
                    } else {
                        toastr.error("There are a problem. Please try later");
                    }
                },
                error: function (data, err) {
                    toastr.error('Some problem occurred. We are sorry.');
                }
            })
        }
    })
})