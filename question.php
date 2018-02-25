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
    <img class = "nav-brand" src = "img/logo-old.png"/>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
        <ul class = "navbar-nav">
            <li class = "nav-item">
                <a class = "nav-link" href = "index.php">Home</a>
            </li>
            <?php
                if (isset($_SESSION["username"])) {
                    echo '<li class = "nav-item">';
                    echo '<a class = "nav-link" href = "account.php">' . $_SESSION["username"] . '</a>';
                    echo '</li>';
                } else {
                    echo '<li class = "nav-item">';
                    echo '<a class = "nav-link" href = "signup.php">Sign Up/Login</a>';
                    echo '</li>';
                }
            ?>
            <li class = "nav-item">
                <a class = "nav-link active" href = "qa.php">Q&A</a>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" href = "career.php">Careers</a>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" href = "tutorial.php">Tutorial zone</a>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" href = "comunity.php">Community</a>
            </li>
        </ul>
    </nav>
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