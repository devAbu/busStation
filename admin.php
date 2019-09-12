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
    <div class="container">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-outline-primary" id="addBtn" data-toggle="collapse" data-target="#form">Add new
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

                        <button type="button" class="btn btn-success" id="newAddBtn">Add</button>
                        <button type="reset" class="btn btn-danger" id="newCancelBtn">Clear</button>
                    </form>
                </div>
            </div>
            <div class="col-12">

                <?php

                require 'connection/connect.php';

                $sql = "SELECT * FROM bus";
                $result = $dbc->query($sql);

                $count = $result->num_rows;

                if ($count > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                        <form method="post" action="delete/delete.php">
                        <div class="card mt-2">
                        <input type="text" value=" ' . $row["ID"] . ' "  name="busID" id="busID" >
  <h5 class="card-header">' . $row['busType'] . '</h5>
  <div class="card-body">
    <h5 class="card-title">' . $row['company'] . '</h5>
        <ul>
            <li>Start destination: ' . $row['startDestination'] . '</li>
            <li>End destination: ' . $row['endDestination'] . '</li>
            <li>Driving route: ' . $row['route'] . '</li>
            <li>Price ticket: ' . $row['price'] . '</li>
        </ul>
        <button class="btn btn-warning" id="remove" type="submit">Remove</button>
</div>
</div>';
                    }
                } else {
                    echo " 0 results";
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

</body>

</html>