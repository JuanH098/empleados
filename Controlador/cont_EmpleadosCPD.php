<?php
include_once("../DAO/EmpleadoBBDD.php");
include_once("../Modelo/Empleado.php");

// Definición de la excepción personalizada
class BajoMinimosException extends Exception {
}

// Controlador (cont_Empleados.php)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nif = $_POST["codigoDepartamento"];

    try {
        $empleadodao = new EmpleadoBBDD();
        $empleadosTabla = $empleadodao->empleadosPorDepartamento($nif);

        if (empty($empleadosTabla)) {
            echo "No hay empleados en el departamento seleccionado.";
        } else {
            // Verificar si hay menos de 3 empleados en el departamento
            if (count($empleadosTabla) < 3) {
                throw new BajoMinimosException("Departamento bajo mínimos. Debe haber al menos 3 empleados.");
            } else {
                // Mostrar la tabla de empleados
                // Puedes imprimir o manipular $empleadosTabla según tus necesidades
                $empleadosTabla;
            }
        }
    } catch (BajoMinimosException $e) {
        // Manejar la excepción personalizada
        echo $e->getMessage();  // Muestra el mensaje de la excepción
    } catch (Exception $e) {
        // Manejar otras excepciones
        header("Location: ../Vista/GenericErr.php?message=" . urlencode($e->getMessage()));
    }
}
?>