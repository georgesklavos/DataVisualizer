<?php 

    function checkMethod($method) {
        if($_SERVER['REQUEST_METHOD'] != $method) {
            header("HTTP/1.0 405 Method Not Allowed");
            exit();
        }
    };

    function checkAuth($role) {
        session_start();

        if (!isset($_SESSION["role"]) && $_SESSION["role"] != $role) {
            header("HTTP/1.0 401 Method Not Allowed");
            exit();
        }
    };
?>