<?php
     
    // Include config file
    require_once ('configusers.php');

    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }
 
    $user = new users();
    $userdao = new usersdao($db);

    $user->setUsername($_POST["username"]);
    $user->setPassword($_POST["password"]);

    phpAlert($_POST["username"]. " " .$_POST["password"]);

    // Validate credentials
    if ($userdao->validateUser($user) !== null)
    {
         // Everything is correct, so start a new session
         session_start();
                                
         // Store data in session variables
         $_SESSION["loggedin"] = true;
         $_SESSION["id"] = $user->getId();
         $_SESSION["username"] = $user->getUsername();                            
         
         // Redirect user to welcome page
         header("location: welcome.php");
     }
     else
     {
         // Display an error message if password is not valid
         echo "The password you entered was not valid.";
     }
?>