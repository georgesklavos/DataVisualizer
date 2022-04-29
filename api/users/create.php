<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
require $_SERVER['DOCUMENT_ROOT'] . "/models/users.php";

createUser($_GET["firstName"], $_GET["lastName"], $_GET["birthDate"], $_GET["email"], $_GET["password"]);

echo "User created!";
