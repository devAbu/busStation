<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bus station - User</title>
    <meta name="description" content="Bus station...">
    <meta name="keyword" content="bus, station, bus station, gras, centrotrans">

    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/logo.ico" type="image/x-icon">

    <script src="https://kit.fontawesome.com/4dd2b4255f.js"></script>

    <link rel="stylesheet" href="toastr.scss">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 50px">
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
                <div class="col-6">
                    <input id="search-start" name="search-start" value="" type="text" class="form-control mt-2" placeholder="Search by start destination...">
                </div>
                <div class="col-6">
                    <input id="search-end" name="search-end" value="" type="text" class="form-control mt-2" placeholder="Search by end destination..">
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <?php

            require 'connection/connect.php';

            $sql = "SELECT * FROM bus";
            $result = $dbc->query($sql);

            $count = $result->num_rows;

            if ($count > 0) {
                echo '<div class="col-12">';
                while ($row = $result->fetch_assoc()) {
                    echo ' <div class="startEnd">
                        <form method="post" action="reservation/reserve.php" >
                            <div class="card mt-2 bus">
                                <input type="text" value=" ' . $row["ID"] . ' "  name="busID" id="busID" hidden>
                                <h5 class="card-header all">' . $row['busType'] . '</h5>
                                <div class="card-body">
                                    <h5 class="card-title all">' . $row['company'] . '</h5>
                                        <ul>
                                            <li class="start all" role="treeitem" data-value="' . $row['startDestination'] . '">Start destination: ' . $row['startDestination'] . '</li>
                                            <li class="end all"  role="treeitem" data-value="' . $row['endDestination'] . '">End destination: ' . $row['endDestination'] . '</li>
                                            <li class="all">Driving route: ' . $row['route'] . '</li>
                                            <li class="all">Available Seats: ' . $row['availableSeat'] . '</li>
                                            <li class="all">Price ticket: ' . $row['price'] . '</li>
                                        </ul>
                                        <button class="btn btn-success all" id="reservation" type="submit">Reserve seat</button>
                                </div>
                            </div>
                        </form>
                        </div>';
                }
                echo '</div>';
            } else {
                echo "There are no buses.";
            }
            $dbc->close();
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="toastr.js"></script>
    <script src="changePass/changePass.js"></script>

    <!-- TODO: uradit da trazi samo po start i end destination -->

    <script>
        $("#search-start").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            var start = $('.start').data('value')

            $(".start").filter(function() {
                $(".all").not(".start").toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $("#search-end").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".startEnd").not($(".all")).not($(".start")).filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>

</body>

</html>