<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';
if ($metodo == "GET") {    
    $model = getModel();
    if (!$model) {
        die('failure');
    }    
    
    if($model['origem'] =='cliente'){
        
        $query = "SELECT 
        s.nome,
        s.descricao_resumida,
        s.descricao_completa
        from sintomas s
        where s.status = 1 
        AND s.id = ".$model['sintoma_id'];
        
        $dados = processaSubConsulta($query);
        
        foreach ($dados as $row => $value) {
            $dados[$row]["indicacoes"] = getIndicacao($model['sintoma_id']);
        }
        
        echo json_encode($dados);
    }else{
        $query = "SELECT
        s.id as sintoma_id, 
        s.nome,
        s.descricao_resumida,
        s.status,
        s.descricao_completa
        from sintomas s
        where s.id = ".$model['sintoma_id'];
        
        processaConsulta($query);
    }    
    
}
if ($metodo == "POST") {    
    // INSERT,UPDATE sintoma
    $dados = getDados();    
    
    $query = "CALL sp_SetSintoma(".escape($dados['sintoma_id']).", 
    ".$_SESSION['admin'] .", 
    '".$dados['nome']."',
    '".$dados['descricao_resumida']."',
    '".$dados['descricao_completa']."',
    ".$dados['status'].")";
        
    executaProcedure($query);
}
function getIndicacao($sintoma_id){
    
    $query ="SELECT 
    i.id as indicacao_id,
    p.id as planta_id,
    p.descricao_resumida,
    i.indicacao,
    p.imagem,
    (SELECT CEILING(avg(voto)) FROM plantas_classificacao WHERE plantas_medicinais_id = planta_id) as classificacao,
    p.visualizacoes,
    (select 
    nome
    from plantas_nomes 
    Where plantas_medicinais_id = planta_id ORDER BY nome_tipo_planta_id ASC limit 1) as nome
    FROM indicacao i
    INNER JOIN sintomas s
    ON i.sintomas_id = s.id
    INNER JOIN plantas_medicinais p
    ON i.plantas_medicinais_id = p.id
    WHERE i.status = 1 AND s.status = 1 AND p.status = 1 AND s.id = $sintoma_id";
    
    
    $dados = processaSubConsulta($query);
    
    foreach ($dados as $row => $value) {
        $dados[$row]["nomes"] = getPlantaNome($dados[$row]["planta_id"]);
    }
    
    return $dados;
}

function getPlantaNome ($planta_id){
    $query = "SELECT 
    nmpla.nome,
    notplan.nome as tipo
    from plantas_medicinais pm
    inner join plantas_nomes nmpla
    on nmpla.plantas_medicinais_id = pm.id
    inner join nome_tipo_planta notplan
    on nmpla.nome_tipo_planta_id = notplan.id
    where pm.status = 1 AND notplan.status = 1 
    AND pm.id = $planta_id ORDER BY notplan.id";
    
    return processaSubConsulta($query);
}