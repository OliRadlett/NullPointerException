<?php

/**
 *
 * Page to display functions sample program for Python 3
 *
 * @author Oli Radlett <o.radlett@gmail.com>
 *
 */

//  Start PHP session
session_start();

?>
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
    <?php

//      Include the special header file with fixed links for the tutorial pages
        include ("../header.html");

    ?>
    <br/>
    <br/>
    <div class = "container">
        <div class = "row">
            <h1>Examples of functions - Python3</h1>
        </div>
    </div>
    <br/>
    <div class = "container">
        <div class="row">
            <div class = "col-lg-12">
                <pre>
                  <code class = "language-python">
                    def say_hello():

                      print ("Hello!")


                    say_hello()
                  </code>
                </pre>
            </div>
        </div>
        <div class = "row">
          <div class = "col-lg-12">
            <p>
                This example demonstrates how a basic function works in Python3. A function is block of code that you can reuse multiple times. In this example, we declare a new function called <i>say_hello</i> by using the <i>def</i> keyword. Inside the function body we make a call to the in-built <i>print</i> function to output the message <i>Hello!</i>. We then call the function.
            </p>
            <p>
                This example produces the output
            </p>
            <pre>
              <code class = "language-python">
                Hello!
              </code>
            </pre>
          </div>
        </div>
    </div>
</body>
</html>
