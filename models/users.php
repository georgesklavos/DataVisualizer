<?php 
function createUser($firstName, $lastName, $birthDate, $email, $password, $country) {
        require  $_SERVER['DOCUMENT_ROOT'] . "/config.php";
        $collection = $db->users;
        $collection->insertOne([ 
        "firstName" => $firstName,
        "lastName" => $lastName,
        "birthDate" => $birthDate,
        "email" => $email,
        "country" => $country,
        "password" => password_hash($password, PASSWORD_BCRYPT),
        "role" => 2
    ]);
};

function userLogin($email, $password) {
    require  $_SERVER['DOCUMENT_ROOT'] . "/config.php";
    $collection = $db->users;
    $user = $collection->findOne(["email" => $email]);
    if($user) {
        if(password_verify($password,$user->password)) {
            return $user;
        }
    }

    return false;
};

function findUsers() {
    require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
    $collection = $db->users;
    return $collection->find([]);
};

function checkEmail($email) {
    require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
    $collection = $db->users;

    return $collection->findOne(['email' => $email]) ? true : false;
}

?>