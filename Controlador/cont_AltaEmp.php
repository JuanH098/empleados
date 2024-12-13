<?php
include_once("../DAO/EmpleadoBBDD.php");
include_once("../Modelo/Empleado.php");
include_once("../DAO/DepartamentoBBDD.php");

if (isset($_REQUEST['enviarEmp'])) {
    $nif = $_REQUEST['nif'];
    $codigo = $_REQUEST['codigo'];
    $apellidos = $_REQUEST['apellidos'];
    $nombre = $_REQUEST['nombre'];
    $profesion = $_REQUEST['profesion'];
    $salario = $_REQUEST['salario'];
    $fechaNac = $_REQUEST['fecha_nac'];
    $fechaIng = $_REQUEST['fecha_ingreso'];
    $idDep = $_REQUEST['id_dep'];
}

try {
    $Empleadodao = new EmpleadoBBDD();
    $newCodigoEmp = $Empleadodao->ObtenerCodigoEmp($codigo);
    $Departamentodao= new DepartamentoBBDD();
    $newCodigoEmp;
    $newCodigoDep = $Departamentodao->ObtenerDepartamentos();
    $Empleadodao->comprobarFechas($fechaNac,$fechaIng);
    $newNif = $Empleadodao->ObtenerNif($nif);
    $Empleado = new Empleado($nif, $codigo, $apellidos, $nombre, $profesion, $salario, $fechaNac, $fechaIng, $idDep);
    $Empleadodao->DarAltaEmpleado($Empleado);
    header("Location: ../Vista/GenericErr.php?message=" . urlencode("Empleado creado de forma segura."));
} catch (Exception $e) {
    header("Location: ../Vista/GenericErr.php?message=" . urlencode($e->getMessage()));
}

?>