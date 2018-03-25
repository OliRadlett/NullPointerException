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
    <link rel = "stylesheet" href = "prism/prism.css">
    <script type="text/javascript" src = "prism/prism.js"></script>
    <title>NullPointerException</title>
</head>
<body>
    <?php include ("header.html");
    $connection = connect()?>
    <script type="text/javascript" src = "scripts/getUserVotes.js"></script>
    <br/>
    <br/>
    <br/>
    <?php

        function SetCookies() {

            if (isset($_GET["id"])) {

                setcookie("current_qid", $_GET["id"]);

            } else {

                session_write_close();
                header("Location: error.php?error=noquestionid");

            }

            if (isset($_SESSION["username"])) {

                setcookie("logged_in", "true");
                setcookie("current_username", $_SESSION["username"]);

            } else {

                setcookie("logged_in", "false");

            }

        }

        SetCookies();

        $query = "SELECT * FROM `questions` WHERE `id` = '" . $_GET["id"] . "'";
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
                <?php

                    $questionArray = explode("\n", $qContent);
                    $splitArray = SplitLines($questionArray);

                    for ($i = 0; $i < sizeof($questionArray); $i++) {

                        if (in_array($i, $splitArray[0])) {

                            echo $questionArray[$i] . "<br/>";

                        } else if (in_array($i, $splitArray[1])) {

                            $line = trim($questionArray[$i]);

                            if ((strlen($line) > 3) && (substr($line, 0, 3) == "```")) {

                                // Must be start of code block
                                StartCodeBlock(substr($line, 3));

                            } else if ((strlen($line) == 3) && (substr($line, 0, 3) == "```")) {

                                // Must be end of code block
                                EndCodeBlock();

                            } else {

                                //var_dump($questionArray[$i]);
                                echo htmlspecialchars(substr($questionArray[$i], 1));

                            }

                        }

                    }

                ?>
            </div>
            <div class = "col-lg-1">
            </div>
            <div class = "col-lg-1">
                <?php

                    if (isset($_SESSION["username"])) {

                        if (UsrVoted($_SESSION["id"], $_GET["id"], $connection)) {

                            ShowVotedArrows($_GET["id"], $qVotes, $connection);

                        } else {

                            ShowGreyArrows($_GET["id"], $qVotes, $connection);
                        }

                    } else {

                        ShowGreyArrows($_GET["id"], $qVotes, $connection);

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
                <?php
                    echo '<button class = "btn btn-primary" onclick = "window.location.href = `comment.php?id=' . $_GET["id"] . '`">Comment</button>';
                ?>
            </div>
        </div>
        <br/>
        <?php

          GetComments($_GET["id"], $connection);

         ?>
    </div>
</body>
