<?php 
//Create client for the nominatim api
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
use GuzzleHttp\Client;
$clientLocationData = new Client(['verify' => false,'base_uri' => $_ENV["locationUrl"]]);
