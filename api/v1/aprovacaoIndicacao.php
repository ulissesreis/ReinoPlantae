<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';

if ($metodo == "GET") {    
    $query = "SELECT
    ie.id as edicao_id,
    ie.indicacao_id
    FROM indicacao_edicao ie
    WHERE ie.usuario_aprovador is null and ie.usuario_rejeicao is null";
    $dados = processaSubConsulta($query);
        
    foreach ($dados as $row => $value) {
        $dados[$row]["indicacao"] = getIndicacao($dados[$row]['indicacao_id']);
        $dados[$row]["edicao"] = getEdicao($dados[$row]['edicao_id']);
    }
    
    echo json_encode($dados);
        
}
if ($metodo == "POST") { // avaliacao - aprovacao
    $dados = getDados();
        
    $query = "CALL sp_AvaliarIndicacao(
        ".$dados['indicacao_id'].",
        ".$_SESSION['admin'].", 
        '".$dados['descricao']."', 
        ".$dados['status'].")";
        
    executaProcedure($query);
}

function getIndicacao($id){

    if(!isset($id)){
        return null;
    }

    $query = "SELECT
    i.status,
    i.indicacao,
    s.nome as sintoma,
    (select 
        nome
        from plantas_nomes 
        Where plantas_medicinais_id = i.plantas_medicinais_id ORDER BY nome_tipo_planta_id ASC LIMIT 1) as planta
    FROM indicacao i
    INNER JOIN sintomas s
    ON s.id = i.sintomas_id
    WHERE i.id = ".$id;

    return current(processaSubConsulta($query));
}

function getEdicao($id){

    $query = "SELECT
    ie.status,
    ie.indicacao,
    ie.solicitacao,
    s.nome as sintoma,
         (select 
            nome
            from plantas_nomes 
            Where plantas_medicinais_id = ie.plantas_medicinais_id ORDER BY nome_tipo_planta_id ASC LIMIT 1) as planta
    FROM indicacao_edicao ie
    INNER JOIN sintomas s
    ON s.id = ie.sintomas_id
    WHERE ie.id = ". $id;

    return current(processaSubConsulta($query));

}