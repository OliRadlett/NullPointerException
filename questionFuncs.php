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

function ShowVotedArrows($qID, $qVotes, $connection) {

    if (Upvoted($_SESSION["id"], $qID, $connection)) {

        echo "<img id = 'numVotes' src = 'img/up_green.png' />";
        echo "<h4 id = 'numVotes'>" . $qVotes . "</h4>";
        echo "<img id = 'numVotes' src = 'img/down_grey.png' />";

    } else {

        echo "<img id = 'numVotes' src = 'img/up_grey.png' />";
        echo "<h4 id = 'numVotes'>" . $qVotes . "</h4>";
        echo "<img id = 'numVotes' src = 'img/down_red.png' />";
                                
    }

}

function ShowGreyArrows($qID, $qVotes, $connection) {

    echo "<img id = 'numVotes' src = 'img/up_grey.png' />";
    echo "<h4 id = 'numVotes'>" . $qVotes . "</h4>";
    echo "<img id = 'numVotes' src = 'img/down_grey.png' />";

}


?>