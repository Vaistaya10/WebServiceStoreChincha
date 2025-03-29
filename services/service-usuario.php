<?php

require_once "../models/Usuario.php";
$usuario = new Usuario();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Content-Type: application/json; charset=UTF-8");

// Obtener el método de la solicitud
$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo == 'GET') {
    echo json_encode(["success" => false, "error" => "Método GET no implementado"]);
    exit;
}

// Si la solicitud es POST
else if ($metodo == 'POST') {
    // Leer el cuerpo de la solicitud JSON
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    // Verificar si los datos se recibieron correctamente
    if (!$data || !isset($data["q"])) {
        echo json_encode(["success" => false, "error" => "Parámetro 'q' no especificado"]);
        exit;
    }

    switch ($data["q"]) {
        case 'add':
            $response = $usuario->add($data);
            break;
        case 'login':
            $response = $usuario->login($data);
            break;
        default:
            $response = ["success" => false, "error" => "Operación no válida"];
            break;
    }

    echo json_encode($response);
}
?>
