$(document).ready(function () {
    $('#newAddBtn').click(function () {
        var startDestination = $('#startDestination').val()
        var endDestination = $('#endDestination').val()
        var price = $('#price').val()
        var busType = $('#busType').val()
        var company = $('#company').val()
        var route = $('#route').val()
        var maxSeat = $('#maxSeat').val()
        var departureTime = $('#departureTime').val()
        var arrivalTime = $('#arrivalTime').val()

        console.log(departureTime)
        console.log(arrivalTime)

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
        } else if (maxSeat == "" || maxSeat ==0) {
            toastr.error("Please enter number of seats")
        } else if (departureTime =="") {
            toastr.error("Please enter deparute time.")
        } else if (arrivalTime =="") {
            toastr.error("Please enter arrival time.")
        } else if (arrivalTime == departureTime || arrivalTime < departureTime) {
            toastr.warning("Please enter valid time")
        } else {
            $.ajax({
                url: "bus/addNew.php?task=new&startDestination=" + startDestination + "&endDestination=" + endDestination + "&price=" + price + "&busType=" + busType + "&company=" + company + "&route=" + route+ "&maxSeat=" + maxSeat + "&departureTime=" + departureTime + "&arrivalTime=" + arrivalTime,
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