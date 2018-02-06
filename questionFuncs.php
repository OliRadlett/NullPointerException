<?php

function UsrVoted($id, $qID, $connection) {

    $query = "SELECT `id` FROM `votes` WHERE `uID` = '$id' AND `qID` = '$qID'";
    $result = mysqli_query($connection, $query);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows == 1) {
        
        return true;

    } else {

        return false;

    }

}

function Upvoted($id, $qID, $connection) {

    $query = "SELECT `type` FROM `votes` WHERE `uID` = '$id' AND `qID` = '$qID'";
    $result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($result)) {

        if ($row["type"] == "u") {

            return true;

        } else {

            return false;

        }

    }

}

?>