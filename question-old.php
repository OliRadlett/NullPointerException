<!DOCTYPE html>
<?php session_start();
include "connect.php"; 
include "questionFuncs.php";
?>
<head>
    <title>NullPointerException</title>
    <link href="stylesheets/question.css" rel="stylesheet" />
    <script type = "text/javascript" src = "scripts/questionHeightFix.js"></script>
    <?php $connection = connect() ?>
</head>
<body onload = "SetHeight()">
    <div id="header">
        <img src="img/logo.png" />
        <div id="header_buttons">
            <h3 class="header_button"><a class = "header_button_link" href = "http://www.nullpointerexception.ml/">Home</a></h3>
            <?php
            if (isset($_SESSION["username"])) {

                echo '<h3 class = "header_button"><a class = "header_button_link" href="account.php">My Account</a></h3>';

            } else {

                echo '<h3 class = "header_button"><a class = "header_button_link" href="signup.php">Sign Up/Login</a></h3>';

            }
            ?>
            <h3 class="header_button"><a class = "header_button_link" href = "http://www.nullpointerexception.ml/qa.php">Q&A</a></h3>
            <h3 class="header_button">Careers</h3>
            <h3 class="header_button">Tutorial zone</h3>
            <h3 class="header_button">Community</h3>
        </div>
    </div>
    <div id = "profile">
    <?php
    if (isset($_SESSION["username"])) {

        echo "<p id = 'profile-username'>" . $_SESSION["username"] . "</p><a href = 'http://www.nullpointerexception.ml/logout.php'><img id = 'profile-logout' src = 'img/logout.png' /></a>";

    } else {

        echo "<p id = 'profile-username'><a class = 'header_button_link' href='signup.php'>Login</a></p>";

    }
    ?>
    </div>
    <div id = "question-container">
        <?php
            
            $qID = $_GET["id"];
            $query = "SELECT * FROM `questions` WHERE `id` = '$qID'";
            $result = mysqli_query($connection, $query);
            
            $qTitle;
            $qContent;
            $qVotes;
            $qTime;

            if ($result) {
                
                while($row = mysqli_fetch_assoc($result)) {
                    
                    $qTitle =  $row["title"];
                    $qContent =  $row["question"];
                    $qVotes =  $row["votes"];
                    $qTime =  $row["time"];

                }

            }

        ?>
        <h3 id = "question-title"><u><?php echo $qTitle; ?></u></h3>
        <p id = "question-content"><?php echo $qContent; ?></p>
    </div>
    <div id = "votes">
        <br/>
        <?php
        
            if (isset($_SESSION["username"])) {

                if (UsrVoted($_SESSION["id"], $qID, $connection)) {

                    if (Upvoted($_SESSION["id"], $qID, $connection)) {

                        echo "<img id = 'numVotes' src = 'img/up_green.png' />";
                        echo "<p id = 'numVotes'>" . $qVotes . "</p>";
                        echo "<img id = 'numVotes' src = 'img/down_grey.png' />";

                    } else {

                        echo "<img id = 'numVotes' src = 'img/up_grey.png' />";
                        echo "<p id = 'numVotes'>" . $qVotes . "</p>";
                        echo "<img id = 'numVotes' src = 'img/down_red.png' />";
                        
                    }

                } else {

                    if (UsrVoted($_SESSION["id"], $qID, $connection)) {

                        echo "<img id = 'numVotes' src = 'img/up_grey.png' />";
                        echo "<p id = 'numVotes'>" . $qVotes . "</p>";
                        echo "<img id = 'numVotes' src = 'img/down_grey.png' />";
    
                    }

                }

            } else {

                echo "<img id = 'numVotes' src = 'img/up_grey.png' />";
                echo "<p id = 'numVotes'>" . $qVotes . "</p>";
                echo "<img id = 'numVotes' src = 'img/down_grey.png' />";

            }

        ?>
    </div>
</body>