<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';
if ($metodo == "GET") {   
    
    $query = "SELECT 
    pm.id as planta_id,    
    (select 
    nome
    from plantas_nomes 
    Where plantas_medicinais_id = planta_id
    ORDER BY nome_tipo_planta_id ASC limit 1) as nome
    from plantas_medicinais pm
    WHERE pm.status = 1";
    processaConsulta($query);
}