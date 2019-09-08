<?php

define("LOCALHOST_OFF", false);

if (LOCALHOST_OFF){
    // Define DB Params
    define("DB_HOST", "localhost");
    define("DB_USER", "id8695685_lotosys");
    define("DB_PASS", "lotosys");
    define("DB_NAME", "id8695685_lotosys");

    // Define URL
    define("ROOT_PATH", dirname(__FILE__)."/");
    define("ROOT_URL", "https://lotosystem.000webhostapp.com/");
} else {
    // Define DB Params
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "demo");

    // Define URL
    define("ROOT_PATH", dirname(__FILE__)."/");
    define("ROOT_URL", "https://localhost/lotosystem/");
}
