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
require("../Controlador/cont_Empleados.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Empleados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>

<body>
    <section class="section">
        <div class="container">
            <h1 class="title">Listado de Empleados</h1>
            <?php
            echo '<table class="table is-bordered is-striped is-narrow is-hoverable">';
            foreach ($empleadosTabla as $empleadosTabla) {
                echo "<tr>";
                foreach ($empleadosTabla as $key => $dato) {
                    if ($key != 'idDep')
                        echo "<td>" . $dato . "</td>";
                }

            }
            echo "</tr>";
            echo "</table>";
            ?>
            <div class="buttons">
                <a class="button is-primary" href="../Vista/index.php">
                    <strong>Volver al inicio</strong>
                </a>
            </div>
        </div>


    </section>
</body>

</html>