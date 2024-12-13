<?php

require_once '../DAO/EmpleadoBBDD.php';

// Crear una instancia de la clase EmpleadoBBDD
$empleadoBBDD = new EmpleadoBBDD();

try {

    // Ejemplo de cómo utilizar la función para obtener empleados antiguos
    $empleadosAntiguos = $empleadoBBDD->obtenerEmpleadosAntiguos();

    // Puedes imprimir o procesar la información de los empleados antiguos según tus necesidades

} catch (Exception $e) {
    // Manejo de excepciones
    echo "Error: " . $e->getMessage();
}

?>
