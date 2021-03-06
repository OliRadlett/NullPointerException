<?php

/**
* Page containing sign up and login forms
* 
* @author Oli Radlett <o.radlett@gmail.com>
* @since Commit 1
* 
*/

session_start();
// Database included for future page logging
include "database.php";

?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>NullPointerException</title>
</head>

<body>

    <?php

        // Include the universal page header
        include ("header.html");

    ?>
    
    <br />
    <br />
<div class = "container">
    <div class="row">
          <div class="col-lg-4">
                <form method = "post" action = "processsignup.php">
                    <div class="form-group">
                        <h2><u>Sign up</u></h2>
                        <label><u>Username</u></label>
                        <input type="username" class="form-control" name = "username" placeholder="Username" required="true">
                        <br/>
                         <label><u>Password</u></label>
                        <input type="password" class="form-control" name = "password" placeholder="Password" required="true">
                        <br/>
                         <label><u>First name</u></label>
                        <input class="form-control" name = "firstname" placeholder="First name" required="true">
                        <br/>
                         <label><u>Last name</u></label>
                        <input class="form-control" name = "lastname" placeholder="Last name" required="true">
                        <br/>
                         <label><u>Email address</u></label>
                        <input type="email" class="form-control" name = "emailaddress" placeholder="Email address" required="true">
                    </div>
                 <button type="submit" class="btn btn-primary">Sign Up!</button>
                </form>
            </div>
        <div class="col-lg-3">
        </div>
        <div class="col-lg-4">
            <form method = "post" action = "processlogin.php">
                <div class="form-group">
                    <h2><u>Login</u></h2>
                     <label><u>Username</u></label>
                    <input type="username" class="form-control" name = "username" placeholder="Username">
                    <br/>
                     <label><u>Password</u></label>
                    <input type="password" class="form-control" name = "password" placeholder="Password">
                </div>
            <button type="submit" class="btn btn-primary">Login!</button>
            </form> 
        </div>
    </div>
</div>
<!--Keep at end of document for page load times-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>