<?php
    
    require_once('checksession.php');
 
    // Define variables and initialize with empty values
    $new_password = $confirm_password = "";
    $new_password_err = $confirm_password_err = "";

    // Processing form data when form is submitted
    if (isset($_POST['reset']))
    {
        // Validate new password
        if(empty(trim($_POST["new_password"])))
        {
            $new_password_err = "Please enter the new password.";     
        } elseif(strlen(trim($_POST["new_password"])) < 6)
        {
            $new_password_err = "Password must have atleast 6 characters.";
        } else 
        {
            $new_password = trim($_POST["new_password"]);
        }
    
        // Validate confirm password
        if(empty(trim($_POST["confirm_password"])))
        {
            $confirm_password_err = "Please confirm the password.";
        } else
        {
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($new_password_err) && ($new_password != $confirm_password))
            {
                $confirm_password_err = "Password did not match.";
            }
        }
        
        // Check input errors before updating the database
        if(empty($new_password_err) && empty($confirm_password_err))
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

            var_dump($_SESSION["id"]);    
            var_dump($user);

            if (count($user))
            {
                $user->setPassword($new_password);

                if (count($userdao->updatePassword($user)))
                {
                    
                    $user = null;
                    $userdao = null;
                    $db->closeConn();
                    
                    // Password updated successfully. Destroy the session, and redirect to login page
                    header("location: welcome.php");
                }
                else
                {
                    // Display an error message if password is not valid
                    $login_err =  "Oops! Something went wrong. Please try again later.";
                    $user = null;
                    $userdao = null;
                    $db->closeConn();
                }
            }
        }
    }
    elseif(isset($_POST['cancel'])) {
        header("location: welcome.php");
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
        <link href="./css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="./css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <form class="form-signin" method="post">
        <div class="form-group">
            <img class="mb-4" src="./css/bootstrap-solid.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Reset password of <?php echo $_SESSION["username"] ?></h1>
            
            <label for="new_password" class="sr-only">New password</label>
            <input type="password" id="new_password" name="new_password" class="form-control" placeholder="New Password">
            <span class="help-block"><?php echo $new_password_err; ?></span>
            
            <label for="confirm_password" class="sr-only">Repeat new password</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Repeat Password">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Reset Password" name="reset">
            <input type="submit" class="btn btn-primary" value="Cancel" name="cancel">            
        </div>
        
        <!--<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>-->
        <p class="mt-5 mb-3 text-muted">© 2018 Copyright:<a href=""> Loteria Lotoplaza</a></p>
    </form> 
</body>
</html>