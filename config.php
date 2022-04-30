<?php
    if(extension_loaded("mongodb")) {
        require_once __DIR__ . '/vendor/autoload.php';
        if (file_exists(__DIR__ . '/.env')) {
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
            $dotenv->load();
        }
        $manager = new MongoDB\Driver\Manager($_ENV["dbUrl"]);
        $db = (new MongoDB\Client)->{$_ENV["dbName"]};
    }
?>