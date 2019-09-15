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

    <div class="container">

        <form action="search.php" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-12">
                        <input id="search-start" name="searchStart" value="" type="text" class="form-control mt-2" placeholder="Search by start destination...">
                    </div>
                    <div class="col-md-4 col-sm-12 col-12">
                        <input id="search-end" name="searchEnd" value="" type="text" class="form-control mt-2" placeholder="Search by end destination..">
                    </div>
                    <div class="col-md-4 col-sm-12 col-12 mt-2 mt-sm-2 mt-md-0">
                        <button class="btn btn-success all" type="submit">Search</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <?php



            //search
            $connection = mysqli_connect('localhost', 'root', '', 'busStation');
            $output = '';

            $searchStart = $_POST['searchStart'];
            $searchEnd = $_POST['searchEnd'];


            $query = mysqli_query($connection, "SELECT * FROM bus WHERE startDestination LIKE '%$searchStart%' AND endDestination LIKE '%$searchEnd%' ") or die("Could not search!");
            $count = mysqli_num_rows($query);

            if ($count == 0) {
                echo "<br>There are no buses!";
            } else {
                while ($result = mysqli_fetch_array($query)) {
                    echo '<div class="col-12">';
                    echo ' <div class="startEnd">
                        <form method="post" action="reservation/reserve.php" >
                            <div class="card mt-2 bus">
                                <input type="text" value=" ' . $result["ID"] . ' "  name="busID" id="busID" hidden>
                                <h5 class="card-header all">' . $result['busType'] . '</h5>
                                <div class="card-body">
                                    <h5 class="card-title all">' . $result['company'] . '</h5>
                                        <ul>
                                            <li class="start all" role="treeitem" data-value="' . $result['startDestination'] . '">Start destination: ' . $result['startDestination'] . '</li>
                                            <li class="end all"  role="treeitem" data-value="' . $result['endDestination'] . '">End destination: ' . $result['endDestination'] . '</li>
                                            <li class="all">Driving route: ' . $result['route'] . '</li>
                                            <li class="all">Available Seats: ' . $result['availableSeat'] . '</li>
                                            <li class="all">Price ticket: ' . $result['price'] . '</li>
                                        </ul>
                                        <button class="btn btn-success all" id="reservation" type="submit">Reserve seat</button>
                                </div>
                            </div>
                        </form>
                        </div>
                        </div>
                        
                        ';
                }
            }


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


</body>

</html>