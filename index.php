<!DOCTYPE html>
<?php session_start();
include "connect.php"; ?>
<head>
    <title>NullPointerException</title>
    <link href="stylesheets/index.css" rel="stylesheet" />
    <script type = "text/javascript" src = "scripts/catify.js"></script>
    <?php
    
    //TEMP
    $server_online = true;

    $connection = connect();

    if (!$connection) {

        $db_online = false;
        die("Connection failed: " . mysqli_connect_error());

    } else {

        $db_online = true;

        $address = $_SERVER["REMOTE_ADDR"];
        $_SESSION["IPADDR"] = $address;
        $date = date("d/m/Y");
        $time = date("h:ia");

        $query = "INSERT INTO `visits` (`address`, `date`, `time`) VALUES ('$address', '$date', '$time');";
        
        if (!mysqli_query($connection, $query)) {
    
            echo mysqli_error($connection);
    
        }

    }

    ?>
</head>

<body id = "body" onload = "DetermineStateOfMeow()">
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
    <br />
    <br />
    <br />
    <div id = "about">
        <h4>About NullPointerException</h4>
        <p>NullPointerException is a place for developers to ask for help on any aspects of programming and to answer other users questions. It is also a social space for like minded developers, and a site designed to find developers their perfect job.</p>
    </div>
    <div id="footer">
        <p>&emsp; </p>
        <p>Null Pointer Exception</p>
        <p>&emsp; &emsp;</p>
        <?php if ($server_online) { echo "Server: &nbsp; <img src='img/online.png'/>"; } else { echo "Server: &nbsp; <img src='img/offline.png'/>"; } ?>
        <p>&emsp;</p>
        <?php if ($db_online == true) { echo "Database: &nbsp; <img src='img/online.png'/>"; } else { echo "Database: &nbsp; <img src='img/offline.png'/>"; } ?>
    </div>
</body>
<?php mysqli_close($connection); ?>