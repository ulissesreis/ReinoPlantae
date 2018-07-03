<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';


if ($metodo == "GET") {
    
    $model =getModel();
    
    if($model['relatorio'] == 'pendencias'){
        $query = "SELECT
        (SELECT 
        count(*)
        FROM sintomas_edicao e
        WHERE e.usuario_aprovador is null and e.usuario_rejeicao is null) as sintomas,
        (SELECT 
        count(*)
        FROM plantas_medicinais_edicao pm
        WHERE pm.usuario_aprovador is null and pm.usuario_rejeicao is null) as plantas,
        (SELECT 
        count(*)
        FROM indicacao_edicao i
        WHERE i.usuario_aprovador is null and i.usuario_rejeicao is null) as indicacao";
    }
    if($model['relatorio'] == 'volumetria'){
        
        $query= "SELECT
        (SELECT 
        count(*)
        FROM sintomas_edicao e
        WHERE e.usuario_aprovador is null and e.usuario_rejeicao is null) as sintomas,
        (SELECT 
        count(*)
        FROM plantas_medicinais_edicao pm
        WHERE pm.usuario_aprovador is null and pm.usuario_rejeicao is null) as plantas,
        (SELECT 
        count(*)
        FROM indicacao_edicao i
        WHERE i.usuario_aprovador is null and i.usuario_rejeicao is null) as indicacao,
        (SELECT count(*) 
        FROM sugestoes 
        WHERE status = 1) as sugestoes";
    }
    
    setHeader(200);
    echo json_encode(current(processaSubConsulta($query)));
}