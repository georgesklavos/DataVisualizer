<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

require $_SERVER['DOCUMENT_ROOT'] . "/models/users.php";

echo checkEmail($_GET['email']);
