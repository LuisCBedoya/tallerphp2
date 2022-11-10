<?php
require(dirname(__DIR__) . '/../db/conexion.php');
require(dirname(__DIR__) . '/../modelo/tabla1.php');
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
    // Obtener los registros de la tabla 1
    $result = $tabla1->getTabla1();
    
    // Retorno resultados
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        'Tabla 1' => $result
    ]);

} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>