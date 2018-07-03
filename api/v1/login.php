<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';

if ($metodo == "POST") {
    $dados = getDados();
        
    $query = "SELECT id,
                nome,
                perfil
                FROM usuario 
                WHERE binary senha = '".$dados['senha']."' AND email = '".$dados['email']."' AND status = 1
                LIMIT 1";
    $result = processaSubConsulta($query);

    if(count($result) == 0){
        setHeader(401);
        die();
    }

    $_SESSION['email'] = $dados['email'];
    $_SESSION['nome'] = current($result)['nome'];
    $_SESSION['admin'] = current($result)['id'];
    $_SESSION['perfil'] = current($result)['perfil'];
    
    setHeader(200);

}
if ($metodo == "PUT") {
    echo '{}';
    die;
}
if ($metodo == "DELETE") {
    echo '{}';
    die;
}