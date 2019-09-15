<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bus station - Admin panel</title>
    <meta name="description" content="Bus station...">
    <meta name="keyword" content="bus, station, bus station, gras, centrotrans">

    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/logo.ico" type="image/x-icon">

    <script src="https://kit.fontawesome.com/4dd2b4255f.js"></script>

    <link rel="stylesheet" href="toastr.scss">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="admin.php">Bus station</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <span style="color: #0066ff"><?php echo $_SESSION["email"]; ?></span>
                </li>
                <li class="nav-item mx-2">
                    <a href="#" data-toggle="modal" data-target="#changePass"><i class="fas fa-users-cog"></i></a>
                </li>
            </ul>

            <a href="logout.php">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Logout</button>
            </a>
        </div>
    </nav>

    <section id="jumbotron" class="jumbotron jumbotron-fluid text-white d-flex justify-content-center align-items-center">
        <div class="container text-center">
            <h1 class="display-1 text-white text-uppercase">BUS STATION</h1>
        </div>
    </section>

    <div class="modal fade" id="changePass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="newPass">Enter a new password</label>
                    <input type="password" id="newPass" name="newPass" class="form-control">
                    <label for="confirmedPass">Re-enter your new password</label>
                    <input type="password" name="confirmedPass" id="confirmedPass" class="form-control">

                    <input type="text" id="sessionEmail" hidden value="<?php echo $_SESSION['email'] ?>">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="newPassBtn">Change</button>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-4 offset-2">
                    <?php
                    require 'connection/connect.php';

                    $sql = "SELECT * FROM bus";
                    $result = $dbc->query($sql);

                    $count = $result->num_rows;

                    echo '<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
  <div class="card-header text-center">No. of buses</div>
  <div class="card-body">
    <h5 class="card-title text-center">' . $count . '</h5>
  </div>
</div>';

                    ?>
                </div>
                <div class="col-6">
                    <?php

                    $sql = "SELECT * FROM register";
                    $result = $dbc->query($sql);

                    $count = $result->num_rows;

                    echo '<div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
  <div class="card-header text-center">No. of users</div>
  <div class="card-body">
    <h5 class="card-title text-center">' . $count . '</h5>
  </div>
</div>';

                    ?>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary" id="addBtn" data-toggle="collapse" data-target="#form">Add new
                    bus <i class="fas fa-plus-circle ml-2"></i></button>
            </div>
            <div class="col-12">
                <div class="collapse" id="form">
                    <form class="mt-2" id="newBusForma">
                        <input type="text" name="startDestination" id="startDestination" placeholder="Start destination" class="form-control">
                        <input type="text" name="endDestination" id="endDestination" placeholder="End destination" class="form-control mt-2">
                        <input type="number" name="price" id="price" class="form-control my-2" placeholder="Ticket price">
                        <input type="text" name="busType" id="busType" placeholder="Bus type" class="form-control">
                        <input type="text" name="company" id="company" placeholder="Company" class="form-control my-2">
                        <input type="text" name="route" id="route" placeholder="Route" class="form-control mb-2">

                        <input type="number" name="maxSeat" id="maxSeat" placeholder="No. of seats" class="form-control mb-2">  

                        <input type="time" name="departureTime" id="departureTime" class="form-control mb-2">
                        <input type="time" name="arrivalTime" id="arrivalTime" class="form-control mb-2">

                        <button type="button" class="btn btn-success" id="newAddBtn">Add</button>
                        <button type="reset" class="btn btn-danger" id="newCancelBtn">Clear</button>
                    </form>
                </div>
            </div>
            <div class="col-12">

                <?php

                $sql = "SELECT * FROM bus";
                $result = $dbc->query($sql);

                $count = $result->num_rows;

                if ($count > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                        <form method="post" action="delete/delete.php">
                            <div class="card mt-2">
                                <input type="text" value=" ' . $row["ID"] . ' "  name="busID" id="busID" hidden>
                                <h5 class="card-header">' . $row['busType'] . '</h5>
                                <div class="card-body">
                                    <h5 class="card-title">' . $row['company'] . '</h5>
                                        <ul>
                                            <li>Start destination: ' . $row['startDestination'] . '</li>
                                            <li>End destination: ' . $row['endDestination'] . '</li>
                                            <li>Driving route: ' . $row['route'] . '</li>
                                            <li>Number of seats: ' . $row['maxSeat'] . '</li>
                                            <li>Price ticket: ' . $row['price'] . '</li>
                                            <li>Departure time: ' . date_format(date_create($row['departureTime']), "H:i") . '</li>
                                            <li>Arrival time: ' .  date_format(date_create($row['arrivalTime']), "H:i") . '</li>
                                        </ul>
                                        <button class="btn btn-danger" id="remove" type="submit">Remove</button>
                                        <button type="button" class=" btn btn-warning " data-toggle="collapse" data-target="#update' . $row["ID"] . '">Edit</button>
                                </div>
                            </div>
                            </form>
                            
                            
<div class="collapse mt-3" id="update' . $row["ID"] . '">
                      <div class="card card-body">
                         <div class="container">
                             <div class="row">
                             <input type="number" value="' . $row["ID"] . '" id="idUpdate" hidden>
                                 <div class="col-12">
                                     <label for="name">Start destination: </label>
                                     <input type="text" class="form-control" id="startUpdate' . $row["ID"] . '" name="name" value="' . $row["startDestination"] . '">
                                 </div>
                                 <div class="col-12">
                                     <label for="description">End destination: </label>
                                     <input type="text" class="form-control" id="endUpdate' . $row["ID"] . '" name="description" value="' . $row["endDestination"] . '">
                                 </div>
                                 <div class="col-12">
                                     <label for="link">Price: </label>
                                     <input type="text" class="form-control" id="priceUpdate' . $row["ID"] . '" name="link" value="' . $row["price"] . '">
                                 </div>
                                 <div class="col-12">
                                     <label for="link">Bus type: </label>
                                     <input type="text" class="form-control" id="busTypeUpdate' . $row["ID"] . '" name="link" value="' . $row["busType"] . '">
                                 </div>
                                 <div class="col-12">
                                     <label for="link">Company: </label>
                                     <input type="text" class="form-control" id="companyUpdate' . $row["ID"] . '" name="link" value="' . $row["company"] . '">
                                 </div>
                                 <div class="col-12">
                                     <label for="link">Driving route: </label>
                                     <input type="text" class="form-control" id="routeUpdate' . $row["ID"] . '" name="link" value="' . $row["route"] . '">
                                 </div>
                                 <div class="col-12">
                                     <label for="link">Maximum seat: </label>
                                     <input type="text" class="form-control" id="maxUpdate' . $row["ID"] . '" name="link" value="' . $row["maxSeat"] . '">
                                 </div>
                                 <div class="col-12">
                                     <label for="link">Departure time: </label>
                                     <input type="time" class="form-control" id="departureUpdate' . $row["ID"] . '" name="link" value="' . date_format(date_create($row['departureTime']), "H:i") . '">
                                 </div>
                                 <div class="col-12">
                                     <label for="link">Arrival Time: </label>
                                     <input type="time" class="form-control" id="arrivalUpdate' . $row["ID"] . '" name="link" value="' . date_format(date_create($row['arrivalTime']), "H:i") . '">
                                 </div>
                                 <div class="col-12 mt-2">
                                     <button class="btn btn-success " id="edit' . $row["ID"] . '" onclick="edit(this.id)">Edit</button>
                                 </div>
                             </div>
                         </div>
                      </div>
                  </div>
                            ';
                    }
                } else {
                    echo "There are no buses.";
                }
                $dbc->close();
                ?>

            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="toastr.js"></script>
    <script src="js/newBus.js"></script>
    <script src="changePass/changePass.js"></script>

    <script>
        function edit(idClick) {
            console.log(idClick)
            var res = idClick.replace(/\D/g, "")
            var start = $('#startUpdate' + res).val()
            var end = $('#endUpdate' + res).val()
            var price = $('#priceUpdate' + res).val()
            var busType = $('#busTypeUpdate' + res).val()
            var company = $('#companyUpdate' + res).val()
            var route = $('#routeUpdate' + res).val()
            var maxSeat = $('#maxUpdate' + res).val()
            var departureTime = $('#departureUpdate' + res).val()
            var arrivalTime = $('#arrivalUpdate' + res).val()



            console.log(res)




            if (start == "") {
                toastr.error("Enter start destination");
            } else if (end == '') {
                toastr.error("Enter end destination")
            } else if (price == "") {
                toastr.error("Enter ticket's price")
            } else if (busType == "") {
                toastr.error("Enter bus type")
            } else if (company == "") {
                toastr.error("Enter the company")
            } else if (route == "") {
                toastr.error("Enter the driving route")
            } else if (maxSeat == "") {
                toastr.error("Enter number of seat")
            } else if (departureTime == "") {
                toastr.error("Enter departure time.")
            } else if (arrivalTime == "") {
                toastr.error("Enter arrival time")
            } else if (arrivalTime < departureTime) {
                toastr.warning("Enter valid time")
            } else {
                $.ajax({
                    url: "update.php?start=" + start + "&end=" + end + "&price=" + price + "&ID=" + res + "&busType=" + busType + "&company=" + company + "&route=" + route + "&maxSeat=" + maxSeat + "&departureTime="+departureTime+ "&arrivalTime=" +arrivalTime,

                    success: function(data) {
                        if (data.indexOf('changed') > -1) {
                            toastr.success("Successfully updated!")
                            $('#startUpdate' + res).val("")
                            $('#endUpdate' + res).val("")
                            $('#priceUpdate' + res).val("")
                            $('#busTypeUpdate' + res).val("")
                            $('#companyUpdate' + res).val("")
                            $('#routeUpdate' + res).val("")
                            $('#maxUpdate' + res).val("")
                            $('#departureUpdate' + res).val("")
                            $('#arrivalUpdate' + res).val("")
                        } else {
                            toastr.error("Try later.")
                        }
                    },
                    error: function(data, err) {
                        toastr.error("Some problem occured. Please try again later.")
                    }
                })
            }
        }
    </script>

</body>

</html>