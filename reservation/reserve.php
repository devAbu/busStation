<?php


require "../connection/connect.php";

$bus = $_REQUEST["busID"];

$sql = "Select maxSeat, availableSeat from bus where ID = $bus";
$result = @mysqli_query($dbc, $sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row["availableSeat"] != 0) {

            $query = "UPDATE bus set availableSeat = availableSeat-1 where ID = $bus";

            $result2 = $dbc->query($query);

            if ($result2) {
                header('location:../user.php');
            }
        }
    }
}
