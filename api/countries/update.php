<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html');
header('Access-Control-Allow-Methods: PUT');

require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/apiUtils.php";

//Check the method of the request
checkMethod('PUT');

//Check that the user has role 1 (Admin)
checkRole(1);

require $_SERVER['DOCUMENT_ROOT'] . "/models/countries.php";

//Fetch the countries data from the api
fetchCountries();

echo "Fetched succesfully";
