<?php

/**
 *
 * Page to search, download and output the results of a search query
 *
 * @author Oli Radlett <o.radlett@gmail.com>
 *
 */

// Include Database class
include "database.php";

// Create a new Database object
$database = new Database();

// Get search query from URL
$q = $_GET["q"];

// Create an run a MySQL query to search the database based on the query stored above
$database->query("SELECT * FROM npe.jobs WHERE title LIKE '%{$q}%' OR `description` LIKE '%{$q}%' OR `location` LIKE '%{$q}%' OR `tags` LIKE '%{$q}%'");

// Iterate over all the results from the database
while($row = $database->fetchAssoc()) {

//  Output the necessary attributes followed by a new-line
    echo $row["id"] . "<br/>";
    echo $row["title"] . "<br/>";
    echo $row["location"] . "<br/>";
    echo $row["salary"] . "<br/>";
    echo $row["tags"] . "<br/>";

}

?>