<?php

    set_include_path ('/Xampp/htdocs/syscontrol');
    
    require_once ('../dao/db.php');
    require_once ('../dao/usersdao.php');
    require_once ('../model/users.php');

    $tdb = new db ();

    $save = 0;
    $update = 1;

    if ($tdb == null)
    {
        $message = "Connection failed <p>";
        throw new Exception($message, 1);        
    }
    else
    {
        echo "Connection success <p>";
    }

    $tusersdao = new usersdao($tdb);
    $tusers = new users();

    if ($save)
    {
        $tusers->setIdType(1);
        $tusers->setUsername('keite');
        $tusers->setPassword('123457');
        $tusers->setFinished(null);
    
        if ($tusersdao->save($tusers) == null)
        {
            $message = "Save failed!!";
            throw new Exception($message, 1);
        }
        else
        {
            echo "Save success!!";
        }


    }

    $tusers = null;

    if ($update)
    {
 
        $tusers = $tusersdao->find(4);
        var_dump($tusers);
        var_dump(is_object($tusers));

        //$tusers->setIdType(2);
        //$tusers->setUsername('erika');
        $tusers->setPassword('1234567');
    
        if ($tusersdao->update($tusers) == null)
        {
            $message = "Update failed!!";
            throw new Exception($message, 1);
        }
        else
        {
            echo "Update success!!";
        }
    }

    var_dump($tusersdao->findAll());

    $tusers = null;
    $tusersdao = null;
    $tdb->closeConn();
    echo "Connection closed";

?>