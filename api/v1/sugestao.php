<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';
if ($metodo == "GET") 
{        
    $query = "SELECT 
    id as sugestao_id,
    nome,
    telefone,
    email,
    titulo,
    descricao,
    envio    
    FROM sugestoes
    WHERE status = 1";
    
    processaConsulta($query);
}
if ($metodo == "POST") {
    $dados = getDados();
    
    $query = "CALL sp_SetSugestoes('".$dados['pessoaNome']."','".$dados['telefone']."','".$dados['email']."','".$dados['titulo']."','".$dados['descricao']."')";        
    executaProcedure($query);
}
if ($metodo == "DELETE") {
    $model = getModel();
    $query = "UPDATE sugestoes set status = 0 WHERE id = ". $model['sugestao_id'];
    
    processaUpdate($query);
}