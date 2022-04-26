<?php
    if(extension_loaded("mongodb")) {
        require_once __DIR__ . '/vendor/autoload.php';
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        $manager = new MongoDB\Driver\Manager($_ENV["dbUrl"]);
        $db = (new MongoDB\Client)->{$_ENV["dbName"]};
    }
?>