<?php

require_once '../DAO/EmpleadoBBDD.php';

// Crear una instancia de la clase EmpleadoBBDD
$empleadoBBDD = new EmpleadoBBDD();

try {
    // Obtener los empleados antiguos y almacenarlos en la sesión
    $empleadoBBDD->almacenarEmpleadosAntiguosEnSesion();

 

    $empleadosEliminados = isset($_SESSION['empleadosEliminados']) ? $_SESSION['empleadosEliminados'] : array();

    if (!empty($_SESSION['empleadosAntiguos'])) {
        $empleadosEliminados = array_merge($empleadosEliminados, $_SESSION['empleadosAntiguos']);
    }


    $_SESSION['empleadosEliminados'] = $empleadosEliminados;


} catch (Exception $e) {
 
    echo "Error: " . $e->getMessage();
}

?>

