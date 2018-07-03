<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';
if ($metodo == "GET") {   
    
    $query = "select 
    s.nome,
    s.id as sintoma_id
    from sintomas s 
    where s.status = 1";
    processaConsulta($query);
}
