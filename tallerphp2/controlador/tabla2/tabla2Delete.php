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

    if (empty($id)) {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(400);
        echo json_encode([
            'Error' => 'No se ha enviado el id'
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

    $dato = $tabla2->getTabla2ById($id);

    if (empty($dato)) {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(404);
        echo json_encode([
            'Error' => 'No se ha encontrado el registro'
        ]);
        die();
    }

    // ELIMINAR UN REGISTRO EN LA TABLA 2
    $result = $tabla2->deleteTabla2($id);

    if ($result) {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'Registro' => 'Eliminado'
        ]);
    } else {
        header('Content-type:application/json;charset=utf-8');
        http_response_code(500);
        echo json_encode([
            'Error' => 'Error al eliminar el registro'
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
