<?php
include "connect.php";
$connection = connect();
$qID = $_GET["qid"];
$username = $_GET["username"];
$uID = getUserID($connection, $username);
$query = "SELECT `type` FROM `votes` WHERE `uid` = '$uID' AND `qid` = '$qID'";
$result = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($result)) {
    if ($row["type"] == "u") {
        echo "up";
    } else if ($row["type"] = "d"){
        echo "down";
    }
}
// No support for logged in users that haven't voted either up or down
mysqli_close($connection);
function getUserID($connection, $username) {
    $query = "SELECT `id` FROM `users` WHERE `username` = '$username'";
    $result = mysqli_fetch_assoc(mysqli_query($connection, $query));
    return $result["id"];
}
?>
