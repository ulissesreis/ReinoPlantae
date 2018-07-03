<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';

if ($metodo == "POST") {

    unset($_SESSION['email']);
    unset($_SESSION['nome']);
    unset($_SESSION['admin']);
    unset($_SESSION['perfil']);
    
    setHeader(200);
}
