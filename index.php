<?php

// Start Session
session_start();

// Include Config
require('config.php');

require('classes/Messages.php');
require('classes/Bootstrap.php');
require('classes/Controller.php');
require('classes/Model.php');

require('controllers/home.php');
require('controllers/operations.php');
require('controllers/shares.php');
require('controllers/reports.php');
require('controllers/users.php');

require('models/home.php');
require('models/operation.php');
require('models/share.php');
require('models/report.php');
require('models/user.php');

//echo phpinfo();

$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();
if($controller){
	$controller->executeAction();
}