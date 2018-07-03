<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';
if ($metodo == "GET") {    
    //  termo: texto para pesquisa           
    //  accept : origem painel
    $model = getModel();
    
    if($model['origem'] =='cliente'){
        
        $query = "SELECT  
        s.id as sintoma_id,
        s.nome,
        s.descricao_resumida
        FROM sintomas s
        where s.status = 1 AND (s.descricao_resumida like'%". $model['termo'] ."%' OR
        s.nome like'%". $model['termo'] ."%')
        ORDER BY s.nome ASC";
    }else{
        //PAINEL
        $query = "SELECT  
        s.id as sintoma_id,
        s.nome        
        FROM sintomas s        
        ORDER BY s.nome ASC";
    }
    
    processaConsulta($query);
}
if ($metodo == "POST") {
    $query = "";    
    executaProcedure($query);
}
if ($metodo == "PUT") {
    $query = "";    
    executaProcedure($query);
}