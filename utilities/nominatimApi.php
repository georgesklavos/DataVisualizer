<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
use GuzzleHttp\Client;
$clientLocationData = new Client(['verify' => false,'base_uri' => "https://nominatim.openstreetmap.org/"]); 

?>