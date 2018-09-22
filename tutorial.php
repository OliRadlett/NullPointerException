<?php

// Start PHP session
session_start();

// Include Database class
include "database.php";

// Create new Database object
$database = new Database();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel = "stylesheet" href = "stylesheets/index.css">
    <title>NullPointerException</title>
</head>
<body>

    <?php

//      Include universal page header
        include ("header.html");

    ?>

    <br/>
    <br/>
    <div class = "container">
        <div class = "row">
            <h1>Tutorial Zone</h1>
        </div>
    </div>
    <div class = "container">
        <div class = "row">
            <div class = "col-lg-6">
                <p>The Tutorial Zone is designed to collate the best resources on the internet in one place, to provide beginners with a centralised location to access tutorials and further their knowledge of coding.</p>
            </div>
        </div>
        <div class="row">
            <h2><u>Languages</u></h2>
        </div>
        <div class = "row">
            <ul>
                <li>
                    <a class = "link" href = "python3.php">Python 3</a>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>