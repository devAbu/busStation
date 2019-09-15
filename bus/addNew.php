<?php

require '../connection/connect.php';

$startDestination = $_REQUEST['startDestination'];
$endDestination = $_REQUEST['endDestination'];
$price = $_REQUEST['price'];
$busType = $_REQUEST['busType'];
$company = $_REQUEST['company'];
$route = $_REQUEST['route'];
$maxSeat = $_REQUEST['maxSeat'];
$departureTime = $_REQUEST['departureTime'];
$arrivalTime = $_REQUEST['arrivalTime'];


if ($_REQUEST['task'] == "new") {
    $query = "INSERT INTO bus (`startDestination`, `endDestination`, `price`, `busType`, `company`, `route`, `maxSeat`, `availableSeat`, `departureTime`, `arrivalTime`) VALUES ('$startDestination','$endDestination', $price, '$busType', '$company', '$route', $maxSeat, $maxSeat, '$departureTime', '$arrivalTime')";

    $response = @mysqli_query($dbc, $query);
    if ($response) {
        echo ('sent');
    } else {
        echo mysqli_error($dbc);
    }
}
