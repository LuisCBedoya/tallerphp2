<?php
require(dirname(__DIR__) . '/../modelo/tabla2.php');
require(dirname(__DIR__) . '/../modelo/tabla1.php');
require(dirname(__DIR__) . '/../db/conexion.php');
$params = json_decode(file_get_contents('php://input'), true);
$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'POST') {
    header('Content-type:application/json;charset=utf-8');
    http_response_code(405);
    echo json_encode([
        'Error' => 'Método no permitido'
    ]);
    die();
}
$fecha_ini = $params['fecha_ini'] ?? null;
$fecha_fin = $params['fecha_fin'] ?? null;

if(empty($fecha_ini) || empty($fecha_fin)) {
    header('Content-type:application/json;charset=utf-8');
    http_response_code(400);
    echo json_encode([
        'Error' => 'Faltan datos'
    ]);
    die();
}

// Validar que las fechas este en formato dd/mm/aaaa y que el mes sea entre 1 y 12
if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $fecha_ini) && preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $fecha_fin)) {
    // pasar fecha del formato dd/mm/aaaa al formato aaaa-mm-dd
    $fecha_ini = date('Y-m-d', strtotime(str_replace('/', '-', $fecha_ini)));
    $fecha_fin = date('Y-m-d', strtotime(str_replace('/', '-', $fecha_fin)));
} else {
    header('Content-type:application/json;charset=utf-8');
    http_response_code(400);
    echo json_encode([
        'mensaje' => 'La fecha inicial o final no tiene el formato dd/mm/aaaa'
    ]);
    die();
}

// Obtener los registros de la tabla 2 por fecha entre fecha_ini y fecha_fin y unir con la tabla 1
try {
    $tabla2 = new Tabla2();
    $result = $tabla2->getTabla2ByFecha($fecha_ini, $fecha_fin);
    $tabla1 = new Tabla1;
    $result = $tabla1->joinTabla1Tabla2($result);
    
    // Retorno resultados
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        'Registros' => $result
    ]);

} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>