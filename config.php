<?php
//Check that the library is loaded
if (extension_loaded("mongodb")) {
    require_once __DIR__ . '/vendor/autoload.php';
    //Check if a .env file exists in the current directory
    if (file_exists(__DIR__ . '/.env')) {
        //Load env variables
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }
    //Connect to MongoDB database
    $db = (new MongoDB\Client($_ENV["dbUrl"]))->{$_ENV["dbName"]};
}
