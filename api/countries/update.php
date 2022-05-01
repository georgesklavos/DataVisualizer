<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html');
header('Access-Control-Allow-Methods: PUT');

require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/apiUtils.php";

checkMethod('PUT');

require $_SERVER['DOCUMENT_ROOT'] . "/models/countries.php";

fetchCountries();

echo "Fetched succesfully";
?>