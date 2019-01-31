<?php

    // Include config file
    require_once ('/Xampp/htdocs/syscontrol/dao/db.php');
    require_once ('/Xampp/htdocs/syscontrol/dao/tfloperationdao.php');
    require_once ('/Xampp/htdocs/syscontrol/model/tfloperation.php');
    
    /* Attempt to connect to MySQL database */
    $db = new db ();
    
    // Check connection
    if($db  === null){
        die("ERROR: Could not connect. ");
        exit();
    }

    $tfloperation = new tfloperation();
    $tfloperationdao = new tfloperationdao($db);

    $tfloperation = $tfloperationdao->findAll();

    if (count($tfloperation))
    {
        $head = $body = $close = "";
        $head = '   <form style="text-align: center;">
                    <div class="input-group">
                        <span class="input-group-addon">#</span>
                        <select class="form-control form-control-lg" id="tfloperationselect" onchange="setDueDate()">
                        <option selected hidden>Choose here</option>';
        foreach ($tfloperation as $row) {
            $body .= '<option value="' .$row->getId(). '" data-value="' .$row->getDelta(). '">' .$row->getName().  '</option>';
        }

        $body .=    '</select></div></div></br>
                    <div class="input-group">
                        <span class="input-group-addon">R$</span>
                        <input type="text" class="form-control text-right" onkeypress="$(this).mask(\'###.00\', {reverse: true})"  id="tfloperationvalue" />
                    </div></br>';
        $close =    '<div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span></span>
                    <input type="date" class="form-control" id="tflduedate" /></div></br>
                    <div class="input-group">
                        <input id="addoperation" type="button" class="btn btn-primary btn-lg btn-block" value="Adicionar" name="addoperation" onclick="tflLogOperation()" />
                    </div></form>';

        $tfloperation = null;
        $tfloperationdao = null;
        $db->closeConn();

        echo $head;
        echo $body;
        echo $close;
    }
    else
    {
        echo "<p class='lead'><em>No records were found.</em></p>";
    }
?>