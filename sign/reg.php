<?php

require '../connection/connect.php';

$email = $_REQUEST['email'];
$fullName = $_REQUEST['fullName'];
$password = $_REQUEST['password'];

$hashedPass = $hash_pass = password_hash($password, PASSWORD_DEFAULT);

if ($_REQUEST['task'] == "register") {
    $query = "INSERT INTO register (`email`, `name`, `password`, `type`) VALUES ('$email','$fullName', '$hashedPass', 0)";

    $response = @mysqli_query($dbc, $query);
    if ($response) {
        echo ('sent');
    } else {
        echo mysqli_error($dbc);
    }
}
