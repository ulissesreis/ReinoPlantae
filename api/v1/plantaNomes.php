<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';
if ($metodo == "GET") { 
    $model = getModel();
    if (!$model) {
        die('failure');
    }        
    
    $query = "SELECT 
    pn.id as planta_nome_id,
    pn.plantas_medicinais_id as planta_id,        
    pn.nome,    
    nt.nome as tipo_planta
    FROM plantas_nomes pn    
    INNER JOIN nome_tipo_planta nt
    on nt.id = pn.nome_tipo_planta_id
    WHERE pn.plantas_medicinais_id  = ".$model['planta_id'];
    
    processaConsulta($query);    
}
if ($metodo == "POST") { //criacao alteração
    $dados = getDados();
    
    $query = "INSERT INTO plantas_nomes(plantas_medicinais_id,nome,nome_tipo_planta_id) values (".$dados['planta_id'].",'".$dados['nome']."',".$dados['tipo'].")";    
    processaInsert($query);
}
if ($metodo == "DELETE") {
    if(isset($_GET['planta_nome_id'])){
        $query = "DELETE FROM plantas_nomes where id =".$_GET['planta_nome_id'];
        processaDelete($query);
    }
}