<?php
include_once("../DAO/DepartamentoBBDD.php");

if (isset($_REQUEST['enviar'])) {
    $codigo = $_REQUEST['codigo'];
    $accion = $_REQUEST['accion']; 
    $nuevoValor = $_REQUEST['nuevo_valor']; 
    
}

try {
    $departamentoDao = new DepartamentoBBDD();
    

    if ($accion === 'localizacion') {
        $departamentoDao->modificarLocalizacion($codigo, $nuevoValor);
    } elseif ($accion === 'descripcion') {
        $departamentoDao->modificarDescripcion($codigo, $nuevoValor);
    } else {
       
    }

    header("Location:../Vista/AccionExitosa.html");
} catch (Exception $e) {
    header("Location: ../Vista/GenericErr.php?message=" . urlencode($e->getMessage()));
}
?>