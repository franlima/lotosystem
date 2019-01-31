<?php
    
    //require_once('checksession.php');

    // Define variables and initialize with empty values
    $username = $password = "";
    $username_err = $password_err = "";
    $login_err = "";

    // Processing form data when form is submitted
    if (isset($_POST['submit']))
    {
        // Check if username is empty
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter username.";
        }
        else
        {
            $username = trim($_POST["username"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter password.";
        }
        else
        {
            $password = trim($_POST["password"]);
        }


        if(empty($username_err) && empty($password_err))
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

            $user->setUsername($_POST["username"]);
            $user->setPassword($_POST["password"]);

            // Validate credentials
            if (count($userdao->validateUser($user)))
            {
                // Everything is correct, so start a new session
                session_start();
                                        
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $user->getId();
                $_SESSION["username"] = $user->getUsername();
                
                $user = null;
                $userdao = null;
                $db->closeConn();
                
                // Redirect user to welcome page
                header("location: welcome.php");
                exit();
            }
            else
            {
                // Display an error message if password is not valid
                $login_err =  "The login/password combination are not valid.";
                $user = null;
                $userdao = null;
                $db->closeConn();
            }
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>
<body>
<div class="wrapper">
    <form class="form-group" method="post">
      <img class="mb-4" src="./Signin Template for Bootstrap_files/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="login" class="sr-only">Username</label>
      <input type="email" id="login" class="form-control" placeholder="Username" name="username">
      <span class="help-block"><?php echo $username_err; ?></span>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password">
      <span class="help-block"><?php echo $password_err; ?></span>
      <div class="checkbox mb-3">
        <label>
            <span class="help-block"><?php echo $login_err; ?></span>
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
    </form>
</div>
</body>
<div id="footerWrapper">
        <div class="footer">
            <p class="site">Copyright © 2018 Loteria Lotoplaza LTDA - ME. All rights reserved.</p>
    </div> 
</html>