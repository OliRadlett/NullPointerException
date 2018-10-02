<?php

// Doc-comments coming later

session_start();
include "database.php";

$database = new Database();

$type = $_GET["type"];
if ($type == "new") {
    $query = "SELECT * FROM `questions` ORDER BY `id` DESC LIMIT 10";
} else if ($type == "top"){
    $query = "SELECT * FROM `questions` ORDER BY `votes` DESC LIMIT 10";
} else if ($type == "hot"){
//  No LIMIT 10 because processing is done in the script not the query
    $query = "SELECT * FROM `questions`";
}
$database->query($query);
if ($type !== "hot") {
    notHot($database);
} else if ($type == "hot") {
    hot($database);
}

function hot(Database $database) {
	$scoreArray = array();
    $array = array();
    while($row = $database->fetchAssoc()) {
        $points = $row["votes"];
        $order = log(max(abs($points), 1), 10);
        if ($points > 0) {
            $sign = 1;
        } else if ($points < 0) {
            $sign = -1;
        } else {
            $sign = 0;
        }
        $seconds = $row["time"] - 1516221943;
        $score = round($order + $sign * $seconds / 45000, 7);
        array_push($scoreArray, $score);
        array_push($array, array("score"=>$score, "question"=>$row["title"], "id"=>$row["id"], "votes"=>$row["votes"]));
    }
    usort($array, "sortOrder");
    for ($i = 0; $i < 10; $i++){
        echo $array[$i]["question"] . " <br/>";
        echo $array[$i]["id"] . " <br/>";
        echo $array[$i]["votes"] . "<br/>";
    }
}

function notHot(Database $database) {
	while($row = $database->fetchAssoc()) {
        echo $row["title"] . "<br/>";
        echo $row["id"] . "<br/>";
        echo $row["votes"] . "<br/>";
    }
}

function sortOrder($a, $b) {
    return $b["score"] - $a["score"];
}

?>