<?php session_start();
include "connect.php"; ?>
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

    	$connection = connect();

        $address = $_SERVER["REMOTE_ADDR"];
        $_SESSION["IPADDR"] = $address;
        $date = date("d/m/Y");
        $time = date("h:ia");
        $query = "INSERT INTO `visits` (`address`, `date`, `time`) VALUES ('$address', '$date', '$time');";

        echo mysqli_error($connection);

    	  include ("header.html");
    ?>
    <br />
    <br />
    <br />
    <br />
    <br />
    <div class="container marketing">
        <div class="row">
          <div class="col-lg-4">
            <h2>Q&A</h2>
            <p>No matter your programming experience, there will always be times when mysterious bugs allude you, or strange syntax bamboozles you.</p>
            <p>NullPointerException provides a platform for you to not only ask questions, but to use your own knowledge to answer others questions.</p>
            <p><a class="btn btn-secondary" href="qa.php" role="button">Go to Q&A &raquo;</a></p>
          </div>
          <div class="col-lg-4">
            <h2>Careers</h2>
            <p>Bringing together employers and employees to match talent and vacancies.</p>
            <p>NullPointerException allows people looking for a job to showcase their own experience and targets relevant jobs at them, and allows employers to find the perfect employees to fill their vacancies.
            <p><a class="btn btn-secondary" href="#" role="button">Go to Careers &raquo;</a></p>
          </div>
          <div class="col-lg-4">
            <h2>Tutorial Zone</h2>
            <p>The Tutorial Zone is aimed at newer programmers looking to get ahead of the competition.</p>
            <p>We have provided a collection of custom written tutorials, documentation, and useful links, especially selected to make learning to code less daunting.</p>
            <p><a class="btn btn-secondary" href="tutorial.php" role="button">Go to Tutorial Zone &raquo;</a></p>
          </div>
      </div>

    <!--Keep at end of document for page load times-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
