<?php
    
    require_once('checksession.php');

    // Processing form data when form is submitted
    if (isset($_POST['password']) && isset($_SESSION["id"]))
    {
        // Include config file
        require_once ('/Xampp/htdocs/syscontrol/dao/db.php');
        require_once ('/Xampp/htdocs/syscontrol/dao/usersdao.php');
        require_once ('/Xampp/htdocs/syscontrol/model/users.php');
        
        /* Attempt to connect to MySQL database */
        $db = new db ();
        
        // Check connection
        if($db  === null){
            die("ERROR: Could not connect. ");
            exit();
        }
    
        $user = new users();
        $userdao = new usersdao($db);
        $user = $userdao->find($_SESSION["id"]);
        $new_password = trim($_POST['password']);

        if (is_object($user))
        {
            $user->setPassword($new_password);

            if ($userdao->updatePassword($user) != null)
            {
                
                $user = null;
                $userdao = null;
                $db->closeConn();
                
                // Password updated successfully. Destroy the session, and redirect to login page
                //header("location: welcome.php");
                $response = "Password changed";
            }
            else
            {
                // Display an error message if password is not valid
                $response =  "Oops! Something went wrong. Please try again later.";
                $user = null;
                $userdao = null;
                $db->closeConn();
            }
        }
        else {
            $response = "Not valid user logged! Please redo login!";
        }
    }
    echo $response;
?>