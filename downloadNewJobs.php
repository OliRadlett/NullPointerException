<?php

    include "database.php";

    $database = new Database();

    $database->query("SELECT * FROM npe.jobs ORDER BY id DESC");

    while ($result = $database->fetchAssoc()) {

        echo $result["id"] . "<br/>";
        echo $result["title"] . "<br/>";
        echo $result["location"] . "<br/>";
        echo $result["salary"] . "<br/>";
        echo $result["tags"] . "<br/>";

    }

?>