<?php
require(dirname(__DIR__) . '/../db/conexion.php');
require(dirname(__DIR__) . '/../modelo/tabla2.php');
//OBTENER UN REGISTRO DE LA TABLA 2 POR EL ID2

$ID1 = $_GET['id'];

// Ejecución de la consulta
try {
    // validar que id sea un número
    if (is_numeric($ID1)) {
        $tabla2 = new Tabla2();
        $result = $tabla2->getTabla2ById($ID1);
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