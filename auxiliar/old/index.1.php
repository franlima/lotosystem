<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });

        function progressMove($count) {
        document.getElementById("progress").setAttribute("style", "width: " + $count);
        }
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Type Users Addition</h2>
                        <a href="createType.php" class="btn btn-success pull-right">Add New Type</a>
                    </div>
                    <!-- Progress bar holder -->
                    <div class="progress">
                        <div id="progress" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style = "width: 10%"></div>
                    <!-- Progress information -->
                       <div id="information" style="width"></div>
                    </div>
                    <?php
                        // Total processes
                        $total = 10;
                        // Loop through process
                        for($i=1; $i<=$total; $i++){
                            // Calculate the percentation
                            $percent = intval($i/$total * 100)."%";
                            
                            // Javascript for updating the progress bar and information

                            //document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.'%\">&nbsp;</div>";
                            //document.getElementById("progress").setAttribute("style", "width: '.$percent.'")";
                            echo '<script language="javascript">
                                progressMove("'.$percent.'");   
                                //alert(document.getElementById("progress").getAttribute("style"));
                                document.getElementById("information").innerHTML="'.$i.' row(s) processed.";
                            </script>';
                            

                        // This is for the buffer achieve the minimum size in order to flush data
                            echo str_repeat(' ',1024*64);
                            

                        // Send output to browser immediately
                            flush();
                            

                        // Sleep one second so we can see the delay
                            sleep(1);
                        }
                        // Tell user that the process is completed
                        echo '<script language="javascript">document.getElementById("information").innerHTML="Process completed"</script>';
                    ?>
                    <?php
                        // Include config file
                        require_once "config.php";
                        
                        // Attempt select query execution
                        $sql = "SELECT * FROM userstype";
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                echo "<table class='table table-hover table-striped table-bordered'>";
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th scope='col'>#</th>";
                                            echo "<th scope='col'>Type</th>";
                                            echo "<th scope='col'>Description</th>";
                                            echo "<th scope='col'>Created</th>";
                                            echo "<th scope='col'>Finished</th>";
                                            echo "<th scope='col'>Action</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                            echo "<th scope='row'>" .$row['id']. "</td>";
                                            echo "<td>" .$row['type']. "</td>";
                                            echo "<td>" .$row['description']. "</td>";
                                            echo "<td>" .$row['created']. "</td>";
                                            echo "<td>" .$row['finished']. "</td>";
                                            echo "<td>";
                                                echo "<a href='read.php?id=" .$row['id']. "' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                                echo "<a href='update.php?id=" .$row['id']. "' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                                echo "<a href='delete.php?id=" .$row['id']. "' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";
                                // Free result set
                                mysqli_free_result($result);
                            } else{
                                echo "<p class='lead'><em>No records were found.</em></p>";
                            }
                        } else{
                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }
    
                        // Close connection
                        mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>