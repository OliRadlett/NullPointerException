<script type="text/javascript" src = "scripts/addActive.js"></script>
<img class = "nav-brand" id = "logo" src = "img/logo.png"/>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
    <ul class = "navbar-nav">
        <li class = "nav-item" id = "index">
            <a class = "nav-link" href = "index.php">Home</a>
        </li>
        <li class = "nav-item" id = "signup">
            <a class = "nav-link" href = "signup.php">Sign Up/Login</a>
        </li>
        <li class = "nav-item" id = "qa">
            <a class = "nav-link" href = "qa.php">Q&A</a>
        </li>
        <li class = "nav-item" id = "career">
            <a class = "nav-link" href = "career.php">Careers</a>
        </li>
        <li class = "nav-item" id = "tutorial">
            <a class = "nav-link" href = "tutorial.php">Tutorial zone</a>
        </li>
        <li class = "nav-item" id = "community">
            <a class = "nav-link" href = "community.php">Community</a>
        </li>
    </ul>
</nav>
<?php
function redirect($url) {

    if (!headers_sent()) {    
        
        header('Location: '.$url);
        exit;
        
    } else {

        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    
    }

}
?>