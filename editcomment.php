<?php session_start();
include "connect.php";
include "questionFuncs.php"?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheets/index.css" />
    <script type="text/javascript" src = "scripts/logo-fix.js"></script>
    <title>NullPointerException</title>
</head>
<body>
    <?php

        $connection = connect();
    	  include ("header.html");

        if (!isset($_SESSION["username"])) {

            session_write_close();
            header("Location: /error.php?error=notloggedin");

        }

        if (!isUsersComment($connection, $_SESSION["username"], $_GET["id"])) {

          session_write_close();
          header("Location: /error.php?error=unauth");

        }

    ?>
    <br />
    <br />
    <br />
    <br />
    <br />
    <div class = "container">
        <form method = "post" action = <?php echo "'/processeditcomment.php?id=" . $_GET["id"] . "&qid=" . $_GET["qid"] . "'"; ?>>
            <div class="form-group">
                <label><u>Comment:</u></label>
                <input type = "text" class = "form-control" value=<?php echo "'" . GetComment($connection, $_GET["id"]) . "'";?> placeholder=<?php echo "'" . GetComment($connection, $_GET["id"]) . "'";?> name = "comment"/>
            </div>
            <button type="submit" class="btn btn-primary">Edit comment</button>
        </form>
    </div>

    <!--Keep at end of document for page load times-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>