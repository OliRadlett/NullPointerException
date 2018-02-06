<!DOCTYPE html>
<?php session_start();
include "connect.php"; ?>
<head>
    <title>NullPointerException</title>
    <link href="stylesheets/ask.css" rel="stylesheet" />
    <?php $connection = connect() ?>
</head>
<body>
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
    <div id = "ask-form">
        <form method = "post" action = "/processquestion.php">
            <h4>Title:</h4>
            <input type = "text" name = "title" />
            <h4>Question:</h4>
            <textarea name = "question" id="question-box"></textarea>
            <input type = "submit" value = "Ask question!"? />
        </form>
    </div>
</body>