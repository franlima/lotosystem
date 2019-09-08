<?php
    
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

    $user = $userdao->findAll();

    if (count($user))
    {
        $head = $body = $close = "";
        $head = '<div class="wrapper"><div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-header clearfix">
                                <h2 class="pull-left">Users</h2>
                                <a href="create.php" class="btn btn-success pull-right">Add New Employee</a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Type</th>
                                        <th>User name</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>';
        foreach ($user as $row) {

            if (is_null($row->getFinished()))
            {
                $status = '<span class="label label-warning">Active</span>';
            }
            else {
                $status = '<span class="label label-danger">Deactive</span>';
            }
            switch ($row->getIdType()) {
                case '1':
                    $usertype = 'Supervisor';
                    break;
                case '2':
                    $usertype = 'Vendedor';
                    break;                
                default:
                    $usertype = 'Caixa';
                    break;
            }

            $body .= '<tr>
                        <td>' .$row->getId(). '</td>
                        <td>' .$usertype. '</td>
                        <td>' .$row->getUsername(). '</td>
                        <td>' .$status. '</td>
                        <td>
                            <!--<a href="read.php?id=' .$row->getId(). '" title="View user" data-toggle="tooltip" data-toggle="modal" data-target="#view"><span class="glyphicon glyphicon-eye-open"></span></a>-->
                            <!--<a href="update.php?id=' .$row->getId(). '" title="Update user" data-toggle="tooltip" data-toggle="modal" data-target="#update"><span class="glyphicon glyphicon-pencil"></span></a>-->
                            <!--<a href="delete.php?id=' .$row->getId(). '" title="Delete user" data-toggle="tooltip" data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></a>-->
                            <!--<a title="View user" data-toggle="tooltip"><button class="btn btn-primary btn-xs" data-title="View user" data-toggle="modal" data-target="#view"><span class="glyphicon glyphicon-eye-open"></button></span></a>-->
                            <a title="Update user" data-toggle="tooltip"><button class="btn btn-primary btn-xs" data-title="Update user" data-toggle="modal" data-target="#update" data-id="' .$row->getId(). '"><span class="glyphicon glyphicon-pencil"></span></button></a>
                            <a title="Delete user" data-toggle="tooltip"><button class="btn btn-primary btn-xs" data-title="Delete user" data-toggle="modal" data-target="#delete" data-id="' .$row->getId(). '"><span class="glyphicon glyphicon-trash"></span></button></a>
                        </td>
                    </tr>';
        }

        $close = '</tbody></table></div></div></div>';

        $user = null;
        $userdao = null;
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