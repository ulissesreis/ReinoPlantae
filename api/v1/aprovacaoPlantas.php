<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';
if ($metodo == "GET") {    
    $query = "SELECT
    pme.id as edicao_id,
    pme.plantas_medicinais_id,
    case 
    WHEN pme.plantas_medicinais_id is not null THEN
        (select 
        pn.nome
        from plantas_nomes pn
        Where pme.plantas_medicinais_id = pn.plantas_medicinais_id
        ORDER BY pn.nome_tipo_planta_id ASC limit 1)  
    WHEN pme.plantas_medicinais_id is null THEN
        (select 
        pn.nome
        from plantas_nomes pn
        Where pme.id = pn.plantas_medicinais_edicao_id
        ORDER BY pn.nome_tipo_planta_id ASC limit 1)  
    END as nome
    FROM plantas_medicinais_edicao pme
    WHERE pme.usuario_aprovador is null and pme.usuario_rejeicao is null";
    $dados = processaSubConsulta($query);
        
    foreach ($dados as $row => $value) {
        $dados[$row]["planta"] = getPlanta($dados[$row]['plantas_medicinais_id']);
        $dados[$row]["edicao"] = getEdicao($dados[$row]['edicao_id']);
    }
    
    echo json_encode($dados);
        
}
if ($metodo == "POST") { // avaliacao - aprovacao
    $dados = getDados();
        
    $query = "CALL sp_AvaliarPlanta(
        ".$dados['planta_id'].",
        ".$_SESSION['admin'].", 
        '".$dados['descricao']."', 
        ".$dados['status'].")";
        
    executaProcedure($query);
}


function getPlanta($id){

    if(!isset($id)){
        return null;
    }

    $query = "SELECT    
    pm.imagem,
    pm.status,
    pm.descricao_resumida,
    pm.descricao_completa
    from plantas_medicinais pm
    WHERE pm.id = ".$id;

    return current(processaSubConsulta($query));
}

function getEdicao($id){

    $query = "SELECT    
    pme.imagem,
    pme.status,
    pme.descricao_resumida,
    pme.descricao_completa,
    pme.solicitacao,
    u.nome as usuario_solicitante
    from plantas_medicinais_edicao pme
    INNER JOIN usuario u 
    ON u.id = pme.usuario_solicitante
    WHERE pme.id = ". $id;

    return current(processaSubConsulta($query));

}