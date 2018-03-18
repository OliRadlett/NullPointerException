<?php session_start();
include "connect.php";
include "questionFuncs.php" ?>
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
    <?php include ("header.html");
    $connection = connect()?>
    <br/>
    <br/>
    <br/>
    <?php

        if (isset($_GET["id"])) {

            $qID = $_GET["id"];

        } else {

            session_write_close();
            header("Location: error.php?error=noquestionid");

        }

        $query = "SELECT * FROM `questions` WHERE `id` = '$qID'";
        $result = mysqli_query($connection, $query);

        // Declare multiple variables on the same line
        $qTitle = $qContent = $qVotes = $qTime = $qAuthor = "";

        while($row = mysqli_fetch_assoc($result)) {

            $qTitle =  $row["title"];
            $qContent =  $row["question"];
            $qVotes =  $row["votes"];
            $qTime =  $row["time"];
            $qAuthor =  $row["author"];

        }

    ?>
    <div class = "container">
        <div class = "row">
            <div class = "col-lg-10">
                <h2><?php echo $qTitle; ?></h2>
            </div>
        </div>
        <br/>
        <div class = "row">
            <div class = "col-lg-10">
                <p><?php echo $qContent; ?></p>
            </div>
            <div class = "col-lg-1">
            </div>
            <div class = "col-lg-1">
                <?php

                    if (isset($_SESSION["username"])) {

                        if (UsrVoted($_SESSION["id"], $qID, $connection)) {

                            ShowVotedArrows($qID, $qVotes, $connection);

                        } else {

                            ShowGreyArrows($qID, $qVotes, $connection);
                        }

                    } else {

                        ShowGreyArrows($qID, $qVotes, $connection);

                    }

                ?>
            </div>
        </div>
        <div class = "row">
            <div class = "col-lg-10">
                <i id = "author">Asked by: <b><?php echo $qAuthor; ?></b></i>
            </div>
        </div>
        <br/>
        <div class = "row">
            <hr>
        </div>
        <br />
        <br />
        <div class = "row">
            <div class ="col-10">
                <h4><b>Comments:</b></h4>
            </div>
            <div class ="col-2">
                <button class = "btn btn-primary">Comment</button>
            </div>
        </div>
        <br/>
        <?php

          GetComments($qID, $connection);

         ?>
    </div>
</body>
