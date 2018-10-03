<?php

    include "database.php";

    $database = new Database();

    $tagsStr = $_GET["tags"];
    $tagsArray = explode(",", $tagsStr);

    $matchingQuestionIDs = array();

    $database->query("SELECT * FROM npe.jobs");

    while ($result = $database->fetchAssoc()) {

        $jobTags = $result["tags"];
        $jobID = $result["id"];
        $jobTagsArray = explode(",", $jobTags);

        for ($i = 0; $i < sizeof($jobTagsArray); $i++) {

            $jobTag = $jobTagsArray[$i];

            for ($ii = 0; $ii < sizeof($tagsArray); $ii++) {

                $tag = $tagsArray[$ii];

                if ($tag == $jobTag) {

                    array_push($matchingQuestionIDs, $jobID);

                }

            }

        }

    }

    $matchingQuestionIDs = array_unique($matchingQuestionIDs);

    for ($i = 0; $i < sizeof($matchingQuestionIDs); $i++) {

        echo $matchingQuestionIDs[$i] . "<br/>";

    }

?>

