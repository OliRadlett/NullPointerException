<?php

session_start();
include "database.php";

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheets/index.css" />
    <link rel="stylesheet" href="stylesheets/tag-autocomplete.css" />
    <script type="text/javascript" src = "scripts/core.js"></script>
    <script type="text/javascript" src = "scripts/autocomplete.js"></script>
    <title>NullPointerException</title>
</head>
<body>
<?php

include ("header.html");

?>
<br />
<br />
<br />
<div class = "container">
    <div class = "row">
        <h2>Find jobs</h2>
    </div>
    <br/>
    <div class = "row">
        <div class="col-sm-8">
            <form autocomplete="off" action="#">
                <label>Tags:</label>
                <br/>
                <div class="autocomplete">
                    <input type="text" id="tag-input" oninput="showAddTagButton()"/>
                    <button id="addTagButton" class="btn-primary btn" hidden onclick="addTagToFilter()">Add tag</button>
                    <div id="tagsDiv"></div>
                </div>
            </form>
            <br/>
        </div>
        <div class = "col-sm-2"></div>
        <div class = "col-sm-2">
            <br/>
            <button id = "large_button" class = "text-right btn btn-primary" onclick = "window.location.href = 'searchJobs.php';"><h5>Search jobs</h5></button>
        </div>
    </div>
    <div class = "row">
        <div class = "col-sm-12">
            <div class = "table-responsive">
                <table class = "table table-bordered table">
                    <thead>
                    <th><u>Job title</u></th>
                    <th><u>Location</u></th>
                    <th><u>Salary</u></th>
                    <th><u>Tags</u></th>
                    </thead>
                    <tbody id = "jobsTable">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--Keep at end of document for page load times-->
<script type="text/javascript" src = "scripts/filterJobs.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>