<?php
session_start();

if (!isset($_COOKIE['ambito'])){
    header("Location: ../Vista/login.php");
exit();
}else{
    setcookie('contador' , $_COOKIE['contador'] + 1, time() + (86400 * 30), "/");
    
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" href="../css/bulma-min.css">
    <title>Empleados Baja</title>
</head>
<body>
    <h1>Empleados Antiguos</h1>

    <?php
    require_once '../Controlador/cont_EmpleadosBaja.php';

    try {
        // Ejecutar el controlador para obtener y procesar la información
        // (Este código es solo un ejemplo, ajusta según tus necesidades)
        echo "<p>Información de empleados antiguos por baja médica:</p>";
        echo "<ul>";
        foreach ($empleadosAntiguos as $empleado) {
            if ($empleado['motivo'] === 'baja medica') {
                echo "<li>{$empleado['nombre']} - {$empleado['profesion']} - {$empleado['motivo']}</li>";
            }
        }
        echo "</ul>";

        echo "<p>Información de empleados antiguos por otras razones de baja:</p>";
        echo "<ul>";
        foreach ($empleadosAntiguos as $empleado) {
            if ($empleado['motivo'] !== 'baja medica') {
                echo "<li>{$empleado['nombre']} - {$empleado['profesion']} - {$empleado['motivo']}</li>";
            }
        }
        echo "</ul>";
    } catch (Exception $e) {
        // Manejo de excepciones
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
    ?>
</body>
</html>
