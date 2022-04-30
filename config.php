<?php
    if(extension_loaded("mongodb")) {
        require_once __DIR__ . '/vendor/autoload.php';
        if (file_exists(__DIR__ . '/.env')) {
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
            $dotenv->load();
        }
        $db = (new MongoDB\Client($_ENV["dbUrl"]))->{$_ENV["dbName"]};
    }
?>