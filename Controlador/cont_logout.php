<?php
    //Nos traemos la sesión
    session_start();

    //Asignamos a las variables que se van a mostrar en las vistas
    $nombre=$_COOKIE['nombre'];
    $contador=$_COOKIE['contador'];
    $ambito=$_COOKIE['ambito'];
    $usuario=$_COOKIE['usuario'];

    //Destruimos la sesión
    session_destroy();

    //Destruimos la puta galleta
    setcookie("contador",null,1,"/");
    require("../Vista/CerrarSesion.php");
?>