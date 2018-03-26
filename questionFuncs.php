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

        echo "<a href = '#' onclick='Up(`green`);return false'><img id = 'numVotes' src = 'img/up_green.png' /></a>";
        echo "<h4 id = 'numVotes'>" . $qVotes . "</h4>";
        echo "<a href = '#' onclick='Down(`green`);return false'><img id = 'numVotes' src = 'img/down_grey.png' /></a>";

    } else {

        echo "<a href = '#' onclick='Up(`red`);return false'><img id = 'numVotes' src = 'img/up_grey.png' /></a>";
        echo "<h4 id = 'numVotes'>" . $qVotes . "</h4>";
        echo "<a href = '#' onclick='Down(`red`);return false'><img id = 'numVotes' src = 'img/down_red.png' />";

    }

}

function ShowGreyArrows($qID, $qVotes, $connection) {

    echo "<a href = '#' onclick='Up(`grey`);return false'><img id = 'numVotes' src = 'img/up_grey.png' /></a>";
    echo "<h4 id = 'numVotes'>" . $qVotes . "</h4>";
    echo "<a href = '#' onclick='Down(`grey`);return false'><img id = 'numVotes' src = 'img/down_grey.png' /></a>";

}

function GetComments($qID, $connection) {

  $query = "SELECT * FROM `comments` WHERE `qid` = '$qID' ORDER BY `votes` DESC";
  $result = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($result)) {

    Comment($row, $connection);

  }

}

function Comment($row, $connection) {

  $author = $row["author"];
  $comment = $row["comment"];
  $commentID = $row["id"];
  $qid = $row["qid"];
  //etc

  echo "<div class = 'row comment'>";
  echo "<div class = 'col'>";
  echo "<p>" . $comment . " - <i class = 'comment_username'>" . $author . "</i><i>" . (isset($_SESSION["username"]) ? ($author == $_SESSION["username"] ? " (<a href='editcomment.php?id=" . $commentID . "&qid=" . $qid . "'>edit comment</a>)" : "") : "") ."</i></p>";
  echo "</div>";
  echo "</div>";
  //echo "<div class = 'row seperator'></div>";
  echo "<br/>";

}

function getUserID($connection, $username) {

  $query = "SELECT `id` FROM `users` WHERE `username` = '$username'";
  $result = mysqli_fetch_assoc(mysqli_query($connection, $query));
  return $result["id"];

}

function SplitLines($questionArray) {

  $normalLines = array();
  $codeblockLines = array();

  for ($i = 0; $i < sizeof($questionArray); $i++) {

    $line = $questionArray[$i];

    if (substr($line, 0, 1) == "`") {

      array_push($codeblockLines, $i);

    } else {

      array_push($normalLines, $i);
    }

  }

  return array($normalLines, $codeblockLines);

}

function StartCodeBlock($language) {

  echo "<pre>";
  echo "<code class = 'language-" . $language . "'>";

}

function EndCodeBlock() {

  echo "</code>";
  echo "</pre>";

}

function isUsersComment($connection, $username, $id) {

  $query = "SELECT `author` FROM `comments` WHERE `author` = '$username' AND `id` = '$id'";
  $result = mysqli_query($connection, $query);

  if (mysqli_num_rows($result) == 1) {

    return true;

  } else {

    return false;

  }

}

function GetComment($connection, $id) {

  $query = "SELECT `comment` FROM `comments` WHERE `id` = '$id'";
  $result = mysqli_fetch_assoc(mysqli_query($connection, $query));

  return $result["comment"];

}

?>
