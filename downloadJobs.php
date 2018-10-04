<?php

    include "database.php";

    $database = new Database();

    $tagsStr = $_GET["tags"];
    $tagsArray = explode(",", $tagsStr);

    $matchingQuestionIDs = array();
    $jobs = array();

    $database->query("SELECT * FROM npe.jobs");

    while ($result = $database->fetchAssoc()) {

        array_push($jobs, $result);

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

    foreach ($jobs as $key => $value) {

        $job = $jobs[$key];
        $jobID = $job["id"];

        for ($i = 0; $i < sizeof($matchingQuestionIDs); $i++) {

            if ($jobID == $matchingQuestionIDs[$i]) {

                echo $job["id"] . "<br/>";
                echo $job["title"] . "<br/>";
                echo $job["location"] . "<br/>";
                echo $job["salary"] . "<br/>";
                echo $job["tags"] . "<br/>";

            }

        }

    }

?>

