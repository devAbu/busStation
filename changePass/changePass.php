<?php

require '../connection/connect.php';

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];

$hashedPass = $hash_pass = password_hash($password, PASSWORD_DEFAULT);

if ($_REQUEST['task'] == "login") {
    /* $sql = "";
    $result = $dbc->query($sql);
 */
    $sql = "SELECT email FROM register WHERE email = '$email'";
    $result = $dbc->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['email'] == $email) {

                $query = "UPDATE register set password = '$hashedPass' where email = '$email'";

                $result2 = $dbc->query($query);

                if ($result2) {
                    echo ('changed');
                }
            }
        }
    }
}
