<?php
include_once("../Modelo/Empleado.php");
include_once("../DAO/EmpleadoBBDD.php");
include_once("../DAO/DepartamentoBBDD.php");

try {

    // Obtener el listado de los empleados
    $daoEmpleado = new EmpleadoBBDD();
    $empleadosTabla = $daoEmpleado->listaEmpleado();
    // Excluir el campo 'id' de cada fila de empleados
    if (empty($empleadosTabla)) {
        header("Location:../Vista/GenericErr.php?message=" . urlencode("No hay empleados"));
    } else {
        $datosEmpleado = $empleadosTabla;
    }
   

} catch (Exception $e) {
    // Redirigir con un mensaje de error
    header("Location:../Vista/GenericErr.php?message=" . urlencode($e->getMessage()));
}

?>