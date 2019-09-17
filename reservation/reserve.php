<?php


require "../connection/connect.php";

$bus = $_REQUEST["busID"];
$user = $_REQUEST["userID"];

$sql = "Select maxSeat, availableSeat from bus where ID = $bus";
$result = @mysqli_query($dbc, $sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row["availableSeat"] != 0) {

            $query = "UPDATE bus set availableSeat = availableSeat-1 where ID = $bus";

            $result2 = $dbc->query($query);

            if ($result2) {
                $query2 = "INSERT INTO `reserved` (`user`, `busID`) values ('$user', '$bus')";
                $result3 = $dbc->query($query2);
                echo $user;
                if ($result3) {
                    //echo 'reserved';
                    header('location:../user.php');
                }
            }
        }
    }
}
