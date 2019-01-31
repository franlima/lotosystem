<?php

    $updatemodal = '<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                    <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input id="data-userid" class="form-control" type="text" placeholder="userid" value="1" disabled="true">
                                    </div>
                                    <div class="form-group">
                                        <select id="data-usertype" class="form-control" title="User type" data-toggle="tooltip">
                                            <option selected hidden>Choose here</option>
                                            <option value="1">Supervisor</option>
                                            <option value="2">Vendedor</option>
                                            <option value="3">Caixa</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input id="data-username" class="form-control" type="text" placeholder="Username" value="testte" disabled="true">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="password" placeholder="New password">
                                        <input class="form-control" type="password" placeholder="Repeat password">
                                    </div>
                                </div>
                                <div class="modal-footer ">
                                    <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span>Update</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Cancel</button>
                                </div>
                            </div><!-- /.modal-content -->  
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal-fade -->';
                    
    $deletemodal = '<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true" userid="testemodal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                    <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"><div id="result"></div></span></div>
                                </div>
                                <div class="modal-footer ">
                                    <button id="usersdelete" type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog --> 
                    </div><!-- /.modal-fade -->';
    echo $updatemodal;
    echo $deletemodal;
?>