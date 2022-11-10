<?php
require(dirname(__DIR__) . '/../db/conexion.php');
require(dirname(__DIR__) . '/../modelo/tabla1.php');
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

//OBTENER TODOS LOS REGISTROS DE LA TABLA 1
//Conexion Con el servidor
try {
    $tabla1 = new tabla1();
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

// Ejecución de la consulta
try {    
    // Obtener datos del formulario 
    $id = $params['id'];
    $nombre = $params['nombre'];
    $apellido = $params['apellido'];
    $sexo = $params['sexo'];

    if (empty($nombre) || empty($apellido) || empty($sexo)) {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(400);
        echo json_encode([
            'Error' => 'Faltan datos'
        ]);
        die();
    }

    // Validar que el sexo sea M o F
    if ($sexo !== 'M' && $sexo !== 'F') {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(400);
        echo json_encode([
            'Error' => 'El sexo debe ser M o F'
        ]);
        die();
    }

    // Validar que el nombre y apellido no tengan números
    if (preg_match('/[0-9]/', $nombre) || preg_match('/[0-9]/', $apellido)) {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(400);
        echo json_encode([
            'Error' => 'El nombre y apellido no deben tener números'
        ]);
        die();
    }

    // Validar que el id sea un número
    if (!is_numeric($id)) {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(400);
        echo json_encode([
            'Error' => 'El id debe ser un número'
        ]);
        die();
    }

    // ACTUALIZAR UN REGISTRO EN LA TABLA 1
    $result = $tabla1->updateTabla1($id, $nombre, $apellido, $sexo);

    if ($result) {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'Registro' => 'Actualizado'
        ]);
    } else {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(500);
        echo json_encode([
            'Error' => 'Error al actualizar el registro'
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
