<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';
if ($metodo == "GET") { 
    $query = "";
    processaConsulta($query);
}
if ($metodo == "POST") {
    
    $dados = getDados();
    
    $query = "CALL sp_SetPlantaClassificacao(".$dados['planta_id'].",".$dados['classificacao'].")"; 
    executaProcedure($query);
}
if ($metodo == "PUT") {
    echo '{}';
        die();
    }
    if ($metodo == "DELETE") {
        echo '{}';
            die();
        }