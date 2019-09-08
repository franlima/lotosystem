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
    <link rel="stylesheet" type="text/css" href="./css/jcom_quick.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; margin: auto; }
    </style>
</head>
<body class="nav" style="">
    <div id="container">
            <div id="headerWrapper">
            </div>
            <div id="bodyWrapper">
                <div class="bodyInner">
                    <!-- contents -->
                    <div class="quickBlock">
                        <div class="hed">
                        </div>
                        <div class="bod">
                            <div class="bxc bxWls">
                                <h3 data-i18n="nav.RG_STR_WIRELESS_SETUP_ID">Please fill in your credentials to login.</h3>
                                <form action="" method="post">
                                    <div class="lst">
                                        <dl class="i1" id="wlan_0">
                                            <dt id="wlan_0_band">LOGIN</dt>
                                            <dd>
                                                <input type="text" class="inTx" placeholder="<?php echo $username; ?>" id="wlan_0_ssid" maxlength="32" name="username">
                                                <span class="help-block"><?php echo $username_err; ?></span>
                                            </dd>
                                        </dl>
                                        <dl class="i3">
                                            <dt data-i18n="nav.RG_STR_QUICK_SETUP_PASSWORD">Password</dt>
                                            <dd>
                                                <input type="password" class="inTx" id="wlan_0_pass" value="" maxlength="64" name="password">
                                                <span class="help-block"><?php echo $password_err; ?></span>
                                            </dd>
                                        </dl>
                                    </div>
                                    <p class="pass_help" data-i18n="nav.RG_STR_PASS_MESSAGE">More than 8 characters.</p>
                                    <span class="help-block"><?php echo $login_err; ?></span>
                                    <div class="bnCfm">
                                        <input type="submit" class="btn btn-primary btn-lg" value="Login" name="submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</body>
<div id="footerWrapper">
        <div class="footer">
            <p class="site">Copyright © 2018 Loteria Lotoplaza LTDA - ME. All rights reserved.</p>
    </div> 
</html>