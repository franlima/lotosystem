<?php

    require_once('checksession.php');

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Lotosystem</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.js"></script>
    <script src="../syscontrol/css/jquery.tabledit.js"></script>
    <script>
        function viewTflLog() {
            var data = $('#tfldate').val();
            $.ajax({
            url : '../syscontrol/refreshTflLogs.php?p=view&data=' + data,
            method : 'GET'
            }).done(function(data){
            $('tbody').html(data);
                console.log(data);
                tableData();
            })
        }
        function tableData() {
            $('#tabledit').Tabledit({
                url: '../syscontrol/refreshTflLogs.php',
                eventType: 'dblclick',
                editButton: true,
                deleteButton: false,
                hideIdentifier: true,
                buttons: {
                    edit: {
                        class: 'btn btn-sm btn-warning',
                        html: '<span class="glyphicon glyphicon-pencil"></span> Edit',
                        action: 'edit'
                    },
                    delete: {
                        class: 'btn btn-sm btn-danger',
                        html: '<span class="glyphicon glyphicon-trash"></span> Trash',
                        action: 'delete'
                    },
                    save: {
                        class: 'btn btn-sm btn-success',
                        html: 'Save'
                    },
                    restore: {
                        class: 'btn btn-sm btn-warning',
                        html: 'Restore',
                        action: 'restore'
                    },
                    confirm: {
                        class: 'btn btn-sm btn-default',
                        html: 'Confirm'
                    }
                },
                columns: {
                    identifier: [0, 'id'],
                    editable: [[2, 'value']]
                },
                onSuccess: function(data, textStatus, jqXHR) {
                    viewTflLog();
                },
                onFail: function(jqXHR, textStatus, errorThrown) {
                    console.log('onFail(jqXHR, textStatus, errorThrown)');
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                },
                onAjax: function(action, serialize) {
                    console.log('onAjax(action, serialize)');
                    console.log(action);
                    console.log(serialize);
                }
            });
        }
        function setDueDate(){
            var str = "";
            str = $("select option:selected").data("value");
            var now = new Date();
            $("#tflduedate").val( now.getFullYear() + "-" + (now.getMonth() + 1) + "-" + (now.getDate() + str));
        }
        function refreshTflActionData() {
            $(document).ready(function() {

                // Variable to hold request
                var request;

                // Abort any pending request
                if (request) {
                    request.abort();
                }
                // Fire off the request to /form.php
                request = $.ajax({
                    url: "../syscontrol/refreshTflAction.php",
                    type: "post"
                });

                // Callback handler that will be called on success
                request.done(function (response, textStatus, jqXHR){
                    // Log a message to the console
                    console.log("Hooray, it worked!");
                    $("#newTflAction").html(response);
                });

                // Callback handler that will be called on failure
                request.fail(function (jqXHR, textStatus, errorThrown){
                    // Log the error to the console
                    console.error("The following error occurred: "+
                        textStatus, errorThrown
                    );
                    $("#newTflAction").html('Error occured');
                });            
            });
        }
        function tflLogOperation() {          
            $(document).ready(function() {

                // Variable to hold request
                var request;
                

                // Abort any pending request
                if (request) {
                    request.abort();
                }
               
                var data = {
                            "id" :  $("#tfloperationselect").val(),
                            "value" : $("#tfloperationvalue").val(),
                            "duedate" : $("#tflduedate").val()
                        };                

                // Fire off the request to /form.php
                request = $.ajax({
                    url: "../syscontrol/tfllogoperation.php",
                    type: "post",
                    data: data
                });

                // Callback handler that will be called on success
                request.done(function (response, textStatus, jqXHR){
                    // Log a message to the console
                    console.log("Hooray, it worked!");
                    $("#newTflAction").html(response);
                    refreshTflActionData();
                });

                // Callback handler that will be called on failure
                request.fail(function (jqXHR, textStatus, errorThrown){
                    // Log the error to the console
                    console.error("The following error occurred: "+
                        textStatus, errorThrown
                    );
                    $("#newTflAction").html('Error occured');
                });         
            });          
        }
        $(document).ready(function() {
            $("#bntnewpassword").on("click", function(){

                var data = { 
                                password : $("#newpassword").val()
                            }; 
                
                request = $.ajax({
                    type: "POST",
                    url: "../syscontrol/reset_password.php",
                    data: data
                });

                // Callback handler that will be called on success
                request.done(function (response, textStatus, jqXHR){
                    // Log a message to the console
                    console.log("Hooray, it worked! " + response);
                    alert("Senha alterada : " + response);
                });

                // Callback handler that will be called on failure
                request.fail(function (jqXHR, textStatus, errorThrown){
                    // Log the error to the console
                    console.error("The following error occurred: "+
                        textStatus, errorThrown);
                });
            });
        });
    </script>
</head>
<body onload="refreshTflActionData()">
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo htmlspecialchars($_SESSION["id"]). " - " .htmlspecialchars($_SESSION["username"]); ?></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="logout.php">Logout</a></li>
            </ul>
            </div>
        </div>
    </nav>
    <div class="container" style="margin-top:50px; text-align:center;">
        <!--<div class="jumbotron">-->
            <div class="panel-group" id="accordion" style="text-align:center;">  
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <button class="btn btn-danger btn-lg" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                New TFL action
                            </button>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div id="newTflAction" class="panel-body">
                            
                        </div>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <button class="btn btn-primary btn-lg" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                View TFL Report
                            </button>
                        </h4>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="panel-body">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span></span>
                                <input type="date" class="form-control" id="tfldate" onchange="viewTflLog()" />
                            </div></br>
                            <table id="tabledit" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>id</th>
                                <th>Operation</th>
                                <th>value</th>
                                <th>status</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            </table>
                        </div>
                    </div> 
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <button class="btn btn-warning btn-lg" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Reset your password
                            </button>
                        </h4>
                    </div>
                    <div id="collapseOne"  class="collapse" data-parent="#accordion">
                        <div class="panel-body">
                            <form data-toggle="validator" role="form" method="post">
                                <div class="form-group">
                                    <!-- <input type="password" id="newpassword" data-minlength="6" name="newpassword" class="form-control" placeholder="New Password" pattern="^(?=.*[a-zA-Z])(?=\w*[0-9])\w{6,}$" required> -->
                                    <input type="password" id="newpassword" data-minlength="6" name="newpassword" class="form-control" placeholder="New Password" pattern="^(?=\w*[0-9])\w{6,}$" required>
                                    <span class="help-block">Senha deve conter pelo menos 6 carateres, pelo menos 1 letra e 1 número</span>
                                </div>
                                <div class="form-group">
                                    <input type="password" id="confirmpassword" data-match="#newpassword" name="confirmpassword" class="form-control" placeholder="Repeat Password" data-match-error="Whoops, these don't match" required>
                                    <span class="help-block with-errors"></span>
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="bntnewpassword" class="btn btn-primary" value="Reset Password">   
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <!--</div>-->
    </div>

    <?php 
        include_once('modal.php') 
    ?>

</body>
</html>