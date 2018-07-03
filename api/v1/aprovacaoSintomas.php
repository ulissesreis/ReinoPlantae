<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';
if ($metodo == "GET") {    
    $query = "SELECT
    e.id as edicao_id,
    e.sintomas_id
    FROM sintomas_edicao e
    WHERE e.usuario_aprovador is null and e.usuario_rejeicao is null";
    $dados = processaSubConsulta($query);
        
    foreach ($dados as $row => $value) {
        $dados[$row]["sintoma"] = getSintoma($dados[$row]['sintomas_id']);
        $dados[$row]["edicao"] = getEdicao($dados[$row]['edicao_id']);
    }
    
    echo json_encode($dados);
        
}
if ($metodo == "POST") { // avaliacao - aprovacao
    $dados = getDados();
    
    $query = "CALL sp_AvaliarSintoma(
        ".$dados['sintoma_id'].",
        ".$_SESSION['admin'].", 
        '".$dados['descricao']."', 
        ".$dados['status'].")";
        
      executaProcedure($query);
}
    
function getSintoma($id){

    if(!isset($id)){
        return null;
    }

    $query = "SELECT
        s.id as sintoma_id, 
        s.nome,
        s.descricao_resumida,
        s.status,
        s.descricao_completa
        from sintomas s
        where s.id = ".$id;

    return current(processaSubConsulta($query));

}

function getEdicao($id){

    $query = "SELECT 
    e.nome,
    e.descricao_resumida,
    e.descricao_completa,
    e.status,
    e.solicitacao,
    u.nome as usuario_solicitante
    FROM sintomas_edicao e
    INNER JOIN usuario u 
    ON u.id = e.usuario_solicitante
    WHERE e.id =". $id;

    return current(processaSubConsulta($query));

}