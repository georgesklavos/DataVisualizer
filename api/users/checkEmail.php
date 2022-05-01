<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/apiUtils.php";

checkMethod('POST');
checkRole(null);

require $_SERVER['DOCUMENT_ROOT'] . "/models/users.php";

echo checkEmail($_GET['email']);
