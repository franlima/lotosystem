<?php

    $page = isset($_GET['p']) ? $_GET['p'] : '';
    $data = isset($_GET['data']) ? $_GET['data'] : '';
    if (($page == 'view')&&($data != ''))
    {
        $reportDate = $reportDue = "No records found!";
        $divider = "";
        $totalDate = $totalDue = 0;
        
        // Include config file
        require_once ('/Xampp/htdocs/syscontrol/dao/db.php');
        require_once ('/Xampp/htdocs/syscontrol/dao/tfllogdao.php');
        require_once ('/Xampp/htdocs/syscontrol/dao/tfloperationdao.php');
        require_once ('/Xampp/htdocs/syscontrol/model/tfllog.php');
        
        /* Attempt to connect to MySQL database */
        $db = new db ();
        
        // Check connection
        if($db  === null){
            die("ERROR: Could not connect. ");
            exit();
        }
        
        $tfllogDate = new tfllog();
        $tfllogDue = new tfllog();
        $tfllogdao = new tfllogdao($db);

        $tfloperation = new tfloperation();
        $tfloperationdao = new tfloperationdao($db);
    
        $tfllogDate = $tfllogdao->findAllDateReport($data);
    
        if (count($tfllogDate))
        {
            $status = "";
            $totalDate = 0.0;

            foreach ( $tfllogDate as $row )
            {  
                $totalDate += $row->getValue();
                $tfloperation = $tfloperationdao->find($row->getIdop());
                if ("0" != $row->getStatus())
                {
                    $status = '<span class="label label-warning">C</span>';
                }
                else {
                    $status = '<span class="label label-danger">NC</span>';
                }
                $reportDate .= '<tr>
                            <td>' .$row->getId(). '</td>;
                            <td>' .$tfloperation->getName(). '</td>
                            <td>' .$row->getValue(). '</td>
                            <td>' .$status. '</td>
                        </tr>';
            }

            $reportDate .=   '<tr class="table-dark">
                            <td></td>
                            <td class="table-dark">TOTAL</td>
                            <td>' .$totalDate. '</td>
                            <td></td>
                        </tr>';

        }

        $tfllogDue = $tfllogdao->findAllDueReport($data);

        if (count($tfllogDue))
        {
            $status = "";
            $totalDue = 0.0;

            foreach ( $tfllogDue as $row )
            {  
                $totalDue += $row->getValue();
                $tfloperation = $tfloperationdao->find($row->getIdop());
                if ("0" != $row->getStatus())
                {
                    $status = '<span class="label label-warning">C</span>';
                }
                else {
                    $status = '<span class="label label-danger">NC</span>';
                }
                $reportDue .= '<tr>
                            <td>' .$row->getId(). '</td>;
                            <td>' .$tfloperation->getName(). '</td>
                            <td>' .$row->getValue(). '</td>
                            <td>' .$status. '</td>
                        </tr>';
            }

            $reportDue .=   '<tr class="table-dark">
                            <td></td>
                            <td class="table-dark">TOTAL</td>
                            <td>' .$totalDue. '</td>
                            <td></td>
                        </tr>';


        }

        echo $reportDate;
        echo $reportDue;

        $tfllogDate = null;
        $tfllogDue = null;
        $tfloperation = null;
        $tfllogdao = null;
        $tfloperationdao = null;
        $db->closeConn();
    }
    else
    {

        // Basic example of PHP script to handle with jQuery-Tabledit plug-in.
        // Note that is just an example. Should take precautions such as filtering the input data.

        header('Content-Type: application/json');

        $input = filter_input_array(INPUT_POST);
        
        //echo ($input['action']);

        if ($input['action'] == 'edit') {
            //$mysqli->query("UPDATE users SET idtype='" .$input['idtype']. "', username='" .$input['username']. "', password='" .$input['password']. "' WHERE id='" . $input['id'] . "'");
        } else if ($input['action'] == 'delete') {
            //$mysqli->query("UPDATE users SET finished='" .date('Y-m-d H:i:s'). "' WHERE id='" . $input['id'] . "'");
        } else if ($input['action'] == 'restore') {
            //$mysqli->query("UPDATE users SET finished=null WHERE id='" . $input['id'] . "'");
        }

        //m/ysqli_close($mysqli);
        $tfllog = null;
        $tfloperation = null;
        $tfllogdao = null;
        $tfloperationdao = null;
        $db->closeConn();

        echo "Success";
        //echo json_encode($input);
    }
?>