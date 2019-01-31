<?php

    require_once ('db.php');
    require_once ('userstype.php');
    require_once ('userstypedao.php');

    $dbnew = new db ();
    $dao = new userstypedao($dbnew);

    if ($dbnew != "")
    {
        echo "Connection failed <p>";
    }
    else
    {
        echo "Connection success <p>";
    }

    /*
    $userstypenew = new userstype();

    $userstypenew->setId(0);
    $userstypenew->setType('caixa 3');
    $userstypenew->setDescription('Vendedor de boloes');
    $userstypenew->setCreated(date("Y-m-d H:i:s"));
    $userstypenew->setFinished(null);

    $dao->save($userstypenew);

    echo "Save success!!";
 */ 
    $new = null;
    $new = $dao->find(18);
    $new->setType('Caixa 122');
    $new->setDescription('Vendedor de bolao avancado');
    $new->setCreated(date("Y-m-d H:i:s"));
    var_dump($dao->update($new));

    echo "Update success!!";

    var_dump($dao->findAll());

    $dbnew->closeConn();
    echo "Connection closed";

?>