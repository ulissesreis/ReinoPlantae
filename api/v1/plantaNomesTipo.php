<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';
if ($metodo == "GET") { 
    
    $query = "SELECT id as tipo_id, nome FROM nome_tipo_planta where status = 1";    
    processaConsulta($query);    
}