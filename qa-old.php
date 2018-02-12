<!DOCTYPE html>
<?php session_start();
include "connect.php"; ?>
<head>
    <title>NullPointerException</title>
    <link href="stylesheets/qa.css" rel="stylesheet" />
    <script type = "text/javascript" src = "scripts/filterQuestions.js"></script>
    <?php $connection = connect();

    if (!$connection) {

        die("Connection failed: " . mysqli_connect_error());

    }

    ?>
</head>
<body onload = "Download('hot')">
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
    <div id = "ask">
        <h3 id = "ask-text"><a href = "/ask.php">Ask new question!</a></h3>
    </div>
        <table id = "questions-container">
            <tr id = "questions-header">
                <th id = "hot"><a class = "notButton" onclick = "Download('hot')" href = "#">Hot</a></th>
                <th id = "top"><a class = "notButton" onclick = "Download('top')" href = "#">Top</a></th>
                <th id = "new"><a class = "notButton" onclick = "Download('new')" href = "#">New</a></th>
            </tr>
        </table>
        <table id = "questions-container2">
    </table>
</body>