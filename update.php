<?php

require 'connection/connect.php';

$ID = $_REQUEST['ID'];
$start = $_REQUEST['start'];
$end = $_REQUEST['end'];
$price = $_REQUEST['price'];
$busType = $_REQUEST['busType'];
$company = $_REQUEST['company'];
$route = $_REQUEST['route'];
$maxSeat = $_REQUEST['maxSeat'];

$query = "UPDATE bus set startDestination = '$start', endDestination = '$end', price = $price, busType = '$busType', company = '$company', `route` = '$route', maxSeat = $maxSeat where ID = $ID";

$result = $dbc->query($query);

if ($result) {
    echo ('changed');
} else {
    echo mysqli_error($dbc);
}
