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

            //var_dump($user);

            $user->setUsername($_POST["username"]);
            $user->setPassword($_POST["password"]);
            $user = $userdao->validateUser($user);

            //var_dump($user);

            // Validate credentials
            /*
                Test whether $stmt returned a valid row (object) or nothing (boolean)
            */
            if (is_object($user))
            {
                // Everything is correct, so start a new session
                session_start();

                
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $user->getId();
                $_SESSION["username"] = $user->getUsername();
                $_SESSION["usertype"] = $user->getIdType();
                
                $user = null;
                $userdao = null;
                $db->closeConn();
                
                // Redirect user to welcome page

                if ($_SESSION["usertype"] == "1")
                    header("location: main_supervisor.php");
                else
                    header("location: main_users.php");
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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="https://getbootstrap.com/favicon.ico">

        <title>Signin Template for Bootstrap</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo ROOT_PATH; ?>assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo ROOT_PATH; ?>assets/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <form class="form-signin" method="post">
        <div class="form-group">
            <img class="mb-4" src="./css/bootstrap-solid.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            
            <label for="login" class="sr-only">Username</label>
            <input type="text" id="login" name="username" class="form-control" placeholder="Username" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
            
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="password"  class="form-control" placeholder="Password">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login" name="submit">              
        </div>
        <!--<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>-->
        <label>
            <span class="help-block"><?php echo $login_err; ?></span>
        </label>
        <p class="mt-5 mb-3 text-muted">© 2018 Copyright:<a href=""> Loteria Lotoplaza</a></p>
    </form> 
</body>
</html>