<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/apiUtils.php";

//Check the method of the request
checkMethod('POST');
checkRole(null);

require $_SERVER['DOCUMENT_ROOT'] . "/models/users.php";

//Check if the email is already in use
echo checkEmail($_GET['email']);
