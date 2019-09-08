<?php

    require_once('checksession.php');

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>Lotosystem</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
            }
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            $('#myModal').on('hide.bs.modal', function () {    
                console.log('username : '+$("#modal-username").val());    
                console.log('result : '+$("#modal-result").val());    
            });
            //triggered when modal is about to be shown
            $('#delete').on('show.bs.modal', function(e) {

                //get data-id attribute of the clicked element
                var userid = $(e.relatedTarget).data('id');

                //populate the textbox
                $(e.currentTarget).attr('userid', userid);
                $("#result").html('Are you sure you want to delete this user? #' + userid);
            });
            
            // Variable to hold request
            var request;

            // Bind to the submit event of our form
            $("#usersdelete").on('click', function(event){

                // Prevent default posting of form - put here to work in case of errors
                event.preventDefault();

                // Abort any pending request
                if (request) {
                    request.abort();
                }
                // setup some local variables
                var $form = $(this);

                // Let's select and cache all the fields
                var $inputs = $form.find("input, select, button, textarea");

                // Serialize the data in the form
                //var $data = [];
                //$data['userid'] = $("#delete").attr('userid');
                //var serializedData = $data.serialize();

                // Let's disable the inputs for the duration of the Ajax request.
                // Note: we disable elements AFTER the form data has been serialized.
                // Disabled form elements will not be serialized.
                $inputs.prop("disabled", true);

                // Fire off the request to /form.php
                request = $.ajax({
                    url: "/syscontrol/usersdelete.php",
                    type: "post",
                    data: { "userid" : $("#delete").attr('userid') }
                });

                // Callback handler that will be called on success
                request.done(function (response, textStatus, jqXHR){
                    // Log a message to the console
                    console.log("Hooray, it worked!");
                    $("#result").html(response);
                });

                // Callback handler that will be called on failure
                request.fail(function (jqXHR, textStatus, errorThrown){
                    // Log the error to the console
                    console.error("The following error occurred: "+
                        textStatus, errorThrown
                    );
                    $("#result").html('Error occured');
                });

                // Callback handler that will be called regardless
                // if the request failed or succeeded
                request.always(function () {
                    // Reenable the inputs
                    $inputs.prop("disabled", false);
                });

            });
        });
    </script>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo htmlspecialchars($_SESSION["username"]); ?></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about>About</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <!--<div class="wrapper">-->
        <div class="container">
            <div>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-warning btn-lg" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Reset your password
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <form class="form-signin" method="post">
                                <div class="form-group">
                                    <label for="new_password" class="sr-only">New password</label>
                                    <input type="password" id="new_password" name="new_password" class="form-control" placeholder="New Password">
                                    <span class="help-block"></span>

                                    <label for="confirm_password" class="sr-only">Repeat new password</label>
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Repeat Password">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Reset Password" name="reset">       
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-danger btn-lg" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                Manager Users 
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <?php 
                                include_once("usersmanager.php"); 
                            ?>
                        </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-primary btn-lg" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Manager operations
                            </button>
                        </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--</div>-->
    <?php 
        include_once('modal.php') 
    ?>
</body>
</html>