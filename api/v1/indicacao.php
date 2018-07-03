<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';
if ($metodo == "GET") {    
    $query = "SELECT 
    i.plantas_medicinais_id as planta_id,
    i.sintomas_id as sintoma_id,
    concat((select pn.nome
    from plantas_nomes pn
    Where pn.plantas_medicinais_id = i.plantas_medicinais_id ORDER BY pn.nome_tipo_planta_id ASC LIMIT 1)
    ,' para '
    ,s.nome
    ) as nome,
    i.id as indicacao_id,
    i.status,
    i.indicacao
    FROM indicacao i
    INNER JOIN plantas_medicinais pm
    on pm.id = i.plantas_medicinais_id
    Inner join sintomas s 
    ON s.id = i.sintomas_id
    WHERE s.status = 1 AND pm.status = 1";
    
    processaConsulta($query);
}
if ($metodo == "POST") {
    $dados = getDados();
    
    $query = "CALL sp_SetIndicacao(
        ".escape($dados['indicacao_id']).",
        ".$dados['sintoma_id'].",
        ".$dados['planta_id'].",
        ".$_SESSION['admin'].", 
        '".$dados['indicacao']."', 
        ".$dados['status'].")";
        
        executaProcedure($query);
    }
    