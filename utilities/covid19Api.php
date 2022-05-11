<?php 
    //Create client for the covid19 api
    require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
    use GuzzleHttp\Client;
    $client = new Client(['verify' => false,'base_uri' => $_ENV["covidUrl"]]);   

?>