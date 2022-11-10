<?php
require(dirname(__DIR__) . '/../db/conexion.php');
require(dirname(__DIR__) . '/../modelo/tabla2.php');
//OBTENER TODOS LOS REGISTROS DE LA TABLA 2
//Conexion Con el servidor
try {
    $tabla2 = new Tabla2();
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

// Ejecución de la consulta
try {    
    // Obtener los registros de la tabla 2
    $result = $tabla2->getTabla2();
    
    // Retorno resultados
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        'Tabla 2' => $result
    ]);

} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>