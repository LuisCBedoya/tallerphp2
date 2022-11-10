<?php
require(dirname(__DIR__) . '/../db/conexion.php');
require(dirname(__DIR__) . '/../modelo/tabla1.php');
//OBTENER UN REGISTRO DE LA TABLA 1 POR EL ID1

$ID1 = $_GET['id'];

// Ejecución de la consulta
try {
    // validar que id sea un número
    if (is_numeric($ID1)) {
        $tabla1 = new Tabla1();
        $result = $tabla1->getTabla1ById($ID1);
        if (count($result) > 0) {
            $json = array("status" => 1, "info" => $result);
        } else {
            $json = array("status" => 0, "info" => "No se encontraron registros");
        }
    } else {
        $json = array("status" => 0, "info" => "El id debe ser un número");
    }
} catch (PDOException $e) {
    $json = array("status" => 0, "info" => $e->getMessage());
}

// Envío de la respuesta
header('Content-type: application/json; charset=utf-8');
echo json_encode($json);
?>