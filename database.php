<?php
$conexao = mysqli_connect('localhost', 'ergovale_sistema', 'FObm2fcE1AUDxu4y', 'ergovale_sistema');

define('LEVEL_ADMIN', 1);
define('LEVEL_GERENTE', 2);
define('LEVEL_FUNCIONARIO', 3);

if ($conexao->connect_errno) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

function executeQuery($query)
{
    global $conexao;
    $result = $conexao->query($query);
    if (!$result) {
        error_log($query);
        error_log(mysqli_error($conexao));
        echo(mysqli_error($conexao));
        http_response_code(400);
        return false;
    }
    return $result;
}

function jsonResponse($queryString)
{
    try {
        global $conexao;
        $result = executeQuery($queryString);
        $myArray = [];
        while ($row = $result->fetch_assoc()) {
            $myArray[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($myArray);
    } catch (Exception $e) {
        echo $e->getMessage();
        throw new Exception($e->getMessage());
    }
}
