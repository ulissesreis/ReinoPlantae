<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';
if ($metodo == "GET") {
    
    $query = "SELECT 
    id as usuario_id,
    nome,
    perfil
    FROM usuario";
    processaConsulta($query);
}
if ($metodo == "POST") {
    echo '{}';
    die;
}
if ($metodo == "PUT") {
    echo '{}';
    die;
}