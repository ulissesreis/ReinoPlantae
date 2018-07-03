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
        pm.id as planta_id,
        pm.descricao_resumida,
        pm.descricao_completa,
        pm.visualizacoes,
        pm.imagem,
        coalesce((SELECT CEILING(avg(voto)) FROM plantas_classificacao WHERE plantas_medicinais_id = planta_id),1) as classificacao,
        (select 
        nome
        from plantas_nomes 
        Where plantas_medicinais_id = planta_id ORDER BY nome_tipo_planta_id ASC limit 1) as nome
        from plantas_medicinais pm	
        where pm.status = 1
        AND pm.id = ".$model['planta_id'];
        
        $dados = processaSubConsulta($query);
        
        foreach ($dados as $row => $value) {
            $dados[$row]["indicacoes"] = sintomasListar($dados[$row]["planta_id"]);
            $dados[$row]["nomes"] = getPlantaNome($dados[$row]["planta_id"]);
        }
        
        echo json_encode($dados);
        executaProcedure("CALL sp_PlantaVisualizacaoContabilizar(".$model['planta_id'].")");
    }else{
        $query = "SELECT 
        pm.id as planta_id,
        pm.descricao_resumida,
        pm.descricao_completa,        
        pm.status,
        pm.imagem,
        (select 
        nome
        from plantas_nomes 
        Where plantas_medicinais_id = planta_id
        ORDER BY nome_tipo_planta_id ASC limit 1) as nome
        from plantas_medicinais pm
        WHERE pm.id  = ".$model['planta_id'];
        
        processaConsulta($query);
        
    }
}
if ($metodo == "POST") { //criacao alteração
    $dados = getDados();
    
    $query = "CALL sp_SetPlanta("
    .escape($dados['planta_id']).","
    .$_SESSION['admin'] ."," 
    ."'".$dados['nome']."'," 
    ."'".$_SESSION['arquivoUpload']."',"
    ."'".$dados['descricao_resumida']."',"
    ."'".$dados['descricao_completa']."',"
    .$dados['status'].")";    
    
    echo $query;
    executaProcedure($query);
    
    $_SESSION['arquivoUpload'] = NULL;
}

function sintomasListar($planta_id){
    
    $query ="SELECT 
    s.id as sintoma_id,
    i.id as indicacao_id,
    i.indicacao,
    s.nome,
    s.descricao_resumida 
    FROM indicacao i
    INNER JOIN sintomas s
    ON s.id = i.sintomas_id
    WHERE  i.status = 1 AND i.plantas_medicinais_id = $planta_id";
    
    return processaSubConsulta($query);
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