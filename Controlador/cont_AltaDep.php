<?php
include_once("../Vista/AltaDep.php");
include_once("../DAO/DepartamentoBBDD.php");
include_once("../Modelo/Departamento.php");

if (isset($_REQUEST['enviar'])) {
    $codigo = $_REQUEST['codigo'];
    $descripcion = $_REQUEST['descripcion'];
    $localizacion = $_REQUEST['localizacion'];
}



try {

    $departamentodao = new DepartamentoBBDD();
    $newCodigo = $departamentodao->ObtenerCodigo($codigo);
    $newCodigo;
    $departamento = new Departamento($codigo, $descripcion, $localizacion);
    

    if ($departamentodao->DarAltaDep($departamento)) {
        header("Location:../Vista/AltaDep.php");
    } else {
        header("Location:../Vista/AccionExitosa.html");
    }
} catch (Exception $e) {
    header("Location: ../Vista/GenericErr.php?message=" . urlencode($e->getMessage()));
}
?>