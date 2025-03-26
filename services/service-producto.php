<?php


require_once "../models/Producto.php";
$producto = new Producto();


header("Acces-control-Allow-Origin");
header("Acces-Control-Allow-Methods: GET,POST");
header("Allow:GET,POST");
header("Content-type: application/json; charset=utf-8");


$metodo = $_SERVER['REQUEST_METHOD'];

if($metdo == 'GET'){

  $registros = [];

  if(isset($_GET['q'])){
  switch ($_GET['q']) {
    case 'ShowAll':
      $registros = $producto->getAll();
      break;
  }
  }

  header('HTTP/1.1 200 piola');
  echo json_encode($registros);

}

elseif ($metodo == 'POST') {
  $inputJSON = file_get_contents(filename: 'php://input');
  $datos = json_decode($inputJSON, true);

  $registro = [
    "tipo"=> $datos["tipo"],
    "genero"=> $datos["genero"],
    "talla"=> $datos["talla"],
    "precio"=> $datos["precio"]
  ];

  $status = $producto->add($registro);

  header('HTTP/1.1 200 piola');
  echo json_encode(["status" => $status]);
}