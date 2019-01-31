<?php
     
    // Everything is correct, so start a new session
    session_start();
    
     // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false)
    {
        header("location: login.php");
        exit;
    }
?>