<?php

    require_once('checksession.php');
    
    $errors = array(); //To store errors
    $userid = array(); // retrieve user Id information

    /* Validate the form on the server side */
    if (empty($_POST['id'])&&empty($_POST['value'])&&empty($_POST['duedate'])) { //bar cannot be empty
        $errors['id'] = 'Select cannot be blank';
        $errors['value'] = 'Value cannot be blank';
        $errors['duedate'] = 'Due date cannot be blank';
    }

    if (!empty($errors)) { //If errors in validation
        $userid['success'] = false;
        $userid['errors']  = $errors;
    }
    else { //If not, process the form, and return true on success

        // Include config file
        require_once ('/Xampp/htdocs/syscontrol/dao/db.php');
        require_once ('/Xampp/htdocs/syscontrol/dao/tfllogdao.php');
        require_once ('/Xampp/htdocs/syscontrol/model/tfllog.php');

        /* Attempt to connect to MySQL database */
        $db = new db ();

        // Check connection
        if($db  === null){
            die("ERROR: Could not connect. ");
            exit();
        }

        $tfllog = new tfllog();
        $tfllogdao = new tfllogdao($db);

        $tfllog->setIdop(trim($_POST['id']));
        $tfllog->setIduser(trim($_SESSION["id"]));
        $tfllog->setValue(trim($_POST['value'])); 
        $tfllog->setDue(trim($_POST['duedate']));

        $result = $tfllogdao->save($tfllog);

        if (($result) > 0)
            $userid['success'] = true;
        else
        {
            $userid['success'] = false;
            $userid['errors'] = 'User could not be deleted.';
        }

        $tfllog = null;
        $tfllogdao = null;
        $db->closeConn();
    }
    
    //Return the data back to form.php
    echo json_encode($userid);
?>