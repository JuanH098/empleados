<?php
include_once("../DAO/EmpleadoBBDD.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nif = $_POST["nif"];
    $motivo = $_POST["motivo"];

    try {
        $empleadodao = new EmpleadoBBDD();
        
        $empleadodao->añadirAntiguos($nif, $motivo);

        $empleadodao->DarBajaEmp($nif);
        // Eliminar empleado
       
        session_start();

        if (!isset($_SESSION['eliminaciones'])) {
            $_SESSION['eliminaciones'] = 1;
        } else {
            $_SESSION['eliminaciones']++;
        }
        // Añadir empleado a la tabla de antiguos


        header("Location: ../Vista/GenericErr.php?message=" . "Empleado eliminado con éxito.");
    } catch (Exception $e) {
        header("Location: ../Vista/GenericErr.php?message=" . urlencode($e->getMessage()));
    }
}
?>