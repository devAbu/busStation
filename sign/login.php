<?php

require '../connection/connect.php';

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];

$hashedPass = $hash_pass = password_hash($password, PASSWORD_DEFAULT);

if ($_REQUEST['task'] == "login") {

    $sql = "SELECT `email`, `password`, `type` FROM `register` WHERE `email` = '$email'";
    $result = $dbc->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['email'] == $email) {
                if ($row['type'] == 1) {
                    if (password_verify($password, $row['password'])) {
                        echo ('sentAdmin');
                        session_start();
                        $_SESSION["email"] = $row["email"];
                    } else {
                        echo ('pass');
                    }
                } else {
                    if (password_verify($password, $row['password'])) {
                        echo ('sentUser');
                        session_start();
                        $_SESSION["email"] = $row["email"];
                    } else {
                        echo ('pass');
                    }
                }
            } else {
                echo ('mail');
            }
        }
    }
}
