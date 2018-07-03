<?php

//Verifica Usuario Login
require_once 'seguranca.php';

//Verifica Requisicao
$metodo = $_SERVER['REQUEST_METHOD'];
//Captar usuario matriz para transacao

isset($_SESSION['user']) ? $user = $_SESSION['user'] : $user = NULL;
