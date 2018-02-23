<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheets/index.css" />
    <script type="text/javascript" src = "scripts/filterQuestions.js"></script>
    <title>NullPointerException</title>
</head>
<body>
    <img class = "nav-brand" src = "img/logo-old.png"/>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
        <ul class = "navbar-nav">
            <li class = "nav-item">
                <a class = "nav-link" href = "index.php">Home</a>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" href = "signup.php">Sign Up/Login</a>
            </li>
            <li class = "nav-item">
                <a class = "nav-link active" href = "qa.php">Q&A</a>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" href = "career.php">Careers</a>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" href = "tutorial.php">Tutorial zone</a>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" href = "community.php">Community</a>
            </li>
        </ul>
        <?php
        if (isset($_SESSION["username"])) {
            echo '<ul class="navbar-nav ml-auto">';
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href = "#"' . $_SESSION["username"] . '></a>';
            echo '</li>';
            echo '</ul>';
        }
        ?>
    </nav>
    <br />
    <br />
    <br />
    <div class = "container">
        <div class = "row">
            <h2>Featured Questions</h2>
        </div>
        <br/>
        <div class = "row">
            <div class="form-group">
                <label>Filter questions:</label>
                <select id = "select" class="form-control" onchange = "Download()">
                    <option>Hot</option>
                    <option>Top</option>
                    <option>New</option>
                </select>
            </div>
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
</body>
</html>