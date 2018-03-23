<?php session_start();
include "connect.php"; ?>
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
    <?php include ("header.html"); ?>
    <br/>
    <br/>
    <div class = "container">
        <div class = "row">
            <h1>Python 3</h1>
        </div>
    </div>
    <br/>
    <div class = "container">
        <div class="row">
            <div class = "col-lg-5">
                <h3>About this language:</h3>
            </div>
        </div>
        <div class = "row">
            <div class = "col-lg-5">
                <p>Python is powerful... and fast; plays well with others; runs everywhere; is friendly & easy to learn; is Open.</p>
                <i>-Taken from the official Python 3 website</i>
            </div>
        </div>
        <br/>
        <br/>
        <div class = "row">
            <div class = "col-lg-5">
                <h3>Documentation links</h3>
                <ul>
                    <li>
                        <a class = "link" href = "https://docs.python.org/3/">Official documentation</a>
                    </li>
                    <li>
                        <a class = "link" href = "https://wiki.python.org/moin/BeginnersGuide">Beginner's Guide</a>
                    </li>
                    <li>
                        <a class = "link" href = "https://devguide.python.org/">Developer's Guide</a>
                    </li>
                </ul>
            </div>
            <div class = "col-lg-2">
            </div>
            <div class = "col-lg-5">
                <h3>Tutorial links</h3>
                <ul>
                    <li>
                        <a class = "link" href = "https://www.learnpython.org/">LeanPython</a>
                    </li>
                    <li>
                        <a class = "link" href = "https://www.codecademy.com/learn/learn-python">CodeCademy</a>
                    </li>
                    <li>
                        <a class = "link" href = "https://www.youtube.com/watch?v=Vxw1b8f_yts">Python Tutorial - YouTube</a>
                    </li>
                </ul>
            </div>
        </div>
        <br />
        <br />
        <div class="row">
            <div class = "col-lg-5">
                <h3>Example programs:</h3>
                <ul>
                  <li><a href = "sampleprograms/python3/helloworld.php">Simple Hello world</a></li>
                  <li><a href = "sampleprograms/python3/variables.php">Variables</a></li>
                  <li><a href = "sampleprograms/python3/ifelse.php">If/else/else if</a></li>
                  <li><a href = "sampleprograms/python3/functions.php">Functions</a></li>
                  <li><a href = "sampleprograms/python3/classes.php">Classes</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
