<?php
include_once("../Vista/MostrarEmp.php"); // Cambia la ruta al archivo HTML de búsqueda
include_once("../DAO/EmpleadoBBDD.php"); // Asegúrate de incluir el archivo adecuado
include_once("../Modelo/Empleado.php"); // Asegúrate de incluir el archivo adecuado

if (isset($_REQUEST['buscar'])) {
    $nif = $_REQUEST['nif'];
}

try {
    $empleadodao = new EmpleadoBBDD(); 
    $empleadosTabla = $empleadodao->ObtenerEmpleadoPorNIF($nif); 

    if ($empleadosTabla) {
        
        echo "<div class='container'>";
        echo "<div class='title'>Datos del Empleado:</div>";
        echo "<div class='employee-data'><span class='header'>NIF:</span> " . $empleadosTabla->getNIF() . "</div>";
        echo "<div class='employee-data'><span class='header'>Código:</span> " . $empleadosTabla->getCodigo() . "</div>";
        echo "<div class='employee-data'><span class='header'>Apellidos:</span> " . $empleadosTabla->getApellidos() . "</div>";
        echo "<div class='employee-data'><span class='header'>Nombre:</span> " . $empleadosTabla->getNombre() . "</div>";
        echo "<div class='employee-data'><span class='header'>Profesión:</span> " . $empleadosTabla->getProfesion() . "</div>";
        echo "<div class='employee-data'><span class='header'>Salario:</span> " . $empleadosTabla->getSalario() . "</div>";
        echo "<div class='employee-data'><span class='header'>Fecha de Nacimiento:</span> " . $empleadosTabla->getFechaNac() . "</div>";
        echo "<div class='employee-data'><span class='header'>Fecha de Ingreso:</span> " . $empleadosTabla->getFechaIngreso() . "</div>";
        echo "</div>"; 

    } else {
        header("Location: ../Vista/GenericErr.php?message=" . urlencode($e->getMessage()));
    }
} catch (Exception $e) {
    header("Location: ../Vista/GenericErr.php?message=" . urlencode($e->getMessage()));
}
?>