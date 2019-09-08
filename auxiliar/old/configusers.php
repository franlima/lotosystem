<?php
    
    require_once ('/Xampp/htdocs/syscontrol/dao/db.php');
    require_once ('/Xampp/htdocs/syscontrol/dao/usersdao.php');
    require_once ('/Xampp/htdocs/syscontrol/model/users.php');
    
    /* Attempt to connect to MySQL database */
    $db = new db ();
    
    // Check connection
    if($db  === null){
        die("ERROR: Could not connect. ");
        header("location: login.php");
    }
    
?>