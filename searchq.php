<?php session_start();
include "connect.php"; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheets/index.css" />
    <script type="text/javascript" src = "scripts/filterSearchQuestions.js"></script>
    <title>NullPointerException</title>
</head>
<body>
	<?php include 'header.html';?>
	<br/>
	<br/>
	<div class = "container">
		<div class = "row">
			<div class = "col-sm-12">
				<h2>Search:</h2>
			</div>
		</div>
		<div class = "row">
			<div class = "col-sm-12">
				<form class = "form-inline" onsubmit="return false;">
					<div class="form-group mx-sm-3 mb-2">
						<input class = "form-control" placeholder="Search question..." id = "search"/>
					</div>
					<button type="submit" class="btn btn-primary mb-2" onclick = "return Download()">Search</button>
				</form>
			</div>
		</div>
		<br/>
		<div class = "row">
			<div class = "col-sm-12">
				<h4>Results:</h4>
			</div>
		</div>
		<div class = "row">
            <div class = "col-sm-12">
                <div class = "table-responsive">
                    <table class = "table table-bordered table">
                        <thead>
                            <th><u>Title</u></th>
                            <th><u>Score</u></th>
                        </thead>
                        <tbody id = "questionsTable">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
	</div>

	<!--Keep at end of document for page load times-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>