function selectUserOperations(){
    var selectedDate = $("#date").val();
    var selectedUsername = $("select option:selected").data("value");
    $(function(){
        alert(selectedDate + "  " + selectedUsername);
    });
}
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