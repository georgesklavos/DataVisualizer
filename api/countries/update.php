<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html');
header('Access-Control-Allow-Methods: PUT');
require $_SERVER['DOCUMENT_ROOT'] . "/models/countries.php";

fetchCountries();

echo "Fetched succesfully";
?>