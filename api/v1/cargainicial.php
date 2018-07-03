<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';
if ($metodo == "GET") {    
    
    if(!isset($_SESSION['admin'])){
        echo '{"painel":false,"admin":false,"nome":null,"email":null,"perfil":null}';
    }else{
        echo '{"admin":'.$_SESSION['admin'].',
            "painel":true,
            "nome":"'.$_SESSION['nome'].'",
            "perfil":"'.$_SESSION['perfil'].'",
            "email":"'.$_SESSION['email'].'"}';                
        }         
        
    } 
    setHeader(200);   