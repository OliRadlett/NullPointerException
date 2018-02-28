<?php session_start();
include "connect.php";
$connection = connect();
$type = $_GET["type"];
switch ($type) {
	case 'new':
		$query = "SELECT * FROM `questions` ORDER BY `id` DESC";
		break;
	case 'top':
		$query = "SELECT * FROM `questions` ORDER BY `votes` DESC";
		break;
	case 'new':
		$query = "SELECT * FROM `questions`";
		break;
}
$result = mysqli_query($connection, $query);
if ($type !== "hot") {
    notHot($result);
} else if ($type == "hot") {
    hot($result);
}

function hot($result) {
	$scoreArray = array();
    $array = array();
    while($row = mysqli_fetch_assoc($result)) {
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

function notHot($result) {
	while($row = mysqli_fetch_assoc($result)) {
        echo $row["title"] . "<br/>";
        echo $row["id"] . "<br/>";
        echo $row["votes"] . "<br/>";
    }
}

function sortOrder($a, $b) {
    return $b["score"] - $a["score"];
}
?>