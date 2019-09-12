<?php
require '../connection/connect.php';

$id = $_REQUEST['busID'];
echo $id;

$sql = "DELETE from `bus` where `ID` = $id";
$response = @mysqli_query($dbc, $sql);

if ($response) {
    header('location:../admin.php');
} else {
    echo mysqli_error($dbc);
}
