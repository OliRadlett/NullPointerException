<?php

/**
 *
 * Page to display if/elif/else sample program for Python 3
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
            <h1>Examples of if, elif and else - Python3</h1>
        </div>
    </div>
    <br/>
    <div class = "container">
        <div class="row">
            <div class = "col-lg-12">
                <pre>
                  <code class = "language-python">
                    number = 7

                    if (number == 1):

                      # Never happens because number = 7
                      print ("Your number is 1!")

                    elif (number == 7):

                      # This happens because number = 7
                      print ("Your number is 7!")

                    else:

                      # Never happens because previous condition is met
                      print ("Your number is not 1 or 7!")
                  </code>
                </pre>
            </div>
        </div>
        <div class = "row">
          <div class = "col-lg-12">
            <p>
              This example shows how logical decisions are used in Python 3. First, we declare an integer called <i>number</i> and set it equal to 7. Next, we use the first of Python3's logical statements, <i>if</i>. An <i>if</i> statement check if a condition is met. In this statement, we are checking if the number variable is equal to <i>1</i>. If it was (which it isn't), the program would run the branch inside the if statement, and print <i>Your number is 1!</i>. Since number is not equal to 1 however, we move onto the next statement.
            </p>
            <p>
                The next logical statement in Python3 is called <i>elif</i>. In other languages this is commonly known as <i>else if</i>. The <i>elif</i> statement cannot be used before an <i>if</i> statement, or after an <i>else</i> statement. <i>elif</i> stands for else if and is use when a <i>if</i> statement doesn't pass and you want to run another <i>if</i>, but only if the previous <i>if</i> fails. In out example, the <i>elif</i> statement checks if the number variable is equal to 7. Since it is, the program prints <i>Your number is 7!</i> and then exits.
            </p>
            <p>
                The final logical statement in Python3 is called <i>else</i>. <i>else</i> can only be used after an <i>if</i> or <i>elif</i>. <i>else</i> is used for when you want to run a branch if none of your <i>if</i> or <i>elif</i> statements are met. In this example, if none of the previous logical statements are met, the program should print <i>Your number is not 1 or 7!</i>. However, since the previous elif statement is met, this branch of the program is never reached.
            </p>
            <p>
                This example produces the output
            </p>
            <pre>
              <code class = "language-python">
                Your number is 7!
              </code>
            </pre>
          </div>
        </div>
    </div>
</body>
</html>
