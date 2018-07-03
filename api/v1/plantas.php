<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';

if ($metodo == "GET") {    
    /*tipo: plantas ou sintomas
    ordem: 1 ->melhor classificacao, 2-> mais visualizacoes, 3-> alfabetica
    termo: texto para pesquisa 
    accept : origem painel
    */
    $model = getModel();
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
        Where plantas_medicinais_id = planta_id ORDER BY nome_tipo_planta_id ASC LIMIT 1) as nome
        from plantas_nomes pn
        INNER JOIN plantas_medicinais pm
        ON pm.id = pn.plantas_medicinais_id
        WHERE pm.status = 1        
        AND (select count(*) from indicacao i WHERE i.plantas_medicinais_id = pm.id) > 0
        AND (pm.descricao_resumida like'%". $model['termo'] ."%' OR
        pn.nome like'%". $model['termo'] ."%')
        GROUP BY pm.id ";
        
        if($model['ordem'] == '1'){
            $query .= "ORDER BY classificacao DESC, visualizacoes DESC, nome ASC";
        }elseif($model['ordem'] == '2'){
            $query .= "ORDER BY visualizacoes DESC,classificacao DESC, nome ASC";
        }else{
            $query .= "ORDER BY nome ASC,classificacao DESC, visualizacoes DESC";
        }
        
        $dados = processaSubConsulta($query);
        
        foreach ($dados as $row => $value) {            
            $dados[$row]["nomes"] = getPlantaNome($dados[$row]["planta_id"]);
        }
        
        echo json_encode($dados);    
    }else{
        //PAINEL
        $query = "SELECT 
        pm.id as planta_id,
        (select 
        nome
        from plantas_nomes 
        Where plantas_medicinais_id = planta_id ORDER BY nome_tipo_planta_id ASC LIMIT 1) as nome
        from plantas_nomes pn
        INNER JOIN plantas_medicinais pm
        ON pm.id = pn.plantas_medicinais_id 
        GROUP BY pm.id
        ORDER BY nome ASC";
        
        processaConsulta($query);
        
    }
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