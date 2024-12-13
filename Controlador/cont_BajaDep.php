<<?php
include_once("../DAO/DepartamentoBBDD.php");

if (isset($_POST['darDeBajaDep'])) {
    $codigo_dep = $_POST['codigo_dep'];

    // Verificar si el código del departamento es un número válido
    if (!is_numeric($codigo_dep)) {
        echo "El código del departamento debe ser un número válido.";
        exit;
    }
   
    try {
        $departamentodao = new DepartamentoBBDD();
        $departamentodao->DarBajaDep($codigo_dep);
        
        // Si no se lanzó ninguna excepción, la eliminación del departamento fue exitosa
        header("Location: ../Vista/GenericErr.php?message=" . urlencode("Departamento eliminado correctamente."));
    } catch (Exception $e) {
        header("Location: ../Vista/GenericErr.php?message=" . urlencode($e->getMessage()));
    }
}

?>