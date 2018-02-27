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
    <?php $connection = connect();

        if (!$connection) {

            die("Connection failed: " . mysqli_connect_error());

        }
    ?>
    <?php include ("header.html"); ?>
    <br/>
    <br/>
    <br/>
    <?php
            
        $qID = $_GET["id"];
        $query = "SELECT * FROM `questions` WHERE `id` = '$qID'";
        $result = mysqli_query($connection, $query);
            
        $qTitle;
        $qContent;
        $qVotes;
        $qTime;
        $qAuthor;

        if ($result) {
                
            while($row = mysqli_fetch_assoc($result)) {
                    
                $qTitle =  $row["title"];
                $qContent =  $row["question"];
                $qVotes =  $row["votes"];
                $qTime =  $row["time"];
                $qAuthor =  $row["author"];

            }

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

                            if (Upvoted($_SESSION["id"], $qID, $connection)) {

                                echo "<img id = 'numVotes' src = 'img/up_green.png' />";
                                echo "<h4 id = 'numVotes'>" . $qVotes . "</h4>";
                                echo "<img id = 'numVotes' src = 'img/down_grey.png' />";

                            } else {

                                echo "<img id = 'numVotes' src = 'img/up_grey.png' />";
                                echo "<h4 id = 'numVotes'>" . $qVotes . "</h4>";
                                echo "<img id = 'numVotes' src = 'img/down_red.png' />";
                                
                            }

                        } else {

                            if (UsrVoted($_SESSION["id"], $qID, $connection)) {

                                echo "<img id = 'numVotes' src = 'img/up_grey.png' />";
                                echo "<h4 id = 'numVotes'>" . $qVotes . "</h4>";
                                echo "<img id = 'numVotes' src = 'img/down_grey.png' />";
            
                            }

                        }

                    } else {

                        echo "<img id = 'numVotes' src = 'img/up_grey.png' />";
                        echo "<h4> id = 'numVotes'>" . $qVotes . "</h4>";
                        echo "<img id = 'numVotes' src = 'img/down_grey.png' />";

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
    </div>
</body>