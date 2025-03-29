<?php

require_once 'Conexion.php';

class Usuario extends Conexion {
    private $conexion;

    public function __construct(){
        $this->conexion = parent::getConexion();
    }

    public function add ($params = []): bool {
        $saveStatus = false;

        try {
            $passHasheada = password_hash($params['userpass'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nombre, usuario, userpass) VALUES (?,?,?)";
            $consulta = $this->conexion->prepare($sql);
            $saveStatus = $consulta->execute(array(
                $params['nombre'],
                $params['usuario'],
                $passHasheada
            ));
            return $saveStatus;
        } catch (Exception $e) {
            return $saveStatus;
        }
    }

    public function login($data) {
        try {
            $conexion = parent::getConexion();
            $sql = "SELECT idusuario, usuario, userpass FROM usuarios WHERE usuario = ?";
            $query = $conexion->prepare($sql);
            $query->execute([$data["usuario"]]);
            $usuario = $query->fetch(PDO::FETCH_ASSOC);
    
            if ($usuario) {
                // Verificar si la contraseña es correcta
                if (password_verify($data["userpass"], $usuario["userpass"])) {
                    return ["success" => true, "message" => "Login exitoso", "idusuario" => $usuario["idusuario"]];
                } else {
                    return ["success" => false, "error" => "Contraseña incorrecta"];
                }
            } else {
                return ["success" => false, "error" => "Usuario no encontrado"];
            }
        } catch (Exception $e) {
            return ["success" => false, "error" => "Error en la base de datos: " . $e->getMessage()];
        }
    }
    
    
    
}

