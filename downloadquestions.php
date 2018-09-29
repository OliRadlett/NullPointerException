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
    // Hmmmm, does limiting the selection to the first 10 only process the question 1-10 and ignore anything asked after the first 10?
    // Maybe it should be limited to 10 after the processing has been completed.
    $query = "SELECT * FROM `questions` LIMIT 10";
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
    for ($i = 0; $i < count($scoreArray); $i++){
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