<?php

function UsrVoted($id, $qID, Database $database) {

    $database->query("SELECT `id` FROM `votes` WHERE `uID` = '$id' AND `qID` = '$qID'");

    if ($database->numRows() == 1) {

        return true;

    } else {

        return false;

    }

}

function Upvoted($id, $qID, Database $database) {

    $database->query("SELECT `type` FROM `votes` WHERE `uID` = '$id' AND `qID` = '$qID'");

    while($row = $database->fetchAssoc()) {

        if ($row["type"] == "u") {

            return true;

        } else {

            return false;

        }

    }

}

function ShowVotedArrows($qID, $qVotes, Database $database) {

    if (Upvoted($_SESSION["id"], $qID, $database)) {

        echo "<a href = '#' onclick='Up(`green`);return false'><img class = 'numVotes' id = 'upArrow' src = 'img/up_green.png' /></a>";
        echo "<h4 class = 'numVotes'>" . $qVotes . "</h4>";
        echo "<a href = '#' onclick='Down(`green`);return false'><img class = 'numVotes' id = 'downArrow' src = 'img/down_grey.png' /></a>";

    } else {

        echo "<a href = '#' onclick='Up(`red`);return false'><img class = 'numVotes' id = 'upArrow' src = 'img/up_grey.png' /></a>";
        echo "<h4 class = 'numVotes'>" . $qVotes . "</h4>";
        echo "<a href = '#' onclick='Down(`red`);return false'><img class = 'numVotes' id = 'downArrow' src = 'img/down_red.png' /></a>";

    }

}

function ShowGreyArrows($qVotes) {

    echo "<a href = '#' onclick='Up(`grey`);return false'><img class = 'numVotes' id = 'upArrow' src = 'img/up_grey.png' /></a>";
    echo "<h4 class = 'numVotes'>" . $qVotes . "</h4>";
    echo "<a href = '#' onclick='Down(`grey`);return false'><img class = 'numVotes' id = 'downArrow' src = 'img/down_grey.png' /></a>";

}

function GetComments($qID, Database $database) {

  $database->query("SELECT * FROM `comments` WHERE `qid` = '$qID' ORDER BY `votes` DESC");

  while($row = $database->fetchAssoc()) {

    Comment($row);

  }

}

function Comment($row) {

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

function getUserID(Database $database, $username) {

  $database->query("SELECT `id` FROM `users` WHERE `username` = '$username'");
  $result = $database->fetchAssoc();
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

function isUsersComment(Database $database, $username, $id) {

  $database->query("SELECT `author` FROM `comments` WHERE `author` = '$username' AND `id` = '$id'");

  if ($database->numRows() == 1) {

    return true;

  } else {

    return false;

  }

}

function GetComment(Database $database, $id) {

  $database->query("SELECT `comment` FROM `comments` WHERE `id` = '$id'");
  $result = $database->fetchAssoc();

  return $result["comment"];

}

?>
