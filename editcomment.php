<?php

/**
 *
 * Page to allow the user to edit one of their comments
 *
 * @author Oli Radlett <o.radlett@gmail.com>
 *
 */

// Start PHP session
session_start();

// Include core files
include "database.php";
include "core.php";
include "questionFuncs.php"

?>
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

//      Create new Database object
        $database = new Database();

//      Include universal header file
    	include ("header.html");

//    	Check if the user is logged in
        if (!isset($_SESSION["username"])) {

//          If they aren't logged in close headers and redirect the user to an error page
            session_write_close();
            Util::redirect("error.php?error=notloggedin");

        }

//      Check if the user logged in is the same user who created the comment they are trying to edit
        if (!isUsersComment($database, $_SESSION["username"], $_GET["id"])) {

//          If the current logged in user did not create the comment they are trying to edit close headers and redirect the user to an error page
            session_write_close();
            Util::redirect("error.php?error=unauth");

        }

    ?>
    <br />
    <br />
    <br />
    <br />
    <br />
    <div class = "container">
        <form method = "post" action = <?php echo "'processeditcomment.php?id=" . $_GET["id"] . "&qid=" . $_GET["qid"] . "'"; ?>>
            <div class="form-group">
                <label><u>Comment:</u></label>
                <input type = "text" class = "form-control" value=<?php echo "'" . GetComment($database, $_GET["id"]) . "'";?> placeholder=<?php echo "'" . GetComment($database, $_GET["id"]) . "'";?> name = "comment"/>
            </div>
            <button type="submit" class="btn btn-primary">Edit comment</button>
        </form>
    </div>

    <!--Keep at end of document for page load times-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
