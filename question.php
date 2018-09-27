<?php

/**
 *
 * Page to display a question to the user as well as show comments on the question
 *
 * @author Oli Radlett
 *
 */

//  Start PHP session and include required files
    session_start();
    include "database.php";
    include "questionFuncs.php"

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
    <script type="text/javascript" src = "scripts/getUserVotes.js"></script>
    <br/>
    <br/>
    <br/>
    <?php

//      Not sure what this function is for?
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

//      Create and run a MySQL query to select all the attributes from the database for the question with the id attribute provided in the URL
        $database->query("SELECT * FROM `questions` WHERE `id` = '" . $_GET["id"] . "'");

        // Declare multiple variables on the same line
        $qTitle = $qContent = $qVotes = $qTime = $qAuthor = "";

//      Iterate over the attributes returned from the database and assign them to the variables created above
        while($row = $database->fetchAssoc()) {

            $qTitle = $row["title"];
            $qContent = $row["question"];
            $qVotes = $row["votes"];
            $qTime = $row["time"];
            $qAuthor = $row["author"];

        }

    ?>
    <div class = "container">
        <div class = "row">
            <div class = "col-lg-10">
                <h2>
                    <?php

                        echo $qTitle;

                    ?>
                </h2>
            </div>
        </div>
        <br/>
        <div class = "row">
            <div class = "col-lg-10">
                <?php

//                  Display the question, including adding syntax highlighting for code blocks

//                  Create an array from the question content array by splitting it line by line
                    $questionArray = explode("\n", $qContent);
//                  Call SplitLines function on newly created array
                    $splitArray = SplitLines($questionArray);

//                  Iterate over each line of the array
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
              <a href = "#" onclick = "Vote(`up`)"><img src = "img/up_grey.png" id = "UpArrow"/></a>
              <h4><?php echo $qVotes ?></h4>
              <a href = "#" onclick = "Vote(`down`)"><img src = "img/down_grey.png" id = "DownArrow"/></a>
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

          GetComments($_GET["id"], $database);

         ?>
    </div>
</body>
