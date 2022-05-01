<?php 

    function checkMethod($method) {
        if($_SERVER['REQUEST_METHOD'] != $method) {
            header("HTTP/1.0 405 Method Not Allowed");
            exit();
        }
    };

    function checkRole($role) {
        session_start();

        if (!isset($_SESSION["role"])) {
            header("HTTP/1.1 401 Unauthorized");
            exit();
        }else if(isset($role) && $_SESSION["role"] != $role) {
            header("HTTP/1.1 403 Forbidden");
            exit();
        }
    };
?>