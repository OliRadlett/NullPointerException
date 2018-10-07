<?php

/**
 *
 * Page to display a job to the user
 *
 * @author Oli Radlett <o.radlett@gmail.com>
 *
 */

//  Start PHP session and include required files
session_start();
include "database.php";

// Set locale for currency formatting
setLocale(LC_ALL, 'en_GB.utf8', 'en_GB');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel = "stylesheet" href = "stylesheets/index.css">
    <link rel = "stylesheet" href = "prism/prism.css">
    <script type="text/javascript" src = "prism/prism.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>NullPointerException</title>
</head>
<body>
<?php

//      Include universal page header
include ("header.html");
//      Create a new Database object
$database = new Database();

?>
<br/>
<br/>
<br/>
<?php

$database->query("SELECT * FROM `jobs` WHERE `id` = '" . $_GET["id"] . "'");

$jTitle = $jDescription = $jCompany = $jLocation = $jSalary = $jTags = null;

while($row = $database->fetchAssoc()) {

    $jTitle = $row["title"];
    $jDescription = $row["description"];
    $jCompany = $row["company"];
    $jLocation = $row["location"];
    $jSalary = $row["salary"];
    $jTags = $row["tags"];

}

$jTags = str_replace(",", ", ", $jTags);

?>
<div class = "container">
    <div class = "row">
        <div class = "col-lg-10">
            <h2>
                <?php

                    echo $jTitle;

                ?>
            </h2>
        </div>
    </div>
    <div class = "row">
        <div class = "col-lg-10">
            <h5>
                <?php

                    echo "<b>" . $jCompany . "</b> | " . $jLocation;

                ?>
            </h5>
        </div>
    </div>
    <div class = "row">
        <div class = "col-lg-10">
            <h6>
                <?php

                    echo money_format('%.2n', $jSalary);

                ?>
            </h6>
        </div>
    </div>
    <br/>
    <div class = "row">
        <div class = "col-lg-10">
            <h6>
                <?php

                    echo "Tags: " . $jTags;

                ?>
            </h6>
        </div>
    </div>
    <br/>
    <div class = "row">
        <div class = "col-lg-10">
            <?php

                echo "<b>Job description</b>: " . nl2br($jDescription);

            ?>
        </div>
    </div>
</div>
</body>
