<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';
if ($metodo == "GET") {    
    
    $model = getModel();
    
    $query = "SELECT
    u.id as user_id,
	u.nome,
    u.email,
    u.perfil,
    u.senha,
    u.status
    from usuario u
    where u.id = ". $model['user_id'];
    
    processaConsulta($query);
}
if ($metodo == "POST") {
    $dados = getDados();
    
    $query = "INSERT INTO usuario
    (nome,email,senha,status,perfil)
    VALUES ('".$dados['nome']."',
    '".$dados['email']."',
    '".$dados['senha']."',
    ".$dados['status'].",
    ".$dados['perfil'].")";    
    processaInsert($query);
}
if ($metodo == "PUT") {
    $dados = getDados();

    $query = "UPDATE usuario SET
    nome = '".$dados['nome']."',
    email = '".$dados['email']."',
    senha = '".$dados['senha']."',
    status = ".$dados['status'].",
    perfil = ".$dados['perfil']."
    WHERE id = ".$dados['user_id']; 

    processaUpdate($query);
}
