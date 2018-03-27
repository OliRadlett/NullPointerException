<?php
include "connect.php";
$connection = connect();
$qID = $_GET["qid"];
$username = $_GET["username"];
$func = $_GET["func"];
$uID = getUserID($connection, $username);
// Oops, this isn't very secure...
// Might be an idea to fix this
// *At some point*
// Blah blah can run preset SQL querys from by using URL params blah blah
switch ($func) {
    case 'removevote':
        RemoveVote($connection, $qID, $uID);
        break;
    case 'addupvote':
        AddUpVote($connection, $qID, $uID);
        break;
    case 'adddownvote':
        AddDownVote($connection, $qID, $uID);
        break;
    default:
        break;
}
function AlreadyVoted($connection, $qID, $uID) {
    $query = "SELECT `id` FROM `votes` WHERE (`qID` = '$qID' AND `uID` = '$uID')";
    $result = mysqli_query($connection, $query);
    if (isset($result) && mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }

}
function AddUpVote($connection, $qID, $uID) {
    if (!AlreadyVoted($connection, $qID, $uID)) {
        $query = "INSERT INTO `votes` (`qID`, `uID`, `type`) VALUES ('$qID', '$uID', 'u')";
        mysqli_query($connection, $query);
        mysqli_close($connection);
    }
}
function AddDownVote($connection, $qID, $uID) {
    if (!AlreadyVoted($connection, $qID, $uID)) {
        $query = "INSERT INTO `votes` (`qID`, `uID`, `type`) VALUES ('$qID', '$uID', 'd')";
        mysqli_query($connection, $query);
        mysqli_close($connection);
    }
}
function RemoveVote($connection, $qID, $uID) {
    $query = "DELETE FROM `votes` WHERE (`votes`.`qID` = '$qID' AND `votes`.`uID` = '$uID')";
    mysqli_query($connection, $query);
    mysqli_close($connection);
}
function getUserID($connection, $username) {
    $query = "SELECT `id` FROM `users` WHERE `username` = '$username'";
    $result = mysqli_fetch_assoc(mysqli_query($connection, $query));
    return $result["id"];
}
?>
