<?php

    session_start();

    include "database.php";
    include "core.php";

    $database = new Database();

    $jobTitle = $_POST["title"];
    $jobDescription = $_POST["description"];;
    $jobLocation = $_POST["location"];
    $jobSalary = $_POST["salary"];
    $jobCompany = $_POST["company"];
    $jobTags = $_GET["tags"];

    $jobTags = str_replace("[", "", $jobTags);
    $jobTags = str_replace("]", "", $jobTags);

    $jobSalary = intval($jobSalary);

    if (Util::_isset($jobTitle, $jobDescription, $jobLocation, $jobSalary, $jobTags))
    {

        $database->query("INSERT INTO npe.jobs(`title`, `description`, `company`, `location`, `salary`, `tags`) VALUES ('$jobTitle', '$jobDescription', '$jobCompany', '$jobLocation', $jobSalary, '$jobTags');");

        Util::redirect("/findjobs.php");

    }

    //TODO Add comments and more validation

?>