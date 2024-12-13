<?php
include("../Vista/login.php");
include("../DAO/CredencialesBBDD.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $C = new Credenciales();
    $Datos = $C->comprobarcredenciales($_REQUEST['name'], $_REQUEST['password']);
    if (is_array($Datos)) {
        setcookie("nombre",$Datos['nombre'],time()+3600, "/");
        setcookie("usuario",$Datos['usuario'],time()+3600,"/");
        setcookie("ambito",$Datos['ambito'],time()+3600,"/");
        setcookie("contador",0,time()+3600,"/");
        header("Location: ../Vista/index.php");
    }else{
        header("Location: ../Vista/loginErr.php");
    }
}
?>
