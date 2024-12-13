<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados Dados de Baja</title>
</head>
<body>
    <?php
  
    require_once("../Controlador/cont_dadosdebajaahora.php");
    
    // Verificar si hay empleados eliminados en la sesión
    if (isset($_SESSION['empleadosEliminados']) && !empty($_SESSION['empleadosEliminados'])) {
        $empleadosEliminados = $_SESSION['empleadosEliminados'];

        // Mostrar la información de los empleados eliminados en esta sesión
        echo "<h2>Empleados Dados de Baja en esta Sesion:</h2>";
        echo "<ul>";
        foreach ($empleadosEliminados as $empleado) {
            echo "<li>{$empleado['nombre']} - {$empleado['profesion']} - Motivo: {$empleado['motivo']}</li>";
        }
        echo "</ul>";

        // Limpiar la información de empleados eliminados en la sesión después de mostrarla
        unset($_SESSION['empleadosEliminados']);
        
    } else {
        echo "<p>No hay empleados dados de baja en esta sesión.</p>";
    }
    ?>
</body>
</html>
