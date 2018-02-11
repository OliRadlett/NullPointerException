<!DOCTYPE html>
<html>

<head>
    <title>NullPointerException - Sign Up</title>
    <link href = "stylesheets/signup.css" rel = "stylesheet" />
</head>

<body>
<div id = "signup">
    <h1>Sign Up!</h1>
    <form method = "post" action = "processsignup.php">
        <label class = "signup_elements">Username:</label>
        <br />
        <input class = "signup_elements" type="text" name="username" />
        <br />
        <label class = "signup_elements">Password:</label>
        <br />
        <input class = "signup_elements" type="password" name="password" />
        <br />
        <label class = "signup_elements">First name:</label>
        <br />
        <input class = "signup_elements" type="text" name="firstname" />
        <br />
        <label class = "signup_elements">Last name:</label>
        <br />
        <input class = "signup_elements" type="text" name="lastname" />
        <br />
        <label class = "signup_elements">Email address:</label>
        <br />
        <input class = "signup_elements" type="text" name="emailaddress" />
        <br />
        <input class = "signup_elements" type="submit" value="Sign Up">
    </form>
</div>
<div id = "login">
    <form method = "post" action = "processlogin.php">
        <h1 class = "login_elements">Login!</h1>
        <label class = "login_elements">Username</label>
        <br />
        <input class = "login_elements" type = "text" name = "username">
        <br />
        <label class = "login_elements">Password</label>
        <br />
        <input class = "login_elements" type = "password" name = "password">
        <br / >
        <input class = "login_elements" type = "submit" value = "Login" />
    </form>
</body>

</html>
<?php // Make it do some validations to make sure you can't use the same username and you have to enter values for all of them and they have to be a certain length ?>