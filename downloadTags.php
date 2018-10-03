<?php

    include "database.php";

    $database = new Database();

    $database->query("SELECT * FROM npe.tags");

    while ($row = $database->fetchAssoc()) {

        echo $row["tag"] . "<br/>";

    }



?>