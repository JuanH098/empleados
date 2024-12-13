<?php
session_start();

if (!isset($_COOKIE['ambito'])){
    header("Location: ../Vista/login.php");
exit();
}else{
    setcookie('contador' , $_COOKIE['contador'] + 1, time() + (86400 * 30), "/");
}
?>
<?php
    require_once("../Controlador/cont_EmpleadosCompletos.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" contenct="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>Mensajes</title>
</head>

<body>
    <div class="content">
        <h1 class="title is-3">Lista Departamentos y Empleados</h1>
        <p class="title is-5">
           
        </p><br>
        <div class="columns">
            <div class="column is-three-fifths is-offset-one-fifth">
                <table class="table is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <td>Código</td>
                            <td>Nif</td>
                            <td>Apellido</td>
                            <td>Nombre</td>
                            <td>Profesión</td>
                            <td>Salario</td>
                            <td>Fecha Nacimiento</td>
                            <td>Fecha Ingreso</td>
                            <td>Departamento</td>
                            <td>Descripción</td>
                            <td>Localización</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Imprimir datos de la tabla
                        if (isset($datosEmpleado)) {
                            foreach ($datosEmpleado as $filaEmpleados) {
                                echo "<tr>";
                                foreach ($filaEmpleados as $clave => $valor) {
                                    if ($clave == "departamento") {
                                        foreach ($valor as $dato) {
                                            echo "<td>$dato</td>";
                                        }
                                    } else {
                                        if ($clave != 'id') {
                                            echo "<td>$valor</td>";
                                        }
                                    }
                                }
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <div class="buttons">
            <a class="button is-primary" href="../Vista/index.php">
                <strong>Volver al inicio</strong>
            </a>
        </div>
            </div>
        </div>
        
    </div>
</body>

</html>