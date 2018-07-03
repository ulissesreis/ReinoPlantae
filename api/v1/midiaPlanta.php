<?php

require_once './../includes/validacoes.php';
require_once './../includes/funcoes.php';

$_SESSION['arquivoUpload'] = NULL;
$_UP['pasta'] = './../../repositorio/';
$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
$_UP['extensoes'] = array('jpg', 'png','jpeg', 'gif');
$_UP['renomeia'] = true;
$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo enviado é muito grande, envie arquivos de até 2Mb.';//O arquivo no upload é maior do que o limite do PHP
$_UP['erros'][2] = 'O arquivo enviado é muito grande, envie arquivos de até 2Mb.';//O arquivo ultrapassa o limite de tamanho especifiado no HTML
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
if ($_FILES['file']['error'] != 0) {
  setHeader(500);
  echo '{"status":"error","message":"Não foi possível fazer o upload, erro: ' . $_UP['erros'][$_FILES['file']['error']].'"}';
  exit; 
}
$tmp = explode('.', $_FILES['file']['name']);
$extensao = strtolower(end($tmp));

if (array_search($extensao, $_UP['extensoes']) === false) {
  setHeader(400);
  echo '{"status":"invalid":"message":"Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif"}';    
  exit;
}
if ($_UP['tamanho'] < $_FILES['file']['size']) {
  setHeader(400);
  echo '{"status":"invalid":"message":"O arquivo enviado é muito grande, envie arquivos de até 2Mb."}';      
  exit;
}
if ($_UP['renomeia'] == true) {
  $nome_final = md5(time()).'.jpg';
} else {
  $nome_final = $_FILES['file']['name'];
}

if (move_uploaded_file($_FILES['file']['tmp_name'], $_UP['pasta'] . $nome_final)) {
  $_SESSION['arquivoUpload'] = $nome_final;
  setHeader(200);
  echo '{"status":"success","image":"'.$nome_final.'"}';
} else {
  setHeader(500);
  echo '{"status":"error"}';  
}