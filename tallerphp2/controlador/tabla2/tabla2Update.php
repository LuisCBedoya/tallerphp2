<?php
require(dirname(__DIR__) . '/../db/conexion.php');
require(dirname(__DIR__) . '/../modelo/tabla2.php');
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

//OBTENER TODOS LOS REGISTROS DE LA TABLA 2
//Conexion Con el servidor
try {
    $tabla2 = new tabla2();
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

// Ejecución de la consulta
try {
    // Obtener datos del formulario 
    $id = $params['id'];
    $departamento = $params['departamento'];
    $ciudad = $params['ciudad'];
    $fecha_ped = $params['fecha_ped'];
    $fecha_nac = $params['fecha_nac'];
    $fecha = $params['fecha'];
    $valor = $params['valor'];
    $cantidad_prod = $params['cantidad_prod'];
    $correo = $params['correo'];
    $id1 = $params['id1'];

    // fecha en formato dd/mm/aaaa
    $fecha_ped = date("Y-m-d", strtotime($fecha_ped));
    $fecha_nac = date("Y-m-d", strtotime($fecha_nac));
    $fecha = date("Y-m-d", strtotime($fecha));

    if (empty($id) || empty($departamento) || empty($ciudad) || empty($fecha_ped) || empty($fecha_nac) || empty($fecha) || empty($valor) || empty($cantidad_prod) || empty($correo) || empty($id1)) {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(400);
        echo json_encode([
            'Error' => 'Faltan datos'
        ]);
        die();
    }

    // Validar que el nombre y apellido no tengan números
    if (empty($departamento) || empty($ciudad) || empty($fecha_ped) || empty($fecha_nac) || empty($fecha) || empty($valor) || empty($cantidad_prod) || empty($correo) || empty($id2)) {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(400);
        echo json_encode([
            'Error' => 'Faltan datos'
        ]);
        die();
    }

    // Validar que departamento y ciudad no tengan números
    if (preg_match('/[0-9]/', $departamento) || preg_match('/[0-9]/', $ciudad)) {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(400);
        echo json_encode([
            'Error' => 'El departamento y ciudad no deben tener números'
        ]);
        die();
    }

    // Validar que el correo sea válido
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(400);
        echo json_encode([
            'Error' => 'El correo no es válido'
        ]);
        die();
    }

    // Validar que el id2 sea un número
    if (!is_numeric($id2)) {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(400);
        echo json_encode([
            'Error' => 'El id2 debe ser un número'
        ]);
        die();
    }

    // Validar que el valor sea un número
    if (!is_numeric($valor) || !is_numeric($cantidad_prod)) {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(400);
        echo json_encode([
            'Error' => 'El valor y la cantidad de productos deben ser números'
        ]);
        die();
    }

    // Validar que el valor sea mayor a 0
    if ($valor <= 0 || $cantidad_prod <= 0) {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(400);
        echo json_encode([
            'Error' => 'El valor y la cantidad de productos deben ser mayores a 0'
        ]);
        die();
    }

    // Validar que la fecha de nacimiento sea menor a la fecha de pedido
    if ($fecha_nac > $fecha_ped) {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(400);
        echo json_encode([
            'Error' => 'La fecha de nacimiento debe ser menor a la fecha de pedido'
        ]);
        die();
    }

    // Validar que la fecha de pedido sea menor a la fecha de entrega
    if ($fecha_ped > $fecha) {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(400);
        echo json_encode([
            'Error' => 'La fecha de pedido debe ser menor a la fecha de entrega'
        ]);
        die();
    }

    // Validar que la fecha de entrega sea menor a la fecha actual
    if ($fecha > date("Y-m-d")) {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(400);
        echo json_encode([
            'Error' => 'La fecha de entrega debe ser menor a la fecha actual'
        ]);
        die();
    }

    // ACTUALIZAR UN REGISTRO EN LA TABLA 2
    $result = $tabla2->updateTabla2($id, $departamento, $ciudad, $fecha_ped, $fecha_nac, $fecha, $valor, $cantidad_prod, $correo, $id1);

    if ($result) {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'Registro' => 'Actualizado'
        ]);
    } else {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(400);
        echo json_encode([
            'Error' => 'Asegurese de que sean datos nuevos'
        ]);
    }
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    //error 500 
    http_response_code(500);
    echo json_encode([
        'Error' => 'Error en el servidor'
    ]);

    die();
}
