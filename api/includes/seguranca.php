<?php

//primeiro fazemos a segurança da aplicaco REST

$security = "false";
session_start();

if ($security == "true") {
    if (!isset($_SESSION['user']) == true) {
        //Usuario nao fez login
        header('Content-Type: application/json');
        header('HTTP/1.1 401 Unauthorized');
        die('{}');
    }
}