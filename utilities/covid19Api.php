<?php 

    require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
    // $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    // $dotenv->load();
    use GuzzleHttp\Client;
    //'curl' => array( CURLOPT_SSL_VERIFYPEER => false)
    $client = new Client(['verify' => false,'base_uri' => $_ENV["apiUrl"]]);   

?>