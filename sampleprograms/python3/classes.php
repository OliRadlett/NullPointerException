<?php

/**
 *
 * Page to display classes sample program for Python 3
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
                    class Person:

                      def __init__(self, name, age):

                        self.name = name
                        self.age = age

                      def setAge(self, age):

                        self.age = age


                    person = Person("Oli", 17)
                    print (person.name)
                    print (person.age)
                    person.setAge(18)
                    print (person.age)
                  </code>
                </pre>
            </div>
        </div>
        <div class = "row">
          <div class = "col-lg-12">
            <p>
                This example demonstrates how a basic class works in Python3. A class is a collection of variables and functions that can be used to create multiple objects. In this example, we create a class called Person, containing two functions. The first, <i>__init__</i> is known as a constructor. A constructor is a function that is ran every time an object is created from a class. This function takes 3 parameters: <i>self</i>, <i>name</i> and <i>age</i>. <i>self</i> is a reference to the actual class and is not provided as a parameter when calling the constructor. The other function in the class is <i>setAge</i>, and is used to change the value of the <i>age</i> variable. Again, the <i>self</i> parameter is a reference to the class and is ignored when calling the function.
            </p>
            <p>
                The next stage of this example is to create a new object using the Person class, supplying <i>Oli</i> as the name parameter and <i>17</i> as the age parameter. Next, the example prints out the value of <i>person.name</i> and <i>person.age</i>. After this, the example calls <i>person.setAge</i> to change the age value of the object to <i>18</i> and prints out the new <i>age</i> value.
            </p>
            <p>
                This example produces the output
            </p>
            <pre>
              <code class = "language-python">
                Oli
                17
                18
              </code>
            </pre>
          </div>
        </div>
    </div>
</body>
</html>
