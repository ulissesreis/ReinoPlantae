<?php

function processaConsulta($query)
{
    require 'conecta.php';

    if (!$result = $mysqli->query($query)) {        
        setHeader(500);                    
        die($query);
    }    
    
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    $result->close();
    $mysqli->close();

    setHeader(200);    
    echo json_encode($rows);    
}

function getDados()
{
    return json_decode(file_get_contents('php://input'), true);
}
function getModel()
{
    if (isset($_GET['model'])) {
        return json_decode($_GET['model'], true);
    } else {
        return false;
    }
}
function processaInsert($query)
{
    $query = ajustarQuery($query);
    require 'conecta.php';

    if ($mysqli->query($query) === true) {
        $insert_id = mysqli_insert_id($mysqli);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }

    $mysqli->close();
    return $insert_id;
}

function processaDelete($query)
{
    require 'conecta.php';

    if (!$mysqli->query($query) === true) {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
    $mysqli->close();
}

function processaUpdate($query)
{

    $query = ajustarQuery($query);
    require 'conecta.php';

    if (!$mysqli->query($query) === true) {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
    $mysqli->close();
}

function executaProcedure($query)
{

    $query = ajustarQuery($query);
    require 'conecta.php';

    if (!$mysqli->query($query) === true) {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
    $mysqli->close();
}

function escape($valor)
{

    if ($valor != null && $valor != '') {
        return addslashes($valor);
    } else {
        return 'null';
    }
}
function validarTexto($valor)
{
    if ($valor != null && $valor != '') {
        return true;
    } else {
        return false;
    }
}
function validarNumero($valor)
{
    if ($valor != null && $valor != '' && $valor > 0) {
        return true;
    } else {
        return false;
    }
}

function validaIntegridade($pessoa, $id)
{
    if ($pessoa != $id) {
        die("{'integridade':'error'}");
    }
}

function ajustarQuery($query)
{
    $query = str_replace(", ", ",", $query);
    $query = str_replace(" ,", ",", $query);
    $query = str_replace("' ,", "',", $query);
    $query = str_replace("''", "NULL", $query);
    $query = str_replace("= ", "=", $query);
    $query = str_replace(" =", "=", $query);
    $query = str_replace("=,", "=NULL,", $query);
    $query = str_replace(",)", ",NULL)", $query);

    return $query;
}
function processaSubConsulta($query)
{
    require 'conecta.php';

    if (!$result = $mysqli->query($query)) {
        die($query);
    }

    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

function setHeader($codigoHttp){

    header('Content-Type: application/json; charset=utf8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    header("Cache-Control: no-cache, must-revalidate");
    header("HTTP/1.1 " . $codigoHttp);
}


function preRequest($query)
{
    require '../conecta.php';

    if (!$result = $mysqli->query($query)) {
        setHeader(500);                        
        die();
    }

    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    $result->close();
    $mysqli->close();

    return $rows;
}