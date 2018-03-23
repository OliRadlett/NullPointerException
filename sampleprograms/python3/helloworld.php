<?php session_start();
include "../../connect.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel = "stylesheet" href = "../../stylesheets/index.css" />
    <link rel = "stylesheet" href = "../../prism/prism.css" />
    <script type="text/javascript" src = "../../prism/prism.js"></script>
    <title>NullPointerException</title>
</head>
<body>
    <?php include ("../../header.html"); ?>
    <br/>
    <br/>
    <div class = "container">
        <div class = "row">
            <h1>Example helloworld program - Python3</h1>
        </div>
    </div>
    <br/>
    <div class = "container">
        <div class="row">
            <div class = "col-lg-12">
                <pre>
                  <code class = "language-python">
                    print ("Hello World!")
                  </code>
                </pre>
            </div>
        </div>
        <div class = "row">
          <div class = "col-lg-12">
            <p>
              This example shows the traditional "Hello World!" program, written in Python3. It's incredibly simple, and works by calling the inbuild <i>print</i> function, and supplying the string <i>"Hello World!"</i> as the parameter. This produces the output:
            </p>
            <pre>
              <code class = "language-python">
                Hello World!
              </code>
            </pre>
          </div>
        </div>
    </div>
</body>
</html>
