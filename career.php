<?php

/**
 * Landing page for the website
 *
 * @author Oli Radlett <o.radlett@gmail.com>
 * @since Commit 1
 *
 */

session_start();
include "database.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheets/index.css" />
    <script type="text/javascript" src = "scripts/logo-fix.js"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="/img/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/icon/favicon-16x16.png">
    <link rel="manifest" href="/img/icon/site.webmanifest">
    <link rel="mask-icon" href="/img/icon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#9f00a7">
    <meta name="theme-color" content="#ffffff">
    <title>NullPointerException</title>
</head>

<body>

<?php

// Create new Database object
$database = new Database();

// Include the universal page header
include ("header.html");

?>

<br />
<br />
<br />
<br />
<br />
<div class="container marketing">
    <div class="row">
        <div class="col-lg-5">
            <h2>Looking for work</h2>
            <p>Get your skills and experience seen by the people who matter and find jobs that match your talents and passion.</p>
            <p><a class="btn btn-secondary" href="findjobs.php?#" role="button">Find jobs &raquo;</a></p>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-5">
            <h2>Looking to hire</h2>
            <p>Find the perfect fit for your vacant positions.</p>
            <br/>
            <p><a class="btn btn-secondary" href="findpeople.php" role="button">Find employees &raquo;</a></p>
        </div>
    </div>

    <!--Keep at end of document for page load times-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
