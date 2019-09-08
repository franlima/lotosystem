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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style type="text/css">
        body{ font: 14px sans-serif; margin: auto;}
        .wrapper{ width: 350px; padding: 20px; margin: auto; }
    </style>
</head>
<body>
    <div  class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="" method="post">
            <div class="form-group">
                <label>Username</label>
                <label for="login" class="sr-only">Username</label>
                <input type="text" id="login" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>

                <label>Password</label>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login" name="submit">              
            </div>
            <!--<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>-->
            <span class="help-block"><?php echo $login_err; ?></span>
        </form>
    </div>    
</body>
<!-- Footer -->
<footer class="page-footer font-small blue">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright:
    <a href=""> Loteria Lotoplaza</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
</html>