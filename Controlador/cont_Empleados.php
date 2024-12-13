<?php
include_once("../DAO/EmpleadoBBDD.php"); // Asegúrate de incluir el archivo adecuado
include_once("../Modelo/Empleado.php"); // Asegúrate de incluir el archivo adecuado

try {
    $empleadodao = new EmpleadoBBDD();
    $empleadosTabla = $empleadodao->empleadosCompletos();
    if (empty($empleadosTabla)) {
        header("Location: ../Vista/GenericErr.php?message=" . urlencode("No hay empleados."));
    } else {
           $empleadosTabla = $empleadodao->empleadosCompletos();
    }

    

} catch (Exception $e) {
    header("Location: ../Vista/GenericErr.php?message=" . urlencode($e->getMessage()));
}


?>