<?php
    
    $errors = array(); //To store errors
    $userid = array(); // retrieve user Id information

    /* Validate the form on the server side */
    if (empty($_POST['userid'])) { //bar cannot be empty
        $errors['userid'] = 'UserId cannot be blank';
    }

    if (!empty($errors)) { //If errors in validation
        $userid['success'] = false;
        $userid['errors']  = $errors;
    }
    else { //If not, process the form, and return true on success

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

        $result = $userdao->delete(trim($_POST['userid']));

        if (!is_null($result))
            $userid['success'] = true;
        else
        {
            $userid['success'] = false;
            $userid['errors'] = 'User could not be deleted.';
        }
    }
    
    //Return the data back to form.php
    echo json_encode($userid);
?>

